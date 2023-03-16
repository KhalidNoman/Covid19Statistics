<template>
  <div>
    <h1>Covid 19 World Statistics</h1>
    <landing-stats></landing-stats>
    <covid-map></covid-map>
  </div>
</template>

<script>
import CovidMap from './components/CovidMap.vue'
import LandingStats from './components/LandingStats.vue'
export default {
  data () {
    return {
    }
  },
  created () {
  },
  name: 'App',
  components: {
    CovidMap,
    LandingStats
  },  

}
</script>

<style>

</style>
