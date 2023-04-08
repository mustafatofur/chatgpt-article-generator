<template>
    <div>
        <div class="flex flex-col sm:flex-row w-1/3 m-auto">
        <button class="tab-menu"
        @click="showArticle"
          :class="{ 'active': this.article }" v-wave>
          Article Generator
        </button>
        <button class="tab-menu"
        effect="ripple"
         @click="showImage"
        :class="{ 'active': this.image }" v-wave>
          Image Generator
        </button>
      </div>
    </div>
</template>

<script>
export default {
    props: ['article', 'image'],
    emits: ['showArticleGenerator', 'showImageGenerator'],
    methods: {
        showArticle() {
             this.$emit('showArticleGenerator');
        },
        showImage() {
             this.$emit('showImageGenerator');
        }
    },
}
</script>