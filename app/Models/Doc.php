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
        $table->timestamps();
    }
}
