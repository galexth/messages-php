<?php

namespace Tests\Feature;

use App\Models\Email;
use Tests\TestCase;

class EmailControllerTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get('/api/emails');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'email', 'activity'],
        ]);
    }

    public function test_create()
    {
        $response = $this->post('/api/emails', [
            'email' => 'test@test.ru',
            'settings' => [
                'send' => [
                    'host' => 'smtp.gmail.com',
                    'port' => 465,
                    'login' => 'test@test.ru',
                    'password' => '123',
                    'secure' => true
                ]
            ]
        ]);
        $response->assertStatus(201);
        $response->assertJsonFragment([
            'email' => 'test@test.ru',
            'settings' => [
                'send' => [
                    'host' => 'smtp.gmail.com',
                    'port' => 465,
                    'login' => 'test@test.ru',
                    'password' => '123',
                    'secure' => true
                ]
            ]
        ]);
    }

    public function test_create_invalid()
    {
        $response = $this->post('/api/emails', ['invalid' => '123123']);
        $response->assertStatus(422);
    }

    public function test_update()
    {
        $email = Email::first();
        $response = $this->put("/api/emails/{$email->id}", [
            'email' => $email->email,
            'settings' => [
                'send' => [
                    'host' => 'smtp.gmail.com',
                    'port' => 465,
                    'login' => $email->email,
                    'password' => '333',
                    'secure' => false
                ]
            ]
        ]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'email' => $email->email,
            'settings' => [
                'send' => [
                    'host' => 'smtp.gmail.com',
                    'port' => 465,
                    'login' => $email->email,
                    'password' => '333',
                    'secure' => false
                ]
            ]
        ]);
    }

    public function test_update_invalid()
    {
        $email = Email::first();
        $response = $this->put("/api/emails/{$email->id}", ['invalid' => '333']);
        $response->assertStatus(422);
    }

    public function test_delete()
    {
        $email = Email::first();
        $response = $this->delete("/api/emails/{$email->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true
        ]);
    }
}
