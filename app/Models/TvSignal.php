<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class TvPosition extends Model
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
        $table->string('strategy')->nullable();
        $table->string('strategyinterval')->nullable();
        $table->string('ticker')->nullable();
        $table->dateTime('timenow')->nullable();
        $table->integer('pos_size')->nullable();
        $table->string('pos_m')->nullable();
        $table->string('open')->nullable();
        $table->string('close')->nullable();
        $table->string('volume')->nullable();
        $table->integer('stop')->nullable();
        $table->integer('stop_k_take')->nullable();
        $table->integer('quantity')->nullable();
        $table->string('comment')->nullable();
        $table->timestamps();
    }
}
