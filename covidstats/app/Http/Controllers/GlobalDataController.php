<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalData;
use GuzzleHttp\Client;

class GlobalDataController extends Controller
{

    public function fill_data(Request $request)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.covid19api.com/summary/', ['verify' => false]);
        $data = json_decode($response->getBody()->getContents(),true);

        GlobalData::truncate();
        foreach($data['Global'] as $temp){
            GlobalData::create([
                'Date'=>$temp['Date'],
                'NewConfirmed'=>$temp['NewConfirmed'],
                'NewDeaths'=>$temp['NewDeaths'],
                'NewRecovered'=>$temp['NewRecovered'],
                'TotalConfirmed'=>$temp['TotalConfirmed'],
                'TotalDeaths'=>$temp['TotalDeaths'],
                'TotalRecovered'=>$temp['TotalRecovered'],

            ]);
            $res = $temp->save();
        };

        return response() -> json(['message' => $res], 200);
    }
}
