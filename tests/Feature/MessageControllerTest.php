<?php

namespace Tests\Feature;

use Tests\TestCase;

class MessageControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/api/messages');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'count', 'page', 'per_page', 'has_more',
            'data' => [
                '*' => ['id', 'to', 'from', 'status', 'text',]
            ],
        ]);
    }
}
