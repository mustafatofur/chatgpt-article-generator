export const getToken = () => {
    return document.querySelector('meta[name="csrf-token"]').content;
}

export const process = (self) => {
   const prompt = self.$refs.prompt;
   if (!self.checkLabel()) {
    prompt.classList.add("border-red-500");
     return;
   }
   prompt.classList.remove("border-red-500");
   self.loading = true;

   fetch("/api/image/process", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": getToken(),
    },
    body: JSON.stringify({
      prompt: self.prompt,
      size: self.resolution,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      self.img = data.data[0].url
      self.loading = false;
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
      self.loading = false;
    });

}
