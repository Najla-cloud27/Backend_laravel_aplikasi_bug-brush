<?php

namespace Tests\Feature;

use App\Models\Kutipan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KutipanTest extends TestCase
{
    use RefreshDatabase;

    public function test_anyone_can_list_kutipan(): void
    {
        Kutipan::factory()->count(3)->create();

        $response = $this->getJson('/api/kutipan');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_create_kutipan(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token', ['*'], now()->addDays(7))->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/kutipan', [
            'isi_kutipan' => 'Test quote',
            'penulis' => 'Test author',
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Kutipan berhasil ditambahkan']);
    }

    public function test_unauthenticated_user_cannot_create_kutipan(): void
    {
        $response = $this->postJson('/api/kutipan', [
            'isi_kutipan' => 'Test quote',
        ]);

        $response->assertStatus(401);
    }
}
