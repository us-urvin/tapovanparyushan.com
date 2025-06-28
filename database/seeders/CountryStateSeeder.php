<?php

namespace Database\Seeders;

use App\Models\CountryState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CountryStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('country_state')->truncate();
        CountryState::insert([
            ['country_name' => 'India', 'state_name' => 'Andaman and Nicobar Islands'],
            ['country_name' => 'India', 'state_name' => 'Andhra Pradesh'],
            ['country_name' => 'India', 'state_name' => 'Arunachal Pradesh'],
            ['country_name' => 'India', 'state_name' => 'Assam'],
            ['country_name' => 'India', 'state_name' => 'Bihar'],
            ['country_name' => 'India', 'state_name' => 'Chandigarh'],
            ['country_name' => 'India', 'state_name' => 'Chhattisgarh'],
            ['country_name' => 'India', 'state_name' => 'Dadra and Nagar Haveli'],
            ['country_name' => 'India', 'state_name' => 'Daman and Diu'],
            ['country_name' => 'India', 'state_name' => 'Delhi'],
            ['country_name' => 'India', 'state_name' => 'Goa'],
            ['country_name' => 'India', 'state_name' => 'Gujarat'],
            ['country_name' => 'India', 'state_name' => 'Haryana'],
            ['country_name' => 'India', 'state_name' => 'Himachal Pradesh'],
            ['country_name' => 'India', 'state_name' => 'Jammu and Kashmir'],
            ['country_name' => 'India', 'state_name' => 'Jharkhand'],
            ['country_name' => 'India', 'state_name' => 'Karnataka'],
            ['country_name' => 'India', 'state_name' => 'Kerala'],
            ['country_name' => 'India', 'state_name' => 'Ladakh'],
            ['country_name' => 'India', 'state_name' => 'Lakshadweep'],
            ['country_name' => 'India', 'state_name' => 'Madhya Pradesh'],
            ['country_name' => 'India', 'state_name' => 'Maharashtra'],
            ['country_name' => 'India', 'state_name' => 'Manipur'],
            ['country_name' => 'India', 'state_name' => 'Meghalaya'],
            ['country_name' => 'India', 'state_name' => 'Mizoram'],
            ['country_name' => 'India', 'state_name' => 'Nagaland'],
            ['country_name' => 'India', 'state_name' => 'Odisha'],
            ['country_name' => 'India', 'state_name' => 'Puducherry'],
            ['country_name' => 'India', 'state_name' => 'Punjab'],
            ['country_name' => 'India', 'state_name' => 'Rajasthan'],
            ['country_name' => 'India', 'state_name' => 'Sikkim'],
            ['country_name' => 'India', 'state_name' => 'Tamil Nadu'],
            ['country_name' => 'India', 'state_name' => 'Telangana'],
            ['country_name' => 'India', 'state_name' => 'Tripura'],
            ['country_name' => 'India', 'state_name' => 'Uttar Pradesh'],
            ['country_name' => 'India', 'state_name' => 'Uttarakhand'],
            ['country_name' => 'India', 'state_name' => 'West Bengal']
        ]);
    }
}
