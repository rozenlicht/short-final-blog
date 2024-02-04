<?php

namespace App\Services;

class AirportService
{
    public static function getAirportByIcao($icao)
    {
        $airports = collect(json_decode(file_get_contents(database_path('airports.json')), true));
        return $airports->firstWhere('icao', $icao);
    }
}
