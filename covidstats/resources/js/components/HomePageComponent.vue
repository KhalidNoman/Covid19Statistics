<template>
    <div>
        <b-tabs content-class="mt-3">
        <b-tab title="World">
        </b-tab>
        <b-tab title="Country">
            <router-link class="nav-link"
            :to="{ name: home}"></router-link>
        </b-tab>
  </b-tabs>
    </div>
</template>

<script>
import LandingStats from '../../../../covid19statistics/src/components/LandingStats.vue';
export default {
  components: { LandingStats },
  watch: {

  },
  props:{

  },
  methods:{
  },
  mounted(){

  }

};
</script>

<style>

</style>
