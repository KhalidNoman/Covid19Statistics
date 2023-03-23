<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\GlobalData;
use GuzzleHttp\Client;

class CountryController extends Controller
{
    public function fill_data(Request $request)
    {
        // Setup api call to get data from covid summary data api
        $client = new Client();
        $response = $client->request('GET', 'https://api.covid19api.com/summary', ['verify' => false]);
        $data = json_decode($response->getBody()->getContents(),true);

        //Fill out Country Data
        foreach($data['Countries'] as $temp){
            // Check to see if country exists in the database
            $check = Country::find($temp['ID']);
            // If it exists update its information
            if($check){
                $check->update([
                    'Date'=> strval($temp['Date']),
                    'NewConfirmed'=> strval($temp['NewConfirmed']),
                    'NewDeaths'=> strval($temp['NewDeaths']),
                    'NewRecovered'=> strval($temp['NewRecovered']),
                    'TotalConfirmed'=> strval($temp['TotalConfirmed']),
                    'TotalDeaths'=> strval($temp['TotalDeaths']),
                    'TotalRecovered'=> strval($temp['TotalRecovered']),
                ]);
            }
            // If it does not exist create a new entry
            else {
                Country::create([
                    'Country'=> strval($temp['Country']),
                    'CountryCode'=> strval($temp['CountryCode']),
                    'Date'=> strval($temp['Date']),
                    'id'=> strval($temp['ID']),
                    'NewConfirmed'=> strval($temp['NewConfirmed']),
                    'NewDeaths'=> strval($temp['NewDeaths']),
                    'NewRecovered'=> strval($temp['NewRecovered']),
                    'Slug'=> strval($temp['Slug']),
                    'TotalConfirmed'=> strval($temp['TotalConfirmed']),
                    'TotalDeaths'=> strval($temp['TotalDeaths']),
                    'TotalRecovered'=> strval($temp['TotalRecovered']),

                ]);
            }

        };
        // Create new entry for global data
        $temp = $data['Global'];
        GlobalData::create([
            'Date'=>$temp['Date'],
            'NewConfirmed'=>$temp['NewConfirmed'],
            'NewDeaths'=>$temp['NewDeaths'],
            'NewRecovered'=>$temp['NewRecovered'],
            'TotalConfirmed'=>$temp['TotalConfirmed'],
            'TotalDeaths'=>$temp['TotalDeaths'],
            'TotalRecovered'=>$temp['TotalRecovered'],
        ]);

        return response() -> json(['message' => 'Databases updated successfully!'], 200);
    }

    public function get_global_data(){
        // Return all global data
        return GlobalData::all();
    }
    public function get_country_data(){
        // Return all country data
        return Country::all();
    }

    public function update_country(Request $data,){
        // Update a country by searching using its id (the primary key)
        $temp = Country::find($data['id']);
        $temp->update([
            'Date'=> strval($data['Date']),
            'NewConfirmed'=> strval($data['NewConfirmed']),
            'NewDeaths'=> strval($data['NewDeaths']),
            'NewRecovered'=> strval($data['NewRecovered']),
            'TotalConfirmed'=> strval($data['TotalConfirmed']),
            'TotalDeaths'=> strval($data['TotalDeaths']),
            'TotalRecovered'=> strval($data['TotalRecovered']),
        ]);
        return $temp;

    }

    public function add_country(Request $data){
        // Create a country entry
        $temp = Country::create([
            'Country'=> strval($data['Country']),
            'CountryCode'=> strval($data['CountryCode']),
            'Date'=> strval($data['Date']),
            'id'=> strval($data['id']),
            'NewConfirmed'=> strval($data['NewConfirmed']),
            'NewDeaths'=> strval($data['NewDeaths']),
            'NewRecovered'=> strval($data['NewRecovered']),
            'Slug'=> strval($data['Slug']),
            'TotalConfirmed'=> strval($data['TotalConfirmed']),
            'TotalDeaths'=> strval($data['TotalDeaths']),
            'TotalRecovered'=> strval($data['TotalRecovered']),
        ]);
        return $temp;

    }

    public function delete_country(Request $data){
        // Find a country using its id and delete it
        Country::destroy($data['id']);
        return $data;
    }
}
