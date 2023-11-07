<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AdminPostStoreRequest;
use App\Http\Requests\AdminPostUpdateRequest;
use App\Models\Doc;
use App\Utils\FrontendUility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Контроллер - управление документами
 *
 */
class DocController extends BaseController
{
    /**
     * Редактировать
     *
     * @param \App\Models\Doc $doc
     * @return \Illuminate\View\View
     */
    public function edit(Doc $doc)
    {
        return view('admin.doc.edit', compact('doc', 'doc'));
    }

    /**
     * Обновить
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Doc $doc
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Doc $doc)
    {
        $doc->bodytext = $request->input('bodytext');
        $doc->category = $request->input('category');
        $doc->save();
        $request->session()->flash('flash_messages_success', 'Запись [' . $doc->id . '] успешно обновлена');
        return redirect()->back();
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
}
