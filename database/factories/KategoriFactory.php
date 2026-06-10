<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriFactory extends Factory
{
    protected $model = Kategori::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama_kategori' => fake()->word(),
            'warna' => fake()->hexColor(),
        ];
    }
}
