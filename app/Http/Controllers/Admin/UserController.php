<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;

/**
 * Контроллер - управление пользователями
 *
 * GET|HEAD     |admin/user                 |admin.user.index
 * GET|HEAD     |admin/user/{user}          |admin.user.show
 * GET|HEAD     |admin/user/create          |admin.user.create
 * POST         |admin/user                 |admin.user.store
 * GET|HEAD     |admin/user/{user}/edit     |admin.user.edit
 * PUT|PATCH    |admin/user/{user}          |admin.user.update
 * GET          |admin/user/{user}/delete   |admin.user.delete
 * DELETE       |admin/user/{user}          |admin.user.destroy
 *
 */
class UserController extends BaseController
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
        return redirect()->route('admin.user.create')->withInput();
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
        return redirect()->route('admin.user.edit', $user->id)->withInput();
    }

    /**
     * Удалить пользователя (форма)
     *
     * @param \App\Models\User $model
     * @return \Illuminate\View\View
     */
    public function delete(User $user)
    {
        return view('admin.user.delete', compact('user'));
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
