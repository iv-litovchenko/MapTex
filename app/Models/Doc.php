<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;

class Doc extends Model
{
    use HasFactory;

    static public function getCategories()
    {
        $content = file_get_contents(app_path('Models/Doc.Cat.txt'));
        return explode(chr(10), $content);
    }

    /**
     * Run the migrations.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->id();
        $table->integer('user_id')->nullable();
        $table->integer('note_type')->default(0);
        $table->text('bodytext')->nullable();
        $table->text('file_path')->nullable();
        $table->integer('category')->nullable()->default(0);
        $table->timestamps();
    }
}
