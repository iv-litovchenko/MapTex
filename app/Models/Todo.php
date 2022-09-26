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

    const TODO_TYPE_GLOBAL_BLUE = 0;
    const TODO_TYPE_GLOBAL_GREEN = 1;
    const TODO_TYPE_GLOBAL_YELLOW = 2;
    const TODO_TYPE_GLOBAL_RED = 3;
    const TODO_TYPE_GLOBAL_EDUCATION = 4;

    static public function getTypeGlobalOptions()
    {
        return [
            self::TODO_TYPE_GLOBAL_BLUE => 'Расписание',
            self::TODO_TYPE_GLOBAL_GREEN => 'Зеленый (актуально)',
            self::TODO_TYPE_GLOBAL_YELLOW => 'Желтый (по возможности)',
            self::TODO_TYPE_GLOBAL_RED => 'Красный (долгосрок)',
            self::TODO_TYPE_GLOBAL_EDUCATION => 'Образование'
        ];
    }

    static public function getTypeGlobalMapper()
    {
        return [
            self::TODO_TYPE_GLOBAL_BLUE => 'info',
            self::TODO_TYPE_GLOBAL_GREEN => 'success',
            self::TODO_TYPE_GLOBAL_YELLOW => 'warning',
            self::TODO_TYPE_GLOBAL_RED => 'danger',
            self::TODO_TYPE_GLOBAL_EDUCATION => 'default'
        ];
    }

    const TODO_TYPE_BLUE = 0;
    const TODO_TYPE_GREEN = 1;
    const TODO_TYPE_YELLOW = 2;
    const TODO_TYPE_RED = 3;
    const TODO_TYPE_EDUCATION = 4;

    static public function getTypeOptions()
    {
        return [
            self::TODO_TYPE_BLUE => 'Расписание',
            self::TODO_TYPE_GREEN => 'Зеленый (актуально)',
            self::TODO_TYPE_YELLOW => 'Желтый (по возможности)',
            self::TODO_TYPE_RED => 'Красный (долгосрок)',
            self::TODO_TYPE_EDUCATION => 'Образование'
        ];
    }

    static public function getTypeMapper()
    {
        return [
            self::TODO_TYPE_BLUE => 'info',
            self::TODO_TYPE_GREEN => 'success',
            self::TODO_TYPE_YELLOW => 'warning',
            self::TODO_TYPE_RED => 'danger',
            self::TODO_TYPE_EDUCATION => 'default'
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
        $table->integer('todo_type_global')->default(0);
        $table->integer('todo_type')->default(0);
        $table->float('what_does_it_cost')->default(0.00);
        $table->timestamps();
    }
}
