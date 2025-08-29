<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrangTua;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrangTua>
 */
class OrangTuaFactory extends Factory
{
    protected $model = OrangTua::class;
    public function definition(): array
    {
        return [
            'nama_ayah' => fake()->name('male'),
            'nama_ibu'=>fake()->name('female'),
            'alamat_ortu' =>fake()->address(),
            'no_hp_ortu' => '+628' .fake()->numerify('##########')
        ];
    }
}
