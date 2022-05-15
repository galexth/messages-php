<?php

namespace Tests\Feature;

use App\Models\Phone;
use Tests\TestCase;

class PhoneControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->getJson('/api/phones');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'phone', 'activity'],
        ]);
    }

    public function testCreate()
    {
        $response = $this->postJson('/api/phones', ['phone' => '123123']);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'phone' => '123123'
        ]);
    }

    public function testCreateInvalid()
    {
        $response = $this->postJson('/api/phones', ['invalid' => '123123']);
        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The phone field is required.",
            'errors' => [
                'phone' => [
                    'The phone field is required.'
                ]
            ]
        ]);
    }

    public function testUpdate()
    {
        $phone = Phone::first();
        $response = $this->putJson("/api/phones/{$phone->id}", ['phone' => '3333']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $phone->id,
            'phone' => '3333',
        ]);
    }

    public function testUpdateInvalid()
    {
        $phone = Phone::first();
        $response = $this->putJson("/api/phones/{$phone->id}", ['invalid' => '333']);
        $response->assertStatus(422);
        $response->assertJson([
            "message" => "The phone field is required.",
            'errors' => [
                'phone' => [
                    'The phone field is required.'
                ]
            ]
        ]);
    }

    public function testDelete()
    {
        $phone = Phone::first();
        $response = $this->deleteJson("/api/phones/{$phone->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true
        ]);
    }
}
