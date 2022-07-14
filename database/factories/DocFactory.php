<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => random_int(0, 1),
            'bodytext' => $this->faker->name,
            'file_path' => ''
        ];
    }
}
