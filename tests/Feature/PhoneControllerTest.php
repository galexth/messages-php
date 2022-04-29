<?php

namespace Tests\Feature;

use App\Models\Phone;
use Tests\TestCase;

class PhoneControllerTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get('/api/phones');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'phone', 'activity'],
        ]);
    }

    public function test_create()
    {
        $response = $this->post('/api/phones', ['phone' => '123123']);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'phone' => '123123'
        ]);
    }

    public function test_create_invalid()
    {
        $response = $this->post('/api/phones', ['invalid' => '123123']);
        $response->assertStatus(422);
        $response->assertJson([
            'phone' => [
                'The phone field is required.'
            ]
        ]);
    }

    public function test_update()
    {
        $phone = Phone::first();
        $response = $this->put("/api/phones/{$phone->id}", ['phone' => '3333']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $phone->id,
            'phone' => '3333',
        ]);
    }

    public function test_update_invalid()
    {
        $phone = Phone::first();
        $response = $this->put("/api/phones/{$phone->id}", ['invalid' => '333']);
        $response->assertStatus(422);
        $response->assertJson([
            'phone' => [
                'The phone field is required.'
            ]
        ]);
    }

    public function test_delete()
    {
        $phone = Phone::first();
        $response = $this->delete("/api/phones/{$phone->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true
        ]);
    }
}
