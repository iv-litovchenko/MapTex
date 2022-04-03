<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use App\Models\Note;
use App\Models\Post;
use App\Models\User;

/**
 * Контроллер для обработки страниц frontend-а
 */
class SiteController extends BaseController
{
    //    use AuthorizesRequests;
    //    use DispatchesJobs;
    //    use ValidatesRequests;

    /**
     * Главная страница
     *
     * @return \Illuminate\View\View
     */
    public function home()
    {
        return view('site.home');
    }

    /**
     * Страница детального просмотра поста
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function post(Post $post)
    {
        $images = $this->serviceFilePublic->files('site/post/' . $post->id);
        return view('site.post', compact('post', 'images'));
    }

    /**
     * Страница зарисовок
     *
     * @return \Illuminate\View\View
     */
    public function figma()
    {
        $postsWithFigmaImages = Post::where('figma_image')->get();
        return view('site.figma', compact('postsWithFigmaImages'));
    }

    /**
     * Страница список книг
     *
     * @return \Illuminate\View\View
     */
    public function book()
    {
        $images = $this->serviceFilePublic->files('site/book');
        return view('site.book', compact('images'));
    }

    /**
     * Страница барахолка (список записей)
     *
     * @return \Illuminate\View\View
     */
    public function note()
    {
        $notes = Note::where('note_type', Note::NOTE_TYPE_DEFAULT)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('site.note', compact('notes'));
    }

    /**
     * Страница барахолка (форма добавить запись)
     *
     * @param Request $request
     * @param Note $note
     * @return \Illuminate\View\View
     */
    public function noteStore(Request $request, Note $note)
    {
        // TODO Валидируем форму (она не пускает дальше)
        $request->validate(
            ['bodytext' => 'required|min:10'],
            ['bodytext.*' => 'Поле обязательно к заполнению и должно что-то содержать!']
        );

        // Заполняем данными
        if (auth()->check()) {
            $note->user_id = auth()->user()->id;
        }
        $note->note_type = Note::NOTE_TYPE_PIC;
        $note->bodytext = $request->input('bodytext');

        if ($note->save()) {
            $request->session()->flash('flash_messages_success',
                'Барахольная заметка [' . $note->id . '] успешно создана!');
            return redirect()->route('site.note');
        }

        $request->session()->flash('flash_messages_error', 'Ошибка создания барахольной заметки!');
        return redirect()->route('site.note')->withInput();
    }

    /**
     * Страница барахолка (разные картинки)
     *
     * @return \Illuminate\View\View
     */
    public function pic()
    {
        $notes = Note::where('note_type', Note::NOTE_TYPE_PIC)
            ->orderBy('id', 'asc')
            ->paginate(12);
        return view('site.pic', compact('notes'));
    }

    /**
     * Страница барахолка (разные картини) - обработка формы добавления картинки
     *
     * @param Request $request
     * @param Note $note
     * @return \Illuminate\View\View
     */
    public function picStore(Request $request, Note $note)
    {
        // TODO Валидируем форму (она не пускает дальше)
        $request->validate(
            [
                // 'bodytext' => 'required|min:5',
                'upload_image' => 'required|image'
            ],
            [
                // 'bodytext.*' => 'Поле с комментарием обязательно к заполнению и должно что-то содержать!',
                'upload_image.*' => 'Необходимо загрузить картинку!'
            ]
        );

        // Загружаем изображение, заполняем данные
        if (auth()->check()) {
            $note->user_id = auth()->user()->id;
        }
        $note->note_type = Note::NOTE_TYPE_PIC;
        $note->bodytext = $request->input('bodytext');
        $note->upload_image = $this->serviceFilePublic->attachOrDetach(false, 'upload_image', 'site/pic');

        if ($note->save()) {
            $request->session()->flash('flash_messages_success',
                'Барахольная заметка [' . $note->id . '] успешно создана!');
            return redirect()->route('site.pic');
        }

        $request->session()->flash('flash_messages_error', 'Ошибка создания барахольной заметки!');
        return redirect()->route('site.pic')->withInput();
    }

    /**
     * Страница барахолка (закрыть заметку)
     *
     * @param Request $request
     * @param Note $note
     * @return \Illuminate\View\View
     */
    public function noteOrPicClose(Request $request, Note $note)
    {
        $note->is_close = 1;
        if ($note->save()) {
            $request->session()->flash('flash_messages_success',
                'Барахольная заметка [' . $note->id . '] успешно закрыта!');
            return redirect()->back();
        }
        $request->session()->flash('flash_messages_error', 'Ошибка закрытия барахольной заметки!');
        return redirect()->back();
    }

    /**
     * Страница поиска по сайту
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $inputQuerySearch = $request->input('q');
        $queryLike = $inputQuerySearch;
        $queryLike = '%' . str_ireplace(' ', '_', $queryLike) . '%';

        $rows = [];
        if ($inputQuerySearch != '') {
            $rows = Post::where('name', 'like', $queryLike)
                ->orWhere('description', 'like', $queryLike)
                ->orderBy('parent_id', 'asc')
                ->orderBy('sorting', 'asc')
                ->get();
        }

        return view('site.search', [
            'q' => $inputQuerySearch,
            'searchResult' => $rows
        ]);
    }

}
