import Vue from 'vue';
import * as VueRouter from 'vue-router';

import LandingStatsComponent from './components/LandingStatsComponent.vue'
import CovidTableComponent from './components/CovidTableComponent.vue'

Vue.use(VueRouter);

//Create router variable that holds paths for NavBar to function
const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
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
