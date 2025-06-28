<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryState extends Model
{
    protected $table = 'country_state';
    
    protected $fillable = [
        'country_name',
        'state_name'
    ];

    /**
     * Get all Indian states for dropdown
     */
    public static function getIndianStates()
    {
        return self::where('country_name', 'India')
            ->orderBy('state_name')
            ->pluck('state_name', 'id');
    }

    /**
     * Get states by country name
     */
    public static function getStatesByCountry($countryName)
    {
        return self::where('country_name', $countryName)
            ->orderBy('state_name')
            ->pluck('state_name', 'id');
    }
}
