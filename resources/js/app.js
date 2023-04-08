import './bootstrap';
import { createApp } from 'vue';
import App  from './App.vue';
import VWave from 'v-wave';
const appDiv = document.getElementById('app')
        if(appDiv) 
        {
            const app = createApp(App);
            app.use(VWave)
            app.mount('#app')
        }