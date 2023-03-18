import './bootstrap';
import { createApp } from 'vue';
import BootstrapVue from "bootstrap-vue";

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import '../sass/app.scss'


const app = createApp({});
app.use(BootstrapVue);


import CovidMapComponent from './components/CovidMapComponent.vue';
import LandingStatsComponent from './components/LandingStatsComponent.vue'
import CovidTableComponent from './components/CovidTableComponent.vue'
import ExampleComponent from './components/ExampleComponent.vue'



// app.component('covid-map', CovidMapComponent)
app.component('landing-stats', LandingStatsComponent)
app.component('covid-table', CovidTableComponent)
app.component('example'. ExampleComponent)

app.mount('#app');
