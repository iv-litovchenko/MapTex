<?php

use Antonrom\ModelChangesHistory\Models\Change;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelChangesHistoryTable extends Migration
{
    protected $tableName = 'model_changes_history';

    public function __construct()
    {
        // $this->connection = config('model_changes_history.stores.database.connection', null);
        // $this->tableName  = config('model_changes_history.stores.database.table', 'model_changes_history');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('model_id');
            $table->string('model_type');

            $table->text('before_changes')->nullable();
            $table->text('after_changes')->nullable();

            $table->text('changes')->nullable();

            $table->enum('change_type', Change::getTypes());

            $table->string('changer_type')->nullable();
            $table->unsignedBigInteger('changer_id')->nullable();

            $table->text('stack_trace')->nullable();

            $table->timestamp(Model::CREATED_AT);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop($this->tableName);
    }
}
