<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompressorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCompressor1Test()
    {
        $response = $this->json("GET", '/api/compress', ["inputString" => 'aaaabbbbcccc']);
        $response
            ->assertStatus(200)
            ->assertJson([
                'compressed' => "a4b4c4",
            ]);
    }

    public function testDecompressor1Test()
    {
        $response = $this->json("GET", '/api/decompress', ['inputString' => 'a4b4a4']);
        $response
            ->assertStatus(200)
            ->assertJson([
                'decompressed' => "aaaabbbbaaaa",
            ]);
    }

    public function testCompressor2Test()
    {
        $response = $this->json("GET", '/api/compress', ["inputString" => 'aqbbbbcccc']);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => "The given data was invalid.",
            ]);
    }

    public function testDecompressor2Test()
    {
        $response = $this->json("GET", '/api/decompress', ['inputString' => 'a4q4a4']);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => "The given data was invalid.",
            ]);
    }
}
