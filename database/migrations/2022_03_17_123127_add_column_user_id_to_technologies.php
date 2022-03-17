<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserIdToTechnologies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('technologies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('parent_id');
            $table->index('user_id', 'technology_user_idx');
            $table->foreign('user_id', 'technology_user_fk')->on('users')->references('id');
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
            $table->dropForeign('technology_user_fk');
            $table->dropIndex('technology_user_idx');
            $table->dropColumn('user_id');
        });
    }
}
