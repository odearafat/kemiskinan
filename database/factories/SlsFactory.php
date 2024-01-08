<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SlsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idsls'=>$this->faker->randomNumber(14,false),
            'namasls'=>$this->faker->word(),
            'iddesa'=>$this->faker->randomNumber(10,false)
            //
        ];
    }
}
