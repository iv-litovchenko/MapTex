<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;

class Todo extends Model
{
    use HasFactory;

    const TODO_TYPE_BLUE = 0;
    const TODO_TYPE_GREEN = 1;
    const TODO_TYPE_YELLOW = 2;
    const TODO_TYPE_RED = 3;

    static public function getTypeOptions()
    {
        return [
            self::TODO_TYPE_BLUE => 'Расписание',
            self::TODO_TYPE_GREEN => 'Зеленый (актуально)',
            self::TODO_TYPE_YELLOW => 'Желтый (по возможности)',
            self::TODO_TYPE_RED => 'Красный (долгосрок)',
        ];
    }

    static public function getTypeMapper()
    {
        return [
            self::TODO_TYPE_BLUE => 'info',
            self::TODO_TYPE_GREEN => 'success',
            self::TODO_TYPE_YELLOW => 'warning',
            self::TODO_TYPE_RED => 'danger',
        ];
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
        $table->integer('is_close')->default(0);
        $table->text('bodytext')->nullable();
        $table->integer('todo_type')->default(0);
        $table->timestamps();
    }
}
