<?php

namespace Database\Factories;

use App\Models\Kutipan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KutipanFactory extends Factory
{
    protected $model = Kutipan::class;

    public function definition(): array
    {
        return [
            'isi_kutipan' => fake()->sentence(),
            'penulis' => fake()->name(),
        ];
    }
}
