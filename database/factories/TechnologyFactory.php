<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Technology;

class TechnologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(20),
            'description' => $this->faker->text,
            'branch_type' => random_int(0, 1),
            'branch_stop_flag' => random_int(0, 1),
            'is_draft_flag' => random_int(0, 1),
            'parent_id' => random_int(0, 1)
        ];
    }
}
