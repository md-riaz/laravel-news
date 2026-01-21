<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function test_health_check_endpoint_returns_ok(): void
    {
        $response = $this->getJson('/health');

        $response
            ->assertOk()
            ->assertJson([
                'app' => config('app.name'),
                'database' => 'ok',
                'status' => 'ok',
                'version' => app()->version(),
            ]);
    }
}
