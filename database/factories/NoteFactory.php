<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Note;

class NoteFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        switch (random_int(0, 1)) {
            case Note::NOTE_TYPE_DEFAULT:
                return [
                    'user_id' => random_int(0, 1),
                    'bodytext' => $this->faker->text,
                    'note_type' => Note::NOTE_TYPE_DEFAULT
                ];
            case Note::NOTE_TYPE_PIC:
                return [
                    'user_id' => random_int(0, 1),
                    'bodytext' => $this->faker->name,
                    'note_type' => Note::NOTE_TYPE_PIC,
                    'upload_image' => 'img/example-image.png'
                ];
        }
    }
}
