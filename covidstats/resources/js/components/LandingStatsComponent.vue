<template>
    <div>
        <h3>Data update date: {{ retDate }}</h3>
        <h3 style="color: red">Confirmed: {{ totCon }} </h3>
        <h3 style="color: green">Recovered: {{ totRec }}</h3>
        <h3 style="color: black">Deaths: {{ totDea }}</h3>
    </div>
</template>

<script>
import axios from 'axios';

    export default{
  data () {
    return {
        globalData: [],
        totCon: 0,
        totRec: 0,
        totDea: 0,
        retDate: 0,


    }
  },
        methods:{
            async getData(){
                axios.get('api/get_global_data').then((res) => {
                    this.globalData = res.data[0];
                    this.totCon = res.data[0].TotalConfirmed.toLocaleString();
                    this.totRec = res.data[0].TotalRecovered.toLocaleString();
                    this.totDea = res.data[0].TotalDeaths.toLocaleString();
                    this.retDate = new Date(res.data[0].Date).toLocaleString();

                }).catch()
            }
        },
        mounted(){
            this.getData()
        }
    };
</script>
