<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Ivan Litovchenko',
            'email' => 'iv-litovchenko@mail.ru',
            'password' => md5(100)
        ];
    }
}
