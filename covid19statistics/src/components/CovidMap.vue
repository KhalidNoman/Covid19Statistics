<template>
    <div>
        <world-map-vue></world-map-vue>
    </div>
</template>

<script>
import WorldMapVue from "world-map-vue";
export default {
  components: { WorldMapVue },
  watch: {
    countryData() {
      
    },
  },
  props:{
    
  },
  methods:{
    async getData(){
      // fetch("https://api.covid19api.com/summary")
      // .then(res => res.json())
      // .then(data => console.log(data))
      const res = await fetch("https://api.covid19api.com/summary");
        const finalRes = await res.json();
        this.listItems = finalRes;
    }
  },
  mounted(){
    console.log("DOAMSDO")
    this.getData();
    console.log(this.listItems)
  }
  
};
</script>

<style>
    
</style>