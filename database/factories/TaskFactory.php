<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
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
            'title' => $this->faker->text(20),
            'description' => $this->faker->text(255),
            'status' => $this->faker->randomElement([Task::DOING, Task::TODO]),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
