<template>
  <div> 
    <tabs @showArticleGenerator="article = true; image = false" @showImageGenerator="image = true; article = false" :article="article" :image="image" /> 
    <article-generator :class="{'hidden': !article, 'block': article}" />
    <image-generator :class="{'hidden': !image, 'block': image}" />
  </div>
</template>

<script>
import Tabs from "./components/Tabs.vue";
import ArticleGenerator from "./components/Article.vue";
import ImageGenerator from "./components/Image.vue";
export default {
  components: {
    Tabs,
    ArticleGenerator,
    ImageGenerator,
  },
  mounted() {
     
  },
  data() {
    return {
      article: true,
      image: false,
    };
  },
  methods: {},
};
</script>

<style scoped>
</style>