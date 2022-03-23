<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\AdminTechnologyStoreRequest;
use App\Models\Technology;

/**
 * Контроллер - управление технологиями
 *
 * GET|HEAD     |admin/technology              |admin.technology.index      |App\Http\Controllers\Admin\TechnologyController@index|web|
 * GET|HEAD     |admin/technology/{user}       |admin.technology.show       |App\Http\Controllers\Admin\TechnologyController@show|web|
 * GET|HEAD     |admin/technology/create       |admin.technology.create     |App\Http\Controllers\Admin\TechnologyController@create|web|
 * POST         |admin/technology              |admin.technology.store      |App\Http\Controllers\Admin\TechnologyController@store|web|
 * GET|HEAD     |admin/technology/{user}/edit  |admin.technology.edit       |App\Http\Controllers\Admin\TechnologyController@edit|web|
 * PUT|PATCH    |admin/technology/{user}       |admin.technology.update     |App\Http\Controllers\Admin\TechnologyController@update|web|
 * DELETE       |admin/technology/{user}       |admin.technology.destroy    |App\Http\Controllers\Admin\TechnologyController@destroy|web|
 *
 */
class TechnologyController extends Controller
{
    /**
     * Список технологий
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $technologies = Technology::orderBy('id', 'DESC')->paginate(10);
        return view('admin.techology.index', compact('technologies'));
    }

    /**
     * Создать новую технологию (форма)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $technologies = Technology::select('id', 'name')->orderBy('parent_id', 'DESC')->get();
        return view('admin.techology.create', compact('technologies'));
    }

    /**
     * Создать новую технологию (процесс)
     *
     * @param \App\Http\Requests\AdminTechnologyStoreRequest $request
     * @param \App\Models\Technology $technology
     * @return \Illuminate\Routing\Redirector
     */
    public function store(AdminTechnologyStoreRequest $request, Technology $technology)
    {
        $technology->name = $request->input('name');
        $technology->parent_id = $request->input('parent_id');
        if ($technology->save()) {
            $request->session()->flash('flash_messages_success',
                'Технология [' . $technology->id . '] успешно создана');
            return redirect()->route('admin.technology.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка создания технологии');
        return redirect()->route('admin.technology.create');
    }

    /**
     * Редактировать технологию (форма)
     *
     * @param \App\Models\Technology $technology
     * @return \Illuminate\View\View
     */
    public function edit(Technology $technology)
    {
        $technologies = Technology::select('id', 'name')->orderBy('parent_id', 'DESC')->get();
        return view('admin.techology.edit', compact('technologies', 'technology'));
    }

    /**
     * Обновить технологию (процесс)
     *
     * @param \App\Http\Requests\AdminTechnologyStoreRequest $request
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
}
