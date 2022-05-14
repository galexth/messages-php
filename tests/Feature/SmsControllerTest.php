<?php

namespace Tests\Feature;

use App\Models\Sms;
use Tests\TestCase;

class SmsControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/api/sms');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'phone', 'activity'],
        ]);
    }

    public function testCreate()
    {
        $response = $this->post('/api/sms', ['phone' => '123123']);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'phone' => '123123'
        ]);
    }

    public function testCreateInvalid()
    {
        $response = $this->post('/api/sms', ['invalid' => '123123']);
        $response->assertStatus(422);
        $response->assertJson([
            'phone' => [
                'The phone field is required.'
            ]
        ]);
    }

    public function testUpdate()
    {
        $sms = Sms::first();
        $response = $this->put("/api/sms/{$sms->id}", ['phone' => '3333']);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $sms->id,
            'phone' => '3333',
        ]);
    }

    public function testUpdateInvalid()
    {
        $sms = Sms::first();
        $response = $this->put("/api/sms/{$sms->id}", ['invalid' => '333']);
        $response->assertStatus(422);
        $response->assertJson([
            'phone' => [
                'The phone field is required.'
            ]
        ]);
    }

    public function testDelete()
    {
        $sms = Sms::first();
        $response = $this->delete("/api/sms/{$sms->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true
        ]);
    }
}
