<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnParentIdToTechnologies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->default(null)->change();
            $table->index('parent_id', 'technology_parent_idx');
            $table->foreign('parent_id', 'technology_parent_fk')->on('technologies')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('technologies', function (Blueprint $table) {
            // TODO последовательность удаления важна!
            $table->dropForeign('technology_parent_fk');
            $table->dropIndex('technology_parent_idx');
        });
    }
}
