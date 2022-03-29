<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\AdminPostStoreRequest;
use App\Http\Requests\AdminPostUpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\File;

/**
 * Контроллер - управление постами
 *
 * GET|HEAD     |admin/post              |admin.post.index      |App\Http\Controllers\Admin\postController@index|web|
 * GET|HEAD     |admin/post/{post}       |admin.post.show       |App\Http\Controllers\Admin\PostController@show|web|
 * GET|HEAD     |admin/post/create       |admin.post.create     |App\Http\Controllers\Admin\PostController@create|web|
 * POST         |admin/post              |admin.post.store      |App\Http\Controllers\Admin\PostController@store|web|
 * GET|HEAD     |admin/post/{post}/edit  |admin.post.edit       |App\Http\Controllers\Admin\PostController@edit|web|
 * PUT|PATCH    |admin/post/{post}       |admin.post.update     |App\Http\Controllers\Admin\PostController@update|web|
 * DELETE       |admin/post/{post}       |admin.post.destroy    |App\Http\Controllers\Admin\PostController@destroy|web|
 *
 */
class PostController extends BaseController
{
    /**
     * Список постов
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Создать новый пост (форма)
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $postsList = Post::select('id', 'name')->orderBy('parent_id', 'DESC')->get();
        return view('admin.post.create', compact('postsList'));
    }

    /**
     * Создать новый пост (процесс)
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
            Post::fixTree();
            $request->session()->flash('flash_messages_success',
                'Пост [' . $post->id . '] успешно создан');
            return redirect()->route('admin.post.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка создания поста');
        return redirect()->route('admin.post.create')->withInput();
    }

    /**
     * Редактировать пост (форма)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $postsList = Post::select('id', 'name')->orderBy('parent_id', 'DESC')->get();
        return view('admin.post.edit', compact('post', 'postsList'));
    }

    /**
     * Обновить пост (процесс)
     *
     * @param \App\Http\Requests\AdminPostUpdateRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function update(AdminPostUpdateRequest $request, Post $post)
    {
        $post->name = $request->input('name');
        $post->parent_id = $request->input('parent_id');
        $post->description = $request->input('description');
        $post->description_tinymce = $request->input('description_tinymce');
        $post->branch_stop_flag = intval($request->input('branch_stop_flag'));
        $post->sorting = intval($request->input('sorting'));

        //        $model = Post::find($id);
        //        if ($request->input('name') !== null) {
        //            // загрузка 1 файла (логотип)
        //            if ($file = $request->file('logo_image')) {
        //                $fileName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        //                $fileName = strtolower($fileName);
        //                $destinationPath = 'uploads/image/logo/' . $id . '/';
        //                $file->move($destinationPath, $fileName);
        //                $model->logo_image = $destinationPath . $fileName;
        //                //                $model->logo_image = Storage::disk('public')->put('/images', 'content???');
        //            }
        //
        //            $model->save();
        //
        //            // загрузка картинок в папку (в базу не пишем)
        //            if ($files = $request->file('images')) {
        //                foreach ($files as $file) {
        //                    $fileName = md5(time() . $file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
        //                    $fileName = strtolower($fileName);
        //                    $destinationPath = 'uploads/image/post/' . $id . '/';
        //                    $file->move($destinationPath, $fileName);
        //                }
        //            }
        //        }
        //
        //        $images = [];
        //        $path = public_path('uploads/image/post/' . $id . '/');
        //        if (File::exists($path)) {
        //            $images = File::files($path);
        //        }

        if ($post->save()) {
            Post::fixTree();
            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно обновлен');
            return redirect()->route('admin.post.edit', $post->id);
        }
        $request->session()->flash('flash_messages_error', 'Ошибка обновления поста [' . $post->id . ']');
        return redirect()->route('admin.post.edit', $post->id)->withInput();
    }
}
