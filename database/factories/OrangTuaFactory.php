<?php

namespace Database\Factories;

use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrangTua>
 */
class OrangTuaFactory extends Factory
{
    protected $model = OrangTua::class;
    public function definition(): array
    {
        return [
            'nama_ayah' => $this->faker->name('david'),
            'nama_ibu' => $this->faker->name('fiona'),
            'alamat_ortu' => $this->faker->address,
            'no_hp_ortu' => $this->faker->phoneNumber,
        ];
    }
}
