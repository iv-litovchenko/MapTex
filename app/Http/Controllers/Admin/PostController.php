<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AdminPostStoreRequest;
use App\Http\Requests\AdminPostUpdateRequest;
use App\Models\Post;
use App\Utils\FrontendUility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Контроллер - управление постами
 *
 * GET|HEAD     |admin/post                        |admin.post.index
 * GET|HEAD     |admin/post/{post}                 |admin.post.show
 * GET|HEAD     |admin/post/create                 |admin.post.create
 * POST         |admin/post                        |admin.post.store
 * GET|HEAD     |admin/post/{post}/edit            |admin.post.edit
 * PUT|PATCH    |admin/post/{post}                 |admin.post.update
 * DELETE       |admin/post/{post}                 |admin.post.destroy
 * GET          |admin/post/{post}/delete          |admin.post.delete
 *
 * GET|HEAD     |admin/post/{post}/edit/parent     |admin.post.editParent
 * PUT|PATCH    |admin/post/{post}/edit/parent     |admin.post.updateParent
 *
 * GET|HEAD     |admin/post/{post}/edit/sorting    |admin.post.editSorting
 * PUT|PATCH    |admin/post/{post}/edit/sorting    |admin.post.updateSorting
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
        $postsTreeArray = FrontendUility::buildTreeArray();
        $defaultParentId = request()->input('default_parent_id');
        return view('admin.post.create', compact(
            'postsTreeArray',
            'defaultParentId'
        ));
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
            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно создан');

            // Создать и к просмотру
            if ($request->input('redirect') == 'show') {
                return redirect()->route('site.post', $post->id);
            }

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
        $postHistoryChanges = $post->historyChanges();
        $postsTreeArray = FrontendUility::buildTreeArray();
        $postTypes = Post::POST_TYPE;
        return view('admin.post.edit', compact(
            'post',
            'postsTreeArray',
            'postTypes',
            'postHistoryChanges'
        ));
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
        $post->post_type = $request->input('post_type') ? $request->input('post_type') : null;
        $post->name = $request->input('name');
        $post->description = $request->input('description');
        $post->sorting = intval($request->input('sorting'));

        // Логотип: загрузка (отсоединение) 1 файла
        $post->logo_image = $this->fileAttachDetachService->oneFile(
            $post->logo_image,
            'logo_image',
            'site/post/logo'
        );

        // Зарисовка: загрузка (отсоединение) 1 файла
        $post->figma_image = $this->fileAttachDetachService->oneFile(
            $post->figma_image,
            'figma_image',
            'site/post/figma'
        );

        // Зарисовка (исходник): загрузка (отсоединение) 1 файла
        $post->figma_file = $this->fileAttachDetachService->oneFile(
            $post->figma_file,
            'figma_file',
            'site/post/figma/doc'
        );

        // Изображения: загрузка нескольких картинок
        $post->post_images = $this->fileAttachDetachService->manyFiles(
            $post->post_images,
            'post_images',
            'site/post/' . $post->id
        );

        if ($post->save()) {
            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно обновлен');

            // Сохранение и к просмотру
            if ($request->input('redirect') == 'show') {
                return redirect()->route('site.post', $post->id);
            }

            return redirect()->route('admin.post.edit', $post->id);
        }

        $request->session()->flash('flash_messages_error', 'Ошибка обновления поста [' . $post->id . ']');
        return redirect()->route('admin.post.edit', $post->id)->withInput();
    }

    /**
     * Удалить пост (форма)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function delete(Post $post)
    {
        return view('admin.post.delete', compact('post'));
    }

    /**
     * Удалить пост (процесс)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Post $post)
    {
        if ($post->delete()) {

            // Чистим диск (логотип)
            $path = 'site/post/logo/' . $post->logo_image;
            if (Storage::disk('public')->exists($path)) {
                // Storage::disk('public')->delete($path); Не удаляем (версионизация!)
            }

            // Чистим диск (изображения)
            $path = 'site/post/' . $post->id;
            if (Storage::disk('public')->exists($path)) {
                // Storage::disk('public')->deleteDirectory($path); Не удаляем (версионизация!)
            }

            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно удален');
            return redirect()->route('admin.post.index');
        }
        $request->session()->flash('flash_messages_error', 'Ошибка удаления поста [' . $post->id . ']');
        return redirect()->route('admin.post.index');
    }

    /**
     * Редактировать родителя (форма)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function editParent(Post $post)
    {
        $postsTreeArray = FrontendUility::buildTreeArray();
        return view('admin.post.edit-parent', compact('post', 'postsTreeArray'));
    }

    /**
     * Редактировать родителя (процесс)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function updateParent(Request $request, Post $post)
    {
        // TODO Валидируем форму (она не пускает дальше)
        $request->validate(
            ['parent_id' => 'notIn:' . $post->id],
            ['parent_id.*' => 'Запись не может быть родителем сама себе!']
        );

        $inputParentId = $request->input('parent_id');
        $post->parent_id = $inputParentId > 0 ? $inputParentId : null;
        if ($post->save()) {
            $request->session()->flash('flash_messages_success', 'Пост [' . $post->id . '] успешно обновлен');
            return redirect()->back();
        }

        $request->session()->flash('flash_messages_error', 'Ошибка обновления поста [' . $post->id . ']');
        return redirect()->back()->withInput();
    }

    /**
     * Редактировать сортировку дочек (форма)
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function editSorting(Post $post)
    {
        $posts = Post::where('parent_id', '=', $post->id)->orderBy('sorting')->get();
        return view('admin.post.edit-sorting', compact('posts', 'post'));
    }

    /**
     * Редактировать сортировку дочек (процесс)
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Routing\Redirector
     */
    public function updateSorting(Request $request, Post $post)
    {
        if (is_array($request->input('sort_list'))) {
            foreach ($request->input('sort_list') as $postId => $postNewSort) {
                $modelUpdate = Post::find($postId);
                $modelUpdate->sorting = intval($postNewSort);
                $modelUpdate->save();
            }
        }
        $request->session()->flash('flash_messages_success', 'Сортировка для [' . $post->id . '] успешно обновлена');
        return redirect()->back();
    }
}
