<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Todo;

class TodoController extends BaseController
{
    public function create(Request $request, )
    {
        $defaultTodoType = $request->input('todo_type', 0);
        return view('admin.todo.create', compact('defaultTodoType'));
    }

    public function store(Request $request, Todo $todo)
    {
        $todo->bodytext = $request->input('bodytext');
        $todo->todo_type = $request->input('todo_type', 0);
        if ($todo->save()) {
            $request->session()->flash('flash_messages_success', 'TODO [' . $todo->id . '] успешно создан');
            return redirect()->route('site.home');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка создания TODO');
        return redirect()->route('admin.todo.create')->withInput();
    }

    public function edit(Todo $todo)
    {
        return view('admin.todo.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->bodytext = $request->input('bodytext');
        $todo->is_close = $request->input('is_close', 0);
        $todo->todo_type = $request->input('todo_type');
        $todo->what_does_it_cost = $request->input('what_does_it_cost');
        if ($todo->save()) {
            $request->session()->flash('flash_messages_success', 'TODO [' . $todo->id . '] успешно обновлен');
            return redirect()->route('admin.todo.edit', $todo->id);
        }
        $request->session()->flash('flash_messages_error', 'Ошибка обновления TODO [' . $todo->id . ']');
        return redirect()->route('admin.todo.edit', $todo->id)->withInput();
    }
}
