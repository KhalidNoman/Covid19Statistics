<template>
    <div>
        <b-table striped bordered
        :items="countryData" :fields="tblFields"
        :sort-by="TotalConfirmed"
        ></b-table>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    data () {
        return {
            countryData: [],
            tblFields: [
                {key:'Country'},
                {key:'TotalConfirmed', sortable:true},
                'TotalRecovered',
                'TotalDeaths',
                'NewConfirmed',
                'NewRecovered',
                'NewDeaths'
            ]
        }
    },
    methods:{
            async getData(){
                axios.get('get_country_data').then((res) => {
                    this.countryData = res.data;
                }).catch()
            }
        },
        created(){
            this.getData()
    }
};
</script>
