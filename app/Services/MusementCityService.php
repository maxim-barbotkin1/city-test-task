<?php

namespace App\Services;

use App\Exceptions\MusemenExceptions;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class MusementCityService
{
    /**
     * @var string
     */
    private $requestUrl = "https://api.musement.com/api/v3/";

    /**
     * @var Client
     */
    private $client;


    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get all cities
     * @return array
     */
    public function list(): array
    {
        $response = $this->client->request('GET', $this->endPoint('cities'));

        return json_decode($response->getBody(), true);
    }

    /**
     * @param $cityId
     * @return array
     * @throws MusemenExceptions
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function single($cityId): array
    {
        try {
            $response = $this->client->request('GET', $this->endPoint("cities/{$cityId}"));
            $response = json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            throw new MusemenExceptions("unprocessable entity");
        }

        return $response;
    }

    /**
     * @param array $city
     * @return array
     * @throws \App\Exceptions\WeatherExceptions
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addForecastForCity(array $city): array
    {
        $forecast = (new WeatherService())->getForecast("{$city['latitude']},{{$city['longitude']}", 2);

        foreach ($forecast['forecastday'] as $day) {
            $city['forecast'][] = $day['day']['condition']['text'];
        }

        return $city;
    }

    /**
     * Generate endpoint
     * @param string $endpoint
     * @return string
     */
    private function endPoint(string $endpoint): string
    {
        return $this->requestUrl . $endpoint;
    }
}
