<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteBookStoreRequest;
use App\Http\Requests\SiteDocStoreRequest;
use App\Models\Book;
use App\Models\Doc;
use App\Models\Note;
use App\Models\Post;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $postsWithLogo = Post::whereNotNull('logo_image')->orderBy('sorting', 'asc')->get();
        $postsWithStudyStatus = Post::where('study_status', '>', 0)->get();

        // $postTodo = Post::find(72);
        // $lastNote = Note::where('note_type', Note::NOTE_TYPE_POST_COMMENT)->orderBy('id', 'desc')->first();

        $todos = Todo::orderBy('is_close', 'desc')->orderBy('created_at', 'desc')->get();
        $todoReadmeMdContent = file_get_contents(base_path('README.md'));
        return view('site.home', compact(
                'posts',
                'postsWithLogo',
                'postsWithStudyStatus',
                'todoReadmeMdContent',
                'todos'
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
        $postsList = Post::orderBy('sorting', 'asc')->get()->toTree();
        return view('site.sitemap', compact('postsList'));
    }

    /**
     * Страница генератор pwd
     *
     * @param Request $request
     * 
     * @return \Illuminate\View\View
     */
    public function pwdgen(Request $request)
    {
        if ($request->isMethod('post')){
            $service_name = $request->input('service_name');
            $prefix_name = $request->input('prefix_name');

            $pwd = Hash::make($service_name  . $prefix_name);
            $request->session()->flash('flash_messages_success', $pwd);
        }

        $test = 1;
        return view('site.pwdgen', compact('test'));
    }

    /**
     * Страница детального просмотра поста
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\View\View
     */
    public function post(Post $post)
    {
        $postsWithLogo = Post::whereNotNull('logo_image')->get();
        $postNotes = Note::where('note_type', Note::NOTE_TYPE_POST_COMMENT)
            ->where('post_id', $post->id)
            ->orderBy('id', 'asc')
            ->get();

        // intval(auth()->user()->id) !== 1
        // intval($post->user_id) !== 1
        // if (intval($post->is_protected) === 1) {
        //     return view('site.post-protected');
        // }

        $path = public_path('/interactive/content_wiki/*');
        $maptex_content_files = self::rglob($path);
        sort($maptex_content_files);
        $wikiContent = '';
        foreach($maptex_content_files as $k => $v){
            if(strstr(basename($v, "-id-".$post->id."."))){
                $post->maptex_content_link = $v;
                // $maptex_content_files[$k] = str_replace(public_path('/interactive/content_wiki/'), '', $v);
                print $post->maptex_content_link;
                exit();
            }
        }


        return view('site.post', compact('post', 'postNotes', 'postsWithLogo'));
    }

    protected static function rglob($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge(
                [],
                ...[$files, self::rglob($dir . "/" . basename($pattern), $flags)]
            );
        }
        return $files;
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
        return false;

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
        // $images = Storage::disk('public')->files('site/book');
        $books = Book::orderBy('id', 'asc')->get();
        return view('site.book', compact('books'));
    }

    /**
     * Страница список книг (добавить)
     *
     * @param SiteBookStoreRequest $request
     * @param Book $book
     * @return \Illuminate\View\View
     */
    public function bookStore(SiteBookStoreRequest $request, Book $book)
    {
        // $book->bodytext = $request->input('bodytext');
        $book->image_path = $this->fileAttachDetachService->oneFile(
            null,
            'image_path',
            'site/book',
            'public'
        );

        if ($book->save()) {
            $request->session()->flash('flash_messages_success', 'Книга успешно [' . $book->id . '] добавлена!');
            return redirect()->route('site.book');
        }

        $request->session()->flash('flash_messages_error', 'Ошибка добавления книги!');
        return redirect()->route('site.book')->withInput();
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

    /**
     * Страница список документов
     *
     * @return \Illuminate\View\View
     */
    public function doc($cat = 0)
    {
        // $docs = Storage::disk('protected')->files('site/doc');
        if(intval($cat) >= 1){
            $docs = Doc::orderBy('id', 'asc')->where('category', $cat)->get();
        } else {
            $docs = Doc::orderBy('id', 'asc')->where('category', '<', 1)->orWhereNull('category')->get();
        }
        return view('site.doc', compact('docs', 'cat'));
    }

    /**
     * Страница список документов (добавить)
     *
     * @param SiteDocStoreRequest $request
     * @param Doc $doc
     * @return \Illuminate\View\View
     */
    public function docStore(SiteDocStoreRequest $request, Doc $doc)
    {
        foreach ($request->file('file_path') as $file) {
            $filename = $file->getClientOriginalName();
            break;
        }

        $doc->bodytext = $filename;
        $doc->category = intval($request->input('category'));
        $doc->file_path = $this->fileAttachDetachService->oneFile(
            null,
            'file_path',
            'site/doc',
            'protected'
        );

        if ($doc->save()) {
            $request->session()->flash('flash_messages_success', 'Документ успешно [' . $doc->id . '] добавлен!');
            return redirect()->route('site.doc');
        }

        $request->session()->flash('flash_messages_error', 'Ошибка создания документа!');
        return redirect()->route('site.doc')->withInput();
    }

    /**
     * Страница список документов (скачать)
     *
     * @param Doc $doc
     * @return void
     */
    public function docDownload(Doc $doc)
    {
        $filePath = storage_path() . '/app/protected/' . $doc->file_path;
        $fileExt = explode('.', basename($doc->file_path));
        $fileExt = end($fileExt);
        return response()->download($filePath, $doc->bodytext . '.' . $fileExt, ['header' => $doc->bodytext]);
    }

    /**
     * Проект
     *
     * @return \Illuminate\View\View
     */
    public function project()
    {
        return view('site.project');
    }

    /**
     * Страница "Технологии"
     *
     * @return \Illuminate\View\View
     */
    public function technology()
    {
        $path = public_path('/interactive/technologies/*/index.php');
        $technologies = glob($path);
        sort($technologies);

        $content = [];
        foreach($technologies as $k => $v) {
            ob_start();
            include $v;
            $string = ob_get_clean();

            $pathinfo = pathinfo( $v, PATHINFO_DIRNAME);
            $pathinfo = explode('/', $pathinfo);
            $pathinfo = end($pathinfo);

            $content[] = [
                'name' => $pathinfo,
                'path' => $v,
                'content_exec' => $string,
                'content_file_get' => file_get_contents($v)
            ];
        }

        return view('site.technology', compact('content'));
    }
}
