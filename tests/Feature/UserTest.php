<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase; // Reset database setelah setiap test
    use WithFaker;

    /**
     * Test mendapatkan semua user
     */
    public function test_get_all_users()
    {
        User::factory()->count(3)->create(); // Membuat 3 user dummy
        
        $response = $this->getJson('/api/users'); // Request ke endpoint
        
        $response->assertStatus(200) // Pastikan respons sukses
                 ->assertJsonCount(3, 'data'); // Pastikan ada 3 data user
    }

    /**
     * Test mendapatkan user berdasarkan ID
     */
    public function test_get_user_by_id()
    {
        $user = User::factory()->create(); // Buat user dummy
        
        $response = $this->getJson("/api/users/{$user->id}");
        
        $response->assertStatus(200)
                 ->assertJson([
                     'code' => 200,
                     'success' => true,
                     'message' => "Berhasil mengambil data",
                     'data' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'age' => $user->age
                     ]
                 ]);
    }

    /**
     * Test validasi gagal saat mengambil user berdasarkan ID tidak valid
     */
    public function test_get_user_by_id_validation_fails()
    {
        $user = User::factory()->create(); // Buat user dummy
        
        $response = $this->getJson("/api/users/invalid-id");
        
        $response->assertStatus(404)
                 ->assertJson([
                     'code' => 404,
                     'success' => false,
                     'message' => "Data tidak ditemukan",
                     'errors' => []
                 ]);
    }

    /**
     * Test menambahkan user baru
     */
    public function test_create_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'age' => rand(18, 60),
        ];

        $response = $this->postJson('/api/users', $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'code' => 200,
                     'success' => true,
                     'message' => "Berhasil menambahkan data",
                     'data' => $data
                 ]);
    }

    /**
     * Test validasi gagal saat membuat user baru
     */
    public function test_create_user_validation_fails()
    {
        $response = $this->postJson('/api/users', []); // Kirim data kosong

        $response->assertStatus(422) // Pastikan status validasi gagal
                 ->assertJsonValidationErrors(['name', 'email', 'age']);
    }

    /**
     * Test update user berdasarkan ID
     */
    public function test_update_user()
    {
        $user = User::factory()->create(); // Buat user dummy
        
        $update_data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'age' => 30,
        ];

        $response = $this->putJson("/api/users/{$user->id}", $update_data);

        $response->assertStatus(200)
                 ->assertJson([
                     'code' => 200,
                     'success' => true,
                     'message' => "Berhasil mengubah data",
                     'data' => $update_data
                 ]);
    }

    /**
     * Test validasi gagal saat mengubah user berdasarkan ID tidak valid
     */
    public function test_update_user_validation_fails()
    {
        $user = User::factory()->create(); // Buat user dummy
        
        $response = $this->deleteJson("/api/users/invalid-id");
        
        $response->assertStatus(404)
                 ->assertJson([
                     'code' => 404,
                     'success' => false,
                     'message' => "Data tidak ditemukan",
                     'errors' => []
                 ]);
    }

    /**
     * Test menghapus user berdasarkan ID
     */
    public function test_delete_user()
    {
        $user = User::factory()->create(); // Buat user dummy
        
        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'code' => 200,
                     'success' => true,
                     'message' => "Berhasil menghapus data",
                     'data' => []
                 ]);
        
        $this->assertDatabaseMissing('users', ['id' => $user->id]); // Pastikan data sudah terhapus
    }

    /**
     * Test validasi gagal saat menghapus user berdasarkan ID tidak valid
     */
    public function test_delete_user_validation_fails()
    {
        $user = User::factory()->create(); // Buat user dummy
        
        $response = $this->deleteJson("/api/users/invalid-id");
        
        $response->assertStatus(404)
                 ->assertJson([
                     'code' => 404,
                     'success' => false,
                     'message' => "Data tidak ditemukan",
                     'errors' => []
                 ]);
    }
}
