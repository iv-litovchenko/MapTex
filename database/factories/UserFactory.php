<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

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
            'password' => Hash::make(100),
            'role' => User::ROLE_ADMIN
        ];
    }
}
