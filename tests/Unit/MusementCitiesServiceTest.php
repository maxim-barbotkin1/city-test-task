<?php

namespace Tests\Unit;

use App\Exceptions\MusemenExceptions;
use App\Services\MusementCityService;
use Tests\TestCase;

class MusementCitiesServiceTest extends TestCase
{
    /**
     * Test Musement service all sities
     *
     * @return void
     */
    public function testMusementCitiesList()
    {
        parent::setUp();
        $cities = (new MusementCityService)->list();
        $this->assertIsArray($cities);
        $this->assertArrayHasKey("name", $cities[0]);
    }

    /**
     * Test Musement service single
     *
     * @return void
     */
    public function testMuseumCitySingle()
    {
        $existingCitiesIds = [
            57,58,59
        ];
        parent::setUp();
        foreach ($existingCitiesIds as $cityId) {
            $city = (new MusementCityService)->single($cityId);
            $this->assertIsArray($city);
            $this->assertArrayHasKey("name", $city);
        }
    }

    /**
     * Test Musement not found single
     *
     * @return void
     */
    public function testMuseumCitySingleNotFoundId()
    {
        $notExistingCitiesId = "sad21";
        parent::setUp();
        $this->expectException(MusemenExceptions::class);
        (new MusementCityService)->single($notExistingCitiesId);
    }
}
