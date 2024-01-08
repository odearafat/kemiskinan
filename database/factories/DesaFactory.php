<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'iddesa'=>$this->faker->randomnumber(10,false),
            'namadesa'=>$this->faker->word(),
            'idkecamatan'=>$this->faker->randomNumber(7,false)
            //
        ];
    }
}
