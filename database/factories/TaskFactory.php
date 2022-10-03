<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>          $this->faker->title(),
            'description' =>    $this->faker->sentence(),
            'category_id' =>    $this->faker->numberBetween(1, 2),
            'end_date' =>       $this->faker->boolean ? $this->faker->dateTimeBetween('+2 days', '+14 days') : null,
            'importance' =>     $this->faker->numberBetween(1, 0),
        ];
    }
}
