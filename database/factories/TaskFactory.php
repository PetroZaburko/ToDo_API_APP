<?php

namespace Database\Factories;

use App\Models\Attachment;
use App\Models\Task;
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
            'title' =>          $this->faker->sentence(),
            'description' =>    $this->faker->sentences(3, true),
            'category_id' =>    $this->faker->numberBetween(1, 2),
            'end_date' =>       $this->faker->boolean ? $this->faker->dateTimeBetween('+2 days', '+14 days') : null,
            'importance' =>     $this->faker->numberBetween(1, 0),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Task $task) {
            $task->attachments()->saveMany(Attachment::factory(2)->create([
                'task_id' => $task->id
            ]));
        });
    }


}
