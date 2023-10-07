<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateErrorTest extends TestCase
{

    public function test_error_creating_empty()
    {
        $this->json('POST', 'api/uj-varos')
                ->assertStatus(200)
                ->assertJson([
                    "data" => [
                        'name' => ['Városnevet kötelező megadni!'],
                        'county_id' => ['Megyenevet kötelező megadni!'],
                    ]
        ]);
    }

    public function test_error_creating_wrong_county()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "alma", "county_id" => 10000])
                ->assertStatus(200)
                ->assertJson([
                    "data" => [
                        'county_id' => ['Érvénytelen megyenév!'],
                    ]
        ]);
    }

    public function test_error_creating_empty_cityname()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "", "county_id" => 1])
                ->assertStatus(200)
                ->assertJson([
                    "data" => [
                        'name' => ["Városnevet kötelező megadni!"],
                    ]
        ]);
    }

    public function test_error_creating_too_short_cityname()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "a", "county_id" => 1])
                ->assertStatus(200)
                ->assertJson([
                    "data" => [
                        'name' => ["Városnév legalább két karakter legyen!"],
                    ]
        ]);
    }

    public function test_error_creating_not_int_county()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Bő", "county_id" => "körte"])
                ->assertStatus(200)
                ->assertJson([
                    "data" => [
                        'county_id' => ["Érvénytelen megyenév!"],
                    ]
        ]);
    }

    public function test_error_creating_too_long_cityname()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456alma123456", "county_id" => 1])
                ->assertStatus(200)
                ->assertJson([
                    "data" => [
                        'name' => ["Városnév túl hosszú!"],
                    ]
        ]);
    }

    public function test_error_creating_not_unique_cityname()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "alma", "county_id" => 1])
                ->assertStatus(201);

        $this->json('POST', 'api/uj-varos', ["name" => "alma", "county_id" => 1])
                ->assertStatus(200)
                ->assertJson([
                    "data" => [
                        'name' => ["Városnév foglalt!"],
                    ]
        ]);
    }
}
