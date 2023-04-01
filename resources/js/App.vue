<template>
  <div>
    <div class="lg:w-2/3 m-auto py-4 px-2">
      <p class="pt-4 pb-2 text-gray-100">Article Title</p>
      <div class="flex">
        <input
          ref="title"
          class="p-3.5 rounded-md w-full bg-slate-500 text-white shadow outline-none border placeholder:text-gray-300"
          type="text"
          placeholder="e.g: Mexico's best food and recipe"
          v-model="topic"
          v-on:keyup.enter="process"
        />
      </div>
      <div class="mt-3">
        <p class="pt-4 pb-2 text-gray-100">Focus keywords</p>

        <input
          class="p-2 rounded-md w-full bg-slate-500 text-white shadow outline-none border placeholder:text-gray-300"
          type="text"
          v-model="keywords"
          placeholder="e.g: tomato, taco, pickles, jalapenos ..."
        />
        <p class="pt-4 pb-2 text-gray-100">Select tone</p>

        <SlimSelect
          v-model="tone"
          :data="tones"
          :settings="{ showSearch: false }"
        >
        </SlimSelect>

        <p class="pt-4 pb-2 text-gray-100">Select language</p>

        <SlimSelect v-model="language" :data="languages"> </SlimSelect>

        <p class="pt-4 pb-3 text-gray-100">
          Result Length (Token)
          <small class="block">(1000 token ≈ 700 words)</small>
        </p>

        <div id="slider-container" class="relative w-full">
          <input
            type="range"
            min="50"
            max="1000"
            class="slider absolute top-0 left-0 z-10 w-full h-3 appearance-none cursor-pointer bg-transparent border border-slate-500 rounded-md focus:outline-none"
            id="input-slider"
            v-model="words"
          />
          <div
            class="bg-slate-400 h-3 rounded-md absolute"
            :style="{
              width: 'calc((100% / (1000 - 50)) * (' + words + ' - 50))',
            }"
          ></div>
          <div
            class="h-3 rounded-md absolute"
            :style="{
              'padding-left':
                'calc((100% / (1000 - 50)) * (' + words + ' - 50))',
            }"
          >
            <span class="inline-block mt-6 text-white">{{ words }}</span>
          </div>
        </div>
      </div>
      <div class="mt-16 flex justify-end">
        <button
          class="px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md border text-white"
          @click="process"
        >
          <span class="flex gap-2 items-center" v-if="!loading">
            <paper-plane></paper-plane> GENERATE
          </span>
          <span class="flex items-center" v-else>
            <loading></loading> GENERATING...
          </span>
        </button>
      </div>
    </div>


    <div class="lg:w-2/3 xl:w-2/3 2xl:w-2/3 w-full m-auto py-4 pb-12 px-2" v-if="!loading && article">
      <h1 class="text-gray-100 text-2xl">Your Article:</h1>
      <div
        id="content-area"
        class="text-white mt-2 bg-slate-600 p-4 rounded-md shadow"
      >
      
        <div v-html="article"></div>

      </div>
      <div class="flex justify-end items-center gap-2 mt-5">
        <button class="pr-4 pl-2 py-2 bg-slate-600 hover:bg-slate-500 rounded-md border text-white" @click="download('txt')">
                <span class="flex items-center gap-2" v-if="!downloading"><download></download> Download this article</span>
                <span class="flex items-center gap-0" v-else><loading></loading> Downloading...</span>
        </button>
        <a class="hidden" ref="download"></a>
    </div>
    </div>
    
  </div>
</template>

<script>
import PaperPlane from "./components/svg/PaperPlane.vue";
import Loading from "./components/svg/Loading.vue";
import Download from "./components/svg/Download.vue";
import { process, download } from './handlers.js';
import SlimSelect from "@slim-select/vue";
import { languages } from "./languages";
import { tones } from "./tones";
export default {
  components: {
    PaperPlane,
    Loading,
    Download,
    SlimSelect,
  },
  data() {
    return {
      loading: false,
      downloading: false,
      topic: "",
      keywords: "",
      article: null,
      words: 150,
      select_settings: {
        showSearch: false,
      },
      languages: languages(),
      language: "English",
      tones: tones(),
      tone: "Bold",
    };
  },
  methods: {
    process() {
        process(this)
    },
    download(fileType){
        download(this, fileType)
    },
    checkLabel() {
      return this.topic.length > 4 ? true : false;
    },
  },
};
</script>

<style scoped>
</style>