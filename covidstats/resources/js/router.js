import Vue from 'vue';
import VueRouter from 'vue-router';

import CovidMapComponent from './components/CovidMapComponent.vue';
import LandingStatsComponent from './components/LandingStatsComponent.vue'
import CovidTableComponent from './components/CovidTableComponent.vue'
import HomePageComponent from './components/HomePageComponent.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'histroy',
    linkExactActiveClass: 'active',
    routes:[
        {
            path:'/',
            name: 'home',
            component: LandingStatsComponent
        },
        {
            path:'/country-list',
            name: 'country',
            component: CovidTableComponent
        }
    ]
})

export default router;
