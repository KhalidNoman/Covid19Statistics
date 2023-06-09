<template>
    <div class="margins">
        <h1>Edit a country's data by clicking on its row and country or add a new country</h1>
        <b-form @submit="onSubmit" @reset="onReset" >
            <!-- Form to edit and add a country into the database -->
            <div class="form-group">
                <legend>Country:
                <b-form-input class="form-margin" v-model="form.country" type="text" :disabled="disableIns"></b-form-input>
                </legend>
                <legend>New confirmed:
                <b-form-input class="form-margin" v-model="form.nCon" type="number" min="0"></b-form-input>
                </legend>
                <legend>New recovered:
                <b-form-input class="form-margin" v-model="form.nRec" type="number" min="0"></b-form-input>
                </legend>
                <legend>New deaths:
                <b-form-input class="form-margin" v-model="form.nDts" type="number" min="0"></b-form-input>
                </legend>
                <legend>Country code:
                <b-form-input class="form-margin" v-model="form.code" type="text" :disabled="disableIns"></b-form-input>
                </legend>
                <legend>Total confirmed:
                <b-form-input class="form-margin" v-model="form.tCon" type="number" min="0"></b-form-input>
                </legend>
                <legend>Total recovered:
                <b-form-input class="form-margin" v-model="form.tRec" type="number" min="0"></b-form-input>
                </legend>
                <legend>Total deaths:
                <b-form-input class="form-margin" v-model="form.tDts" type="number" min="0"></b-form-input>
                </legend>
            </div>
                <b-button class="margins" type="submit" variant="primary">Submit</b-button>
                <b-button class="margins" type="reset" variant="danger">Reset </b-button>
                <b-button style="float:right" class="margins" variant="danger" @click="deleteRow">Delete </b-button>
        </b-form>


        <!-- Search bar to filter table based on input -->
        <b-form-input v-model="countryName"
        placeholder="Search by country name"></b-form-input>
        <!-- Bootstrap table to display country data -->
        <b-table striped bordered responsive hover
        id="covidTable" ref="covidTable"
        :items="countryData" :fields="tblFields"
        :sort-by="TotalConfirmed" :filter="countryName"
        :per-page="perPage" :current-page="currentPage"
        @row-clicked="rowClick" selectable
        ></b-table>
        <!-- Paginate table for clearer visibility -->
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
                {key:'CountryCode'},
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
            countryName: "",
            form:{
                country: "",
                nCon: 0,
                nRec: 0,
                nDts: 0,
                code: "",
                tCon: 0,
                tRec: 0,
                tDts: 0
            },
            countries: [],
            codes: [],
            selectedRow: -1,
            disableIns: false
        }
    },
    methods:{
            async getData(){
                // Get country data through api call to database
                axios.get('api/get_country_data').then((res) => {
                    this.countryData = res.data;
                    this.rows = this.countryData.length;
                    this.pages = Math.round(this.rows/10)
                    this.currentPage = window.location.pathname.length > 1? window.location.pathname.trimStart(1):1
                    for(let i = 0; i < this.rows; i++){
                        this.countries.push(String(this.countryData[i].Country).toLowerCase())
                        this.codes.push(String(this.countryData[i].CountryCode).toLowerCase())
                    }
                }).catch()
            },
            onSubmit(event){
                event.preventDefault();
                if(this.selectedRow >= 0){
                    // Edit a country (selected row means a country is selected from  the table)
                    // Selected row variable is always reset to -1 if no country is selected
                    // or if form is reset
                    let temp = this.countryData[this.selectedRow]
                    temp.TotalConfirmed = this.form.tCon
                    temp.TotalRecovered = this.form.tRec
                    temp.TotalDeaths = this.form.tDts
                    temp.NewConfirmed = this.form.nCon
                    temp.NewRecovered = this.form.nRec
                    temp.NewDeaths = this.form.nDts
                    axios.post('api/update_country', temp, temp.id)
                    alert("Country updated")
                    this.getData()
                    this.clearData()
                }
                else if(this.codes.includes(this.form.code.toLowerCase()) )
                    // Cannot add a country with an already existing country code
                    alert("Country code already exists")
                else if(this.countries.includes(this.form.country.toLowerCase()))
                    // Cannot add a country with an already existing country name
                    alert("Country already exists")
                else{
                    // Country name an country code are unique in the database
                    // Grab the data from the form
                    let temp = {
                        Country: this.form.country,
                        CountryCode: this.form.code,
                        TotalConfirmed: this.form.tCon,
                        NewConfirmed: this.form.nCon,
                        TotalRecovered: this.form.tRec,
                        NewRecovered: this.form.nRec,
                        TotalDeaths: this.form.tDts,
                        NewDeaths: this.form.nDts,
                        id: String(this.form.country) + new Date().toLocaleString(),
                        Date: new Date(),
                        Slug: String(this.form.country).replace(/\s+/g, '-').toLowerCase()
                    }
                    // Slug will be created through taking a country's name making it lower case
                    // and splitting words using dashed instead of spaces

                    // Id is set by using the countrty name and the date it was added to keep
                    // ids unique
                    axios.post('api/add_country', temp)
                    alert("Country added")
                    // Reset table to show updated data
                    this.getData()
                    this.clearData()
                }
            },
            rowClick(item, index, event){
                // Set form fields to selected country's data
                this.form.country = item.Country
                this.form.code = item.CountryCode
                this.form.tCon = item.TotalConfirmed
                this.form.tRec = item.TotalRecovered
                this.form.tDts = item.TotalDeaths
                this.form.nCon = item.NewConfirmed
                this.form.nRec = item.NewRecovered
                this.form.nDts = item.NewDeaths
                this.disableIns = true
                // Get the index of the country taking into account table might be sorted
                this.selectedRow = this.countries.indexOf(String(item.Country).toLowerCase())
            },
            onReset(event){
                // On reset click change back to add country mode
                this.disableIns = false
                this.selectedRow = -1
                // Clear data in the form fields
                this.clearData()
            },
            deleteRow(event){
                // Confirm with user on clicking delete button
                let confirmation = window.confirm("Please confirm you would like to delete " + this.countryData[this.selectedRow].Country)
                if(confirmation){
                    axios.post('api/delete_country', this.countryData[this.selectedRow])
                    this.getData()
                    this.clearData()
                }
            },
            clearData(){
                // Reset the field values in the form
                this.form.country = ""
                this.form.code = ""
                this.form.tCon = 0
                this.form.tRec = 0
                this.form.tDts = 0
                this.form.nCon = 0
                this.form.nRec = 0
                this.form.nDts = 0
                // Go back to add country mode
                this.selectedRow = -1
                this.disableIns = false
            }
        },

        created(){
            this.getData()
    }
};
</script>
<style>
    .margins{
        margin: 10px;
    }
    .form-margin{
        margin-bottom: 10px;
    }
    .form-group{
        column-count: 2;
    }
</style>
