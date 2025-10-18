<?php

namespace tests\Integration;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new Client([
            'base_uri' => 'http://localhost:8000',
            'http_errors' => false,
        ]);
    }

    public function testSumEvenWithValidNumbers(): void
    {
        $response = $this->client->post('/api/sum-even', [
            'json' => ['numbers' => [1, 2, 3, 4, 5, 6]]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $body = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('sum', $body);
        $this->assertEquals(12, $body['sum']);
    }

    public function testSumEvenWithInvalidNumbersReturnsValidationError(): void
    {
        $response = $this->client->post('/api/sum-even', [
            'json' => ['numbers' => [2.5, 4.0, 6.0, 7.5]]
        ]);

        $this->assertEquals(422, $response->getStatusCode());
        $body = json_decode($response->getBody(), true);
        $this->assertFalse($body['success']);
        $this->assertArrayHasKey('errors', $body);
        $this->assertArrayHasKey('numbers', $body['errors']);
    }
}
