<?php

namespace Tests\Feature;

use Tests\TestCase;

class DeleteErrorTest extends TestCase
{

    public function test_error_delete_missing_id()
    {
        $this->json('DELETE', 'api/varos-torlese')
                ->assertStatus(404);
    }

    public function test_error_delete_wrong_id()
    {
        $this->json('DELETE', 'api/varos-torlese/alma')
                ->assertStatus(404);
    }

    public function test_error_delete_not_existing_row()
    {
        $this->json('DELETE', 'api/varos-torlese/500000')
                ->assertStatus(404)
                ->assertJson([
            'data' => "Nem létezik város ilyen azonosítóval",
        ]);
    }
}
