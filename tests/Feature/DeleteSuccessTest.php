<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeleteSuccessTest extends TestCase
{

    public function test_success_delete()
    {
        $this->json('POST', 'api/uj-varos', ["name" => "Bő", "county_id" => 1])
                ->assertStatus(201);

        $response = $this->json('DELETE', '/api/varos-torlese/1')
                ->assertStatus(204);
        
    }

}
