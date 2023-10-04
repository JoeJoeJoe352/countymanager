<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaveTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->json('POST', 'api/uj-varos')
                ->assertStatus(400)
                ->assertJson([
                    'name' => ['The email field is required.'],
                    'county_id' => ['The password field is required.'],
        ]);

    }
}
