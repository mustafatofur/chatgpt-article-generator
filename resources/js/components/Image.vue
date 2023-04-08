<template>
  <div>
    <div class="lg:w-2/3 m-auto py-4 px-2">
      <div class="mt-3">
        <div>
            <span class="text-sm font-extralight text-gray-300">Note: Please keep in mind that the generated images may not be as sophisticated as those created by midjourney. However, this image generator can be a useful tool for creating simpler images. <br></span>
          <legend class="pt-6 pb-2 text-gray-100">Image Prompt
            <br />
          </legend>
          
          <input
            ref="prompt"
            class="p-3.5 rounded-md w-full bg-slate-500 text-white shadow outline-none border placeholder:text-gray-300"
            type="text"
            placeholder="e.g: A cute baby wearing a hat"
            v-model="prompt"
            v-on:keyup.enter="process"
          />
        </div>

        <div>
          <legend class="pt-4 pb-2 text-gray-100">Image Size</legend>
          <SlimSelect             
            v-model="resolution"
            :data="resolutions"
            :settings="{ showSearch: false }">
            
          </SlimSelect>
        </div>

        <div class="mt-16 flex justify-end">
            <button
            class="px-4 py-2 bg-slate-600 hover:bg-slate-500 rounded-md border text-white"
            @click="process" v-wave
            >
            <span class="flex gap-2 items-center" v-if="!loading">
                  GENERATE
            </span>
            <span class="flex items-center" v-else>
                <loading></loading> GENERATING...
            </span>
            </button>
        </div>
      
      </div>
    </div>

   <div class="lg:w-2/3 xl:w-2/3 2xl:w-2/3 w-full m-auto py-4 pb-12 px-2" v-if="!loading && img">
      <h1 class="text-gray-100 text-2xl">Your Image:</h1>
      <div
        id="content-area"
        class="text-white mt-2 bg-slate-600 p-4 rounded-md shadow text-center"
      >
        <div class="relative flex justify-center w-fit m-auto">
            <a :href="img" target="_blank"><img :src="img" alt="Generated Image" class="rounded-sm"></a>
        </div>
        <span class="font-light text-sm mt-4 mb-2 inline-block">You can save the photo by right-clicking and selecting "Save Image As..."</span>
      </div>
       
    </div>

  </div>
</template>

<script>
import Loading from "./svg/Loading.vue";
import SlimSelect from "@slim-select/vue";
import Download from "./svg/Download.vue";
import { process } from "../functions/imageHandlers";
export default {
    components: {
        Loading, SlimSelect, Download
    },
    data() {
        return {
            loading: false,
            resolution: '256x256',
            prompt: '',
            img: null,
            resolutions: [
                { value: '256x256', text: '256x256' },
                { value: '512x512', text: '512x512' },
                { value: '1024x1024', text: '1024x1024' },
            ]
        }
    },
    methods: {
        process()
        {
            process(this);
        },
        checkLabel() {
          return this.prompt.length > 6 ? true : false;
        },
    }
}
</script>