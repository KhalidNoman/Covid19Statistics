<template>
    <div>
        <div style="columns:2">
            <div>
                <!-- Summary of world covid stats -->
                <h3>Data update date: {{ retDate }}</h3>
                <h3 style="color: red">Confirmed: {{ totCon }} </h3>
                <h3 style="color: green">Recovered: {{ totRec }}</h3>
                <h3 style="color: black">Deaths: {{ totDea }}</h3>
            </div>
            <div>
                <!-- Radio button group to select type of data to display on map -->
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

        <!-- Display the map according to the selected radio button -->
        <MapChart :country-data="tConfirmedData" v-if="selected == 1"
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
// Import map building library
// File App.vue in vue-map-chart was edited on lines
// -> 19 to comment out chroma-js import as it is no longer supported
// -> 20 to change "import Map from './Map'" to "import Map from './Map.vue'"
// -> 73-75 to comment out use of chroma-js
// -> 95-100 to comment out use of chroma-js
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
                // Get global data from database through an api
                axios.get('api/get_global_data').then((res) => {
                    this.globalData = res.data[0];
                    this.totCon = res.data[0].TotalConfirmed.toLocaleString();
                    this.totRec = res.data[0].TotalRecovered.toLocaleString();
                    this.totDea = res.data[0].TotalDeaths.toLocaleString();
                    this.retDate = new Date(res.data[0].Date).toLocaleString();
                }).catch()
                // Get country data from database through an api
                axios.get('api/get_country_data').then((res) => {
                    this.countryData = res.data;
                    // Create seperate objects for each data type to display on map
                    // Map uses country-data which requires the data to be in the form
                    // of { 'CountryCode': value }
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
            // Initialize variables
            this.getData()
    }
};
</script>
