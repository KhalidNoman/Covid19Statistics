<template>
    <div>
        <h1>Covid 19 Statistics </h1>
        <div style="columns:2">
            <div>
                <h3>Data update date: {{ retDate }}</h3>
                <h3 style="color: red">Confirmed: {{ totCon }} </h3>
                <h3 style="color: green">Recovered: {{ totRec }}</h3>
                <h3 style="color: black">Deaths: {{ totDea }}</h3>
            </div>
            <div>
                <legend>Type of data to show on the map:</legend>
                <b-form-radio-group @change="radioChange" style="columns:2" v-model="selected">
                    <b-form-radio size="lg" value="1">Total Confirmed</b-form-radio>
                    <b-form-radio size="lg" value="2">Total Recovered</b-form-radio>
                    <b-form-radio size="lg" value="3">Total Deaths</b-form-radio>
                    <b-form-radio size="lg" value="4">New Confirmed</b-form-radio>
                    <b-form-radio size="lg" value="5">New Recovered</b-form-radio>
                    <b-form-radio size="lg" value="6">New Deaths</b-form-radio>
                </b-form-radio-group >
            </div>
        </div>

        <MapChart :country-data="tConfirmedData" v-if="selected == 1" defaultCountryFillColor="#FFFFFF"
        ></MapChart>
        <MapChart :country-data="tRecoveredData" v-if="selected == 2"
        ></MapChart>
        <MapChart :country-data="tDeathsData" v-if="selected == 3"
        ></MapChart>
        <MapChart :country-data="nConfirmedData" v-if="selected == 4"
        ></MapChart>
        <MapChart :country-data="nRecoveredData" v-if="selected == 5"
        ></MapChart>
        <MapChart :country-data="nDeathsData" v-if="selected == 6"
        ></MapChart>
    </div>
</template>

<script>
import axios from 'axios';
import MapChart from 'vue-map-chart'

export default{
    components:{
        MapChart
    },
    data () {
        return {
            globalData: [],
            countryData: [],
            totCon: 0,
            totRec: 0,
            totDea: 0,
            retDate: 0,
            tConfirmedData: [],
            tRecoveredData: [],
            tDeathsData: [],
            nConfirmedData: [],
            nRecoveredData: [],
            nDeathsData: [],
            selected: 1,
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
                axios.get('api/get_country_data').then((res) => {
                    this.countryData = res.data;
                    let totCon = new Object();
                    let totRec = new Object();
                    let totDts = new Object();
                    let newCon = new Object();
                    let newRec = new Object();
                    let newDts = new Object();
                    this.countryData.forEach(element => {
                        totCon[element.CountryCode] = element.TotalConfirmed
                        totRec[element.CountryCode] = element.TotalRecovered
                        totDts[element.CountryCode] = element.TotalDeaths
                        newCon[element.CountryCode] = element.NewConfirmed
                        newRec[element.CountryCode] = element.NewRecovered
                        newDts[element.CountryCode] = element.NewDeaths
                    });
                    this.selectedData = this.tConfirmedData = totCon
                    this.tRecoveredData = totRec
                    this.tDeathsData = totDts
                    this.nConfirmedData = newCon
                    this.nRecoveredData = newRec
                    this.nDeathsData = newDts
                }).catch()
            }
        },
    mounted(){
            this.getData()
    }
};
</script>
