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

        $client = new Client();
        $response = $client->request('GET', 'https://api.covid19api.com/summary', ['verify' => false]);
        // $response = $client -> request('GET', 'https://api.covid19api.com/summary');
        $data = json_decode($response->getBody()->getContents(),true);

        //Fill out Country Data
        Country::truncate();
        foreach($data['Countries'] as $temp){
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
        };

        GlobalData::truncate();
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
        return GlobalData::all();
    }
    public function get_country_data(){
        return Country::all();
    }
}
