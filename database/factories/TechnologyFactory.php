<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Technology;

class TechnologyFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Technology::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        Это работать не будет!
//        $randId = 0;
//        $count = Technology::count();
//        if ($count > 10) {
//            $randId = Technology::get()->random()->id;
//        }
        return [
            'name' => $this->faker->title(20),
            'description' => $this->faker->text,
            'description_tinymce' => $this->faker->text,
            'branch_type' => random_int(0, 1),
            'branch_stop_flag' => 0,
            'is_draft_flag' => random_int(0, 1)
        ];
    }
}
