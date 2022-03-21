<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuikapiPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quikapi_positions', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quikapi_positions');
    }
}
