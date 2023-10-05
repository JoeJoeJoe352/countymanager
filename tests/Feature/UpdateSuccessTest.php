<?php

namespace Tests\Feature;

use Tests\TestCase;

class UpdateSuccessTest extends TestCase
{

    public function test_success_update_ok()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Bő", "county_id" => 1])
                ->assertStatus(201);

        $this->json('PUT', 'api/varos-modositas/1', ["name" => "Almafa"])
                ->assertStatus(200);

        $json = $this->json('GET', 'api/varosok-listazasa')
                ->assertStatus(200)
                ->assertJson(["data" => true])
                ->json();

        $jsonObj = json_encode($json);
        $this->assertStringContainsString("Almafa", $jsonObj);
    }

    public function test_success_update_same_name()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Bő", "county_id" => 1])
                ->assertStatus(201);

        $this->json('PUT', 'api/varos-modositas/1', ["name" => "Bő"])
                ->assertStatus(200);
    }
}
