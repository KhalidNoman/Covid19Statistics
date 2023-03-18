import './bootstrap';
import { createApp } from 'vue';
import BootstrapVue3 from "bootstrap-vue-3";

import "bootstrap-vue-3/dist/bootstrap-vue-3.css";
import '../sass/app.scss'


const app = createApp({});
app.use(BootstrapVue3);


import CovidMapComponent from './components/CovidMapComponent.vue';
import LandingStatsComponent from './components/LandingStatsComponent.vue'
import CovidTableComponent from './components/CovidTableComponent.vue'



// app.component('covid-map', CovidMapComponent)
app.component('landing-stats', LandingStatsComponent)
app.component('covid-table', CovidTableComponent)

app.mount('#app');
