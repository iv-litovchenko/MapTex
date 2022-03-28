<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\AdminPostStoreRequest;
use App\Models\Post;

/**
 * Контроллер - управление постами
 *
 * GET|HEAD     |admin/post                    |admin.post.index      |App\Http\Controllers\Admin\postController@index|web|
 * GET|HEAD     |admin/post/{post}       |admin.post.show       |App\Http\Controllers\Admin\PostController@show|web|
 * GET|HEAD     |admin/post/create             |admin.post.create     |App\Http\Controllers\Admin\PostController@create|web|
 * POST         |admin/post                    |admin.post.store      |App\Http\Controllers\Admin\PostController@store|web|
 * GET|HEAD     |admin/post/{post}/edit  |admin.post.edit       |App\Http\Controllers\Admin\PostController@edit|web|
 * PUT|PATCH    |admin/post/{post}       |admin.post.update     |App\Http\Controllers\Admin\PostController@update|web|
 * DELETE       |admin/post/{post}       |admin.post.destroy    |App\Http\Controllers\Admin\PostController@destroy|web|
 *
 */
class PostController extends Controller
{
    /**
     * Список технологий
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        return view('admin.techology.index', compact('posts'));
    }

    /**
     * Создать новую технологию (форма)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $posts = Post::select('id', 'name')->orderBy('parent_id', 'DESC')->get();
        return view('admin.techology.create', compact('posts'));
    }

    /**
     * Создать новую технологию (процесс)
     *
     * @param \App\Http\Requests\AdminPostStoreRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function store(AdminPostStoreRequest $request, Post $post)
    {
        $post->name = $request->input('name');
        $post->parent_id = $request->input('parent_id');
        if ($post->save()) {
            $request->session()->flash('flash_messages_success',
                'Пост [' . $post->id . '] успешно создана');
            return redirect()->route('admin.post.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка создания поста');
        return redirect()->route('admin.post.create');
    }

    /**
     * Редактировать технологию (форма)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $posts = Post::select('id', 'name')->orderBy('parent_id', 'DESC')->get();
        return view('admin.techology.edit', compact('posts', 'post'));
    }

    /**
     * Обновить технологию (процесс)
     *
     * @param \App\Http\Requests\AdminPostStoreRequest $request
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
