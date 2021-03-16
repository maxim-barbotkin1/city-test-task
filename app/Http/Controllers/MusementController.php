<?php


namespace App\Http\Controllers;

use App\Services\MusementCityService;
use GuzzleHttp\Exception\GuzzleException;

class MusementController
{
    /**
     * Get list of cities with forecast
     * @param MusementCityService $musementCityService
     * @throws \App\Exceptions\WeatherExceptions
     * @throws GuzzleException
     */
    public function index(MusementCityService $musementCityService)
    {
        foreach ($musementCityService->list() as $city) {
            try {
                $city = $musementCityService->addForecastForCity($city);
                echo "Processed city {$city['name']} | {$city['forecast'][0]} {$city['forecast'][1]}"."<br>";
            } catch (GuzzleException $exception) {
                continue;
            }
        }
    }

    /**
     * Get single city with forecast
     * @param $cityId
     * @param MusementCityService $musementCityService
     * @throws GuzzleException
     * @throws \App\Exceptions\MusemenExceptions
     */
    public function single($cityId, MusementCityService $musementCityService)
    {
        $city = $musementCityService->addForecastForCity(
            $musementCityService->single($cityId)
        );
        echo "Processed city {$city['name']} | {$city['forecast'][0]} {$city['forecast'][1]}";
    }
}
