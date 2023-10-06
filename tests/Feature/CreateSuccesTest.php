<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateSuccesTest extends TestCase
{

    public function test_success_create()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Almafa", "county_id" => 1])
                ->assertStatus(201)
                ->assertJsonStructure(["data"])
                ->assertJson(["data" => 1]);
        $json = $this->json('GET', 'api/varosok-listazasa')
                ->assertStatus(200)
                ->assertJson(["data" => true])
                ->json();

        $jsonObj = json_encode($json);
        $this->assertStringContainsString("Almafa", $jsonObj);
        $this->assertStringContainsString('"county_id":1', $jsonObj);
    }

    public function test_succes_create_minimal_cityname()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Bő", "county_id" => 1])
                ->assertStatus(201)
                ->assertJsonStructure(["data"])
                ->assertJson(["data" => 1]);
    }
}
