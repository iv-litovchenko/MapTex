<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'is_close' => rand(0, 1),
            'bodytext' => $this->faker->name,
            'todo_type' => rand(0, 3),
            'what_does_it_cost' => 10.00
        ];
    }
}
