<template>
    <div>
        <b-form-input v-model="countryName"
        placeholder="Search by country name"></b-form-input>
        <b-table striped bordered responsive
        id="covidTable"
        :items="countryData" :fields="tblFields"
        :sort-by="TotalConfirmed" :filter="countryName"
        :per-page="perPage" :current-page="currentPage"
        ></b-table>
        <b-pagination
        style="justify-content: center;"
        v-model="currentPage"
        :total-rows="rows" :per-page="perPage"
        aria-controls="my-table"
        ></b-pagination>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    data () {
        return {
            countryData: [],
            tblFields: [
                {key:'Country', stickyColumn:true},
                {key:'TotalConfirmed', sortable:true},
                {key:'TotalRecovered', sortable:true},
                {key:'TotalDeaths', sortable:true},
                {key:'NewConfirmed', sortable:true},
                {key:'NewRecovered', sortable:true},
                {key:'NewDeaths', sortable:true}
            ],
            currentPage: 1,
            perPage: 10,
            pages: 0,
            rows: 0,
            countryName: ""
        }
    },
    methods:{
            async getData(){
                axios.get('api/get_country_data').then((res) => {
                    this.countryData = res.data;
                    this.rows = this.countryData.length;
                    this.pages = Math.round(this.rows/10)
                    this.currentPage = window.location.pathname.length > 1? window.location.pathname.trimStart(1):1
                }).catch()
            }
        },
        created(){
            this.getData()
    }
};
</script>
