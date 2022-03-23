<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;

/**
 * Контроллер - управление пользователями
 *
 * GET|HEAD     |admin/user              |admin.user.index      |App\Http\Controllers\Admin\UserController@index|web|
 * GET|HEAD     |admin/user/{user}       |admin.user.show       |App\Http\Controllers\Admin\UserController@show|web|
 * GET|HEAD     |admin/user/create       |admin.user.create     |App\Http\Controllers\Admin\UserController@create|web|
 * POST         |admin/user              |admin.user.store      |App\Http\Controllers\Admin\UserController@store|web|
 * GET|HEAD     |admin/user/{user}/edit  |admin.user.edit       |App\Http\Controllers\Admin\UserController@edit|web|
 * PUT|PATCH    |admin/user/{user}       |admin.user.update     |App\Http\Controllers\Admin\UserController@update|web|
 * DELETE       |admin/user/{user}       |admin.user.destroy    |App\Http\Controllers\Admin\UserController@destroy|web|
 *
 */
class UserController extends Controller
{
    /**
     * Список пользователей
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Создать нового пользователя (форма)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Создать нового пользователя (процесс)
     *
     * @param \App\Http\Requests\AdminUserStoreRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Routing\Redirector
     */
    public function store(AdminUserStoreRequest $request, User $user)
    {
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        if ($user->save()) {
            $request->session()->flash('flash_messages_success', 'Пользователь [' . $user->id . '] успешно создан');
            return redirect()->route('admin.user.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка создания пользователя');
        return redirect()->route('admin.user.create');
    }

    /**
     * Редактировать пользователя (форма)
     *
     * @param \App\Models\User $model
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Обновить пользователя (процесс)
     *
     * @param \App\Http\Requests\AdminUpdateStoreRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Routing\Redirector
     */
    public function update(AdminUserUpdateRequest $request, User $user)
    {
        $user->name = $request->input('name');
        if ($user->save()) {
            $request->session()->flash('flash_messages_success', 'Пользователь [' . $user->id . '] успешно обновлен');
            return redirect()->route('admin.user.edit', $user->id);
        }
        $request->session()->flash('flash_messages_error', 'Ошибка обновления пользователя [' . $user->id . ']');
        return redirect()->route('admin.user.edit', $user->id);
    }

    /**
     * Удалить пользователя (процесс)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, User $user)
    {
        if ($user->delete()) {
            $request->session()->flash('flash_messages_success', 'Пользователь [' . $user->id . '] успешно удален');
            return redirect()->route('admin.user.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка удаления пользователя [' . $user->id . ']');
        return redirect()->route('admin.user.index');
    }
}
