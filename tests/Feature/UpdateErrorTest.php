<?php

namespace Tests\Feature;

use Tests\TestCase;

class UpdateErrorTest extends TestCase
{

    public function test_error_update_empty()
    {
        $this->json('PUT', 'api/varos-modositas')
                ->assertStatus(404);
    }

    public function test_error_update_not_existing_city_id()
    {
        $this->json('PUT', 'api/varos-modositas/100000')
                ->assertStatus(404)
                ->assertJson([
                    'data' => "Nem létezik város ilyen azonosítóval",
        ]);
    }

    public function test_error_update_empty_cityname()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Bő", "county_id" => 1])
                ->assertStatus(201);

        $this->json('PUT', 'api/varos-modositas/1', ["name" => ""])
                ->assertStatus(203)
                ->assertJson([
                    'data' => ["name" => ["Városnevet kötelező megadni!"]],
        ]);
    }

    public function test_error_update_empty_payload()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Bő", "county_id" => 1])
                ->assertStatus(201);

        $this->json('PUT', 'api/varos-modositas/1')
                ->assertStatus(203)
                ->assertJson([
                    'data' => ["name" => ["Városnevet kötelező megadni!"]],
        ]);
    }   
    
}
