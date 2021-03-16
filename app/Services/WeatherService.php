<?php

namespace App\Services;

use App\Exceptions\WeatherExceptions;
use GuzzleHttp\Client;

class WeatherService
{
    /**
     * @var string
     */
    private $requestUrl = "http://api.weatherapi.com/v1/forecast.json";


    /**
     * @var Client
     */
    private $client;


    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $query
     * @param int $forecastDays
     * @return array
     * @throws WeatherExceptions
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getForecast(string $query, $forecastDays = 1): array
    {

        if (empty($query)) {
            throw new WeatherExceptions("query can not by empty");
        }

        $response = $this->client->request('GET', $this->requestUrl, [ "query" => [
            "key" => config('services.weather.key'),
            "q" => $query,
            "days" => $forecastDays
        ]]);

        $response = json_decode($response->getBody(), true);

        if (array_key_exists("error", $response)) {
            throw new WeatherExceptions($response['error']['message']);
        }

        return $response['forecast'];
    }
}
