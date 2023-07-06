<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class F6Test extends TestCase
{
    public function test_endpoint_get_logout_returns_200_on_logout_success(): void
    {
        Sanctum::actingAs(User::factory()->create());
        $response = $this->postJson('/api/logout'); // geändert von getJson zu postJson
    
        $response->assertStatus(200);
    
        $response->assertJsonStructure(['message']);
    }
    
    public function test_endpoint_get_logout_returns_200_on_logout_fail(): void
    {
        $response = $this->postJson('/api/logout'); // geändert von getJson zu postJson
    
        $response->assertStatus(401);
    }
    


}
