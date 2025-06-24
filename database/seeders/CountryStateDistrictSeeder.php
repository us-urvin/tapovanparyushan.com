<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use Illuminate\Support\Facades\Http;

class CountryStateDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Fetch all countries and their states
        $response = Http::get('https://api.countrystatecity.in/v1/countries/IN');
        dd($response);
        // $countries = $response->json('data');

        // foreach ($countries as $countryData) {
        //     $country = Country::create([
        //         'name' => $countryData['name'],
        //         'iso2' => $countryData['iso2'] ?? null,
        //         'iso3' => $countryData['iso3'] ?? null,
        //     ]);

        //     foreach ($countryData['states'] as $stateData) {
        //         $state = State::create([
        //             'name' => $stateData['name'],
        //             'country_id' => $country->id,
        //         ]);

        //         // 2. Fetch cities for this state
        //         $citiesResponse = Http::post('https://countriesnow.space/api/v0.1/countries/state/cities', [
        //             'country' => $countryData['name'],
        //             'state' => $stateData['name'],
        //         ]);
        //         $cities = $citiesResponse->json('data') ?? [];

        //         foreach ($cities as $city) {
        //             District::create([
        //                 'name' => $city,
        //                 'state_id' => $state->id,
        //             ]);
        //         }
        //     }
        // }

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => 'https://api.countrystatecity.in/v1/countries/IN',
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_HTTPHEADER => array(
        //     'X-CSCAPI-KEY: aFR2WHgyR0xMaFBNRFV3V0RYMXJkd2dudGoyMVlDTDRvYjA0a0dXOA=='
        // ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
    }
}
