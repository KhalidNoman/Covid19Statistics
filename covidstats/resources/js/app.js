import './bootstrap';
import { createApp } from 'vue';
import {BootstrapVue, IconsPlugin} from "bootstrap-vue";
// import router from './router';

import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import '../sass/app.scss'



const app = createApp({});
// const app = createApp({
//     router,
//     e1: '#app',
//     render: h=>h(App)
// });
app.use(BootstrapVue);
app.use(IconsPlugin)


import CovidMapComponent from './components/CovidMapComponent.vue';
import LandingStatsComponent from './components/LandingStatsComponent.vue'
import CovidTableComponent from './components/CovidTableComponent.vue'
import HomePageComponent from './components/HomePageComponent.vue'
// import ExampleComponent from './components/ExampleComponent.vue'



app.component('covid-map', CovidMapComponent)
app.component('landing-stats', LandingStatsComponent)
app.component('covid-table', CovidTableComponent)
app.component('home-page', HomePageComponent)
// app.component('example-component'. ExampleComponent)

app.mount('#app');
