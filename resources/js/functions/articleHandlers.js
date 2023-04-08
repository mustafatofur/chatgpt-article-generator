export const getToken = () => {
     return document.querySelector('meta[name="csrf-token"]').content;
}

export const process = (self) => {
    const title = self.$refs.title;
    if (!self.checkLabel()) {
      title.classList.add("border-red-500");
      return;
    }
    title.classList.remove("border-red-500");
    self.loading = true;

    try {
      fetch("/api/text/process", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": getToken(),
        },
        body: JSON.stringify({
          topic: self.topic,
          keywords: self.keywords,
          tone: self.tone,
          language: self.language,
          words: self.words,
        }),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.json();
        })
        .then((data) => {
          if (data.success) {
            self.article = data.message.replaceAll("\n", '<br />');
            self.loading = false;
          }
          self.loading = false;
        });
    } catch (err) {
      console.error(err)
      self.loading = false;
    }
}

export const download = (self, fileType) => {

    self.downloading = true;
    try {
      fetch("/api/text/download", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": getToken(),
        },
        body: JSON.stringify({
          topic: self.topic,
          article: self.article,
          fileType: 'txt'
        }),
      })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.blob();
      })
        .then((blob) => {
             const file = window.URL.createObjectURL(blob);
             const a = self.$refs.download;
             a.href = file;
             a.download = self.topic+"_"+ self.language+".txt";
             
             a.click();
             a.remove()
             self.downloading = false;
        });
    } catch (err) {
      console.error(err)
      self.downloading = false;
    }

}
