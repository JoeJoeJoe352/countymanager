<?php

namespace Tests\Feature;

use Tests\TestCase;

class CreateSuccesTest extends TestCase
{

    public function test_success_create()
    {
        $this->json('POST', 'api/uj-varos', ["name"=>"Bő", "county_id"=>1])
                ->assertStatus(201)
                ->assertJsonStructure(["data"])
                ->assertJson(["data"=>1]);
    }
}
