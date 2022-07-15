<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use function app_storage;

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

        // DB::disableForeignKeyConstrains();
        DB::statement("SET foreign_key_checks=0");

        \App\Models\User::truncate(); // truncate
        \App\Models\User::factory(1)->create();

        \App\Models\Note::truncate(); // truncate
        \App\Models\Note::factory(100)->create();

        \App\Models\Post::truncate(); // truncate
        \App\Models\Post::factory(100)->create();

        \App\Models\Book::truncate(); // truncate
        \App\Models\Book::factory(30)->create();

        \App\Models\Doc::truncate(); // truncate
        \App\Models\Doc::factory(10)->create();

        DB::statement("SET foreign_key_checks=1");

        // Создание дерева
        $rows = \App\Models\Post::where('id', '>', 7)->get();
        foreach ($rows as $row) {
            $model = \App\Models\Post::find($row->id);
            $nodeId = random_int(2, 10); // !!! Cannot move node into itself.
            if ($nodeId !== $row->id) {
                $model->parent_id = $nodeId;
            }
            $model->save();
        }

        // Копируем картинку (логотип для постов)
        if (!File::exists('storage/app/public/example-image.png')) {
            File::copy(
                'resources/assets/images/example-image.png',
                'storage/app/public/example-image.png'
            );
        }

        // Наполнение таблицы сигналов
        DB::table('tv_signals')->insert([
            'strategy' => 'RTS'
        ]);
    }
}
