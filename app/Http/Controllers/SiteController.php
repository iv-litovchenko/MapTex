<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Post;
use App\Utils\FrontendUility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $posts = Post::whereParentId(null)->orderBy('sorting')->get();
        $postsWithLogo = Post::whereNotNull('logo_image')->get();
        $postTodo = Post::find(72);
        $lastNote = Note::where('note_type', Note::NOTE_TYPE_POST_COMMENT)->orderBy('id', 'desc')->first();
        return view('site.home', compact(
                'posts',
                'postsWithLogo',
                'postTodo',
                'lastNote'
            )
        );
    }

    /**
     * Страница карты сайта
     *
     * @return \Illuminate\View\View
     */
    public function sitemap()
    {
        $postsTreeArray = FrontendUility::buildTreeArray();
        return view('site.sitemap', compact('postsTreeArray'));
    }

    /**
     * Страница детального просмотра поста
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function post(Post $post)
    {
        $postNotes = Note::where('note_type', Note::NOTE_TYPE_POST_COMMENT)
            ->where('post_id', $post->id)
            ->orderBy('id', 'asc')
            ->get();
        return view('site.post', compact('post', 'postNotes'));
    }

    /**
     * Страница детального просмотра поста (форма добавить запись)
     *
     * @param Request $request
     * @param Post $post
     * @param Note $note
     * @return \Illuminate\View\View
     */
    public function postNoteStore(Request $request, Post $post, Note $note)
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

        $note->post_id = $post->id;
        $note->note_type = Note::NOTE_TYPE_POST_COMMENT;
        $note->bodytext = $request->input('bodytext');

        if ($note->save()) {
            $request->session()->flash('flash_messages_success',
                'Комментарий [' . $note->id . '] успешно добавлен!');
            return redirect()->route('site.post', $post->id);
        }

        $request->session()->flash('flash_messages_error', 'Ошибка добавления комментария!');
        return redirect()->route('site.post', $post->id)->withInput();
    }

    /**
     * Страница зарисовок
     *
     * @return \Illuminate\View\View
     */
    public function figma()
    {
        $postsWithFigmaImages = Post::whereNotNull('figma_image')
            ->orWhere('post_type', 'page-figma')
            ->get();
        return view('site.figma', compact('postsWithFigmaImages'));
    }

    /**
     * Страница список книг
     *
     * @return \Illuminate\View\View
     */
    public function book()
    {
        $images = Storage::disk('public')->files('site/book');
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

        $note->note_type = Note::NOTE_TYPE_DEFAULT;
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
            ->orderBy('id', 'desc')
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
                'upload_image.upload' => 'required|image'
            ],
            [
                // 'bodytext.*' => 'Поле с комментарием обязательно к заполнению и должно что-то содержать!',
                'upload_image.upload.*' => 'Необходимо загрузить картинку!'
            ]
        );

        // Загружаем изображение, заполняем данные
        if (auth()->check()) {
            $note->user_id = auth()->user()->id;
        }

        $note->note_type = Note::NOTE_TYPE_PIC;
        $note->bodytext = $request->input('bodytext');
        $note->upload_image = $this->fileAttachDetachService->oneFile(
            $note->upload_image,
            'upload_image',
            'site/pic'
        );

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
        $posts = [];

        if ($inputQuerySearch !== null) {
            $queryLike = $inputQuerySearch;
            $queryLike = '%' . str_ireplace(' ', '_', $queryLike) . '%';

            $posts = Post::where('name', 'like', $queryLike)
                ->orWhere('description', 'like', $queryLike)
                ->orderBy('parent_id', 'asc')
                ->orderBy('sorting', 'asc')
                ->get();
        }

        $q = $inputQuerySearch;
        return view('site.search', compact('posts', 'q'));
    }

}
