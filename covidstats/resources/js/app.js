import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import CovidMapComponent from './components/CovidMapComponent.vue';
import LandingStatsComponent from './components/LandingStatsComponent.vue'


// app.component('covid-map', CovidMapComponent)
app.component('landing-stats', LandingStatsComponent)

app.mount('#app');
