<?php

namespace Tests\Unit;

use App\Exceptions\WeatherExceptions;
use App\Services\WeatherService;
use GuzzleHttp\Exception\GuzzleException;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{

    /**
     * Test Weather empty query param
     *
     * @return void
     */
    public function testWeatherForecastEmptyQuery()
    {
        parent::setUp();
        $this->expectException(WeatherExceptions::class);
        (new WeatherService())->getForecast('');
    }

    /**
     * Test Weather not found
     *
     * @return void
     */
    public function testWeatherForecastNotFound()
    {
        parent::setUp();
        $this->expectException(GuzzleException::class);
        (new WeatherService())->getForecast('not_existing_city_');
    }

    /**
     * Test Weather add forecast method
     *
     * @return void
     */
    public function testWeatherForecastSuccess()
    {
        parent::setUp();
        $forecast = (new WeatherService())->getForecast("London");

        $this->assertArrayHasKey("forecastday", $forecast);
    }
}
