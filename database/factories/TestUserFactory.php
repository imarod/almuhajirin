<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TestUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_admin' => 0,
        ];
    }

    public function admin(): Factory
    {
        return $this->state( fn (array $attributes) => [
            'is_admin' =>1,
        ]);
    }

    public function siswa():Factory{
        return $this->state(fn (array $attributes) => [
            'is_admin'=>0,
        ]);
    }
}
