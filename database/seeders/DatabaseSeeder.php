<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);*/
        \App\Models\User::factory(1)->create();
        \App\Models\Note::factory(100)->create();
        \App\Models\Technology::factory(100)->create();

        // Создание дерева
        $rows = \App\Models\Technology::where('id', '>', 7)->get();
        foreach ($rows as $row) {
            $model = \App\Models\Technology::find($row->id);
            $model->parent_id = random_int(1, 5);
            $model->user_id = 1;
            $model->save();
        }
    }
}
