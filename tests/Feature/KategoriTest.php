<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    private function authenticatedUser(): array
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token', ['*'], now()->addDays(7))->plainTextToken;
        return [$user, $token];
    }

    private function authHeaders(string $token): array
    {
        return ['Authorization' => 'Bearer ' . $token];
    }

    public function test_user_can_create_kategori(): void
    {
        [$user, $token] = $this->authenticatedUser();

        $response = $this->withHeaders($this->authHeaders($token))
            ->postJson('/api/kategori', [
                'nama_kategori' => 'Belajar',
                'warna' => '#FF5733',
            ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Kategori berhasil ditambahkan']);
    }

    public function test_user_can_list_own_kategori(): void
    {
        [$user, $token] = $this->authenticatedUser();
        Kategori::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->withHeaders($this->authHeaders($token))
            ->getJson('/api/kategori');

        $response->assertStatus(200);
    }

    public function test_user_cannot_see_other_users_kategori(): void
    {
        [$user, $token] = $this->authenticatedUser();
        $otherUser = User::factory()->create();
        Kategori::factory()->create(['user_id' => $otherUser->id, 'nama_kategori' => 'Pribadi']);

        $response = $this->withHeaders($this->authHeaders($token))
            ->getJson('/api/kategori');

        $response->assertStatus(200);
        $this->assertCount(0, $response->json()['data']);
    }

    public function test_user_can_update_own_kategori(): void
    {
        [$user, $token] = $this->authenticatedUser();
        $kategori = Kategori::factory()->create(['user_id' => $user->id]);

        $response = $this->withHeaders($this->authHeaders($token))
            ->putJson("/api/kategori/{$kategori->id}", [
                'nama_kategori' => 'Diupdate',
                'warna' => '#000000',
            ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Kategori berhasil diupdate']);
    }

    public function test_user_can_delete_own_kategori(): void
    {
        [$user, $token] = $this->authenticatedUser();
        $kategori = Kategori::factory()->create(['user_id' => $user->id]);

        $response = $this->withHeaders($this->authHeaders($token))
            ->deleteJson("/api/kategori/{$kategori->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Kategori berhasil dihapus']);
    }
}
