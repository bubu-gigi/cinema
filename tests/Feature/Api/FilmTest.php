<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilmTest extends TestCase
{
    public function test_example(): void
    {
        $response = $this->get('/api/films');
        $response->assertStatus(200);
    }
}
