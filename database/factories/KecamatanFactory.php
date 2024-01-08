<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KecamatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idkecamatan'=>$this->faker->randomNumber(7,true),
            'namakecamatan'=>$this->faker->word(),
            'idkabkot'=>$this->faker->randomNumber(4,true),
        ];
    }
}
