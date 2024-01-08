<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KabkotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idkabkot'=>$this->faker->randomNumber(4,true),
            'namakabkot'=>$this->faker->word()
        ];
    }
}
