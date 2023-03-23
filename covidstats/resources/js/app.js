import './bootstrap';
import { createApp } from 'vue';
import {BootstrapVue, IconsPlugin} from "bootstrap-vue";
import router from './router';

//Import bootstrap
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import '../sass/app.scss'



const app = createApp({});
app.use(router)
app.use(BootstrapVue);
app.use(IconsPlugin)

//Import Vue components
import LandingStatsComponent from './components/LandingStatsComponent.vue'
import CovidTableComponent from './components/CovidTableComponent.vue'
import HomePageComponent from './components/HomePageComponent.vue'

//Register components so that they are able to be displayed
app.component('landing-stats', LandingStatsComponent)
app.component('covid-table', CovidTableComponent)
app.component('home-page', HomePageComponent)

app.mount('#app');
