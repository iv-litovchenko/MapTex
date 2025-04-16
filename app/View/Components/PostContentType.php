<?php

namespace App\View\Components;

use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class PostContentType extends Component
{
    /** @var int */
    public $currentPostId = 0;

    /** @var int|string */
    public $parentPostId;

    /** @var string */
    public $htmlHeaderSize = 0;

    /** @var Post */
    private $post;

    /**
     * Инициализируем компонент.
     *
     * @param int $currentPostId
     * @param int|string $parentPostId
     * @return void
     */
    public function __construct(
        int $currentPostId = 0,
        int|string $parentPostId = 0,
        int $htmlHeaderSize = 0
    ) {
        $this->currentPostId = $currentPostId;
        $this->parentPostId = $parentPostId;
        $this->htmlHeaderSize = $htmlHeaderSize;
    }

    /**
     * Выводим содержимое компонента
     *
     * @return \Illuminate\Contracts\View\View|void
     */
    public function render()
    {
        // return function ($date){
        // return $date['componentName'];

        // TODO <x-mindmap my-attr="val"/> сюда попадет все что не определено в конструкторе
        //  return $date['atributes'];

        // TODO сюда попадет все что будет между открывающим и закрывающим тэгом
        /** @var  $slot HtmlString */
        //        $slot = $date['slot']->toHtml();
        // <x-mindmap> --CONTENT-- </x-mindmap>
        // return $date['slot'];

        // $images = $this->serviceFilePublic->files('site/post/' . $post->id);
        // return view('components.post-page-content', compact('posts', 'images'));

        // Сценарий когда текущяя запись
        $this->post = Post::find($this->currentPostId);

        // intval(auth()->user()->id) !== 1
        // intval($post->user_id) !== 1
        if (intval($this->post->is_protected) === 1){
            if(auth()::check()){
                if(auth()->user()->id != 1 && auth()->user()->role != 1){
                    return view('components.post-content-type.page-protected', compact('post'));
                }
            } else {
                return view('components.post-content-type.page-protected', compact('post'));
            }
        }

        // Добавляем wikiContent ссылку нафайл
        $path = public_path('/interactive/content_wiki/*');
        $maptex_content_files = self::rglob($path);
        sort($maptex_content_files);
        $wikiContent = '';
        foreach($maptex_content_files as $k => $v){
            if(strstr(basename($v), "-id-".$this->post->id.".")){
                $this->post->maptex_content_link = $v;
                $this->post->maptex_content_link = str_replace(public_path('/interactive/content_wiki/'), '', $v);
            }
        }

        // Сценарий когда есть родитель
        if ($this->parentPostId == 'root' || $this->parentPostId > 0) {
            if ($this->htmlHeaderSize > 0) {
                return $this->postTypePageCheatSheetSub();
            } else {
                return $this->postTypePageMindMapSub();
            }
        }

        // intval(auth()->user()->id) !== 1
        // intval($post->user_id) !== 1
        if (intval($this->post->is_protected) === 1){
            if(auth()->user()->id !== 1 && auth()->user()->role !== 1){
                return view('components.post-content-type.page-protected'); //
            }
        }

        switch ($this->post->post_type) {
            case 'directory':
                return $this->postTypeDirectory();
            case 'page':
            default:
                return $this->postTypePage();
            case 'page-cheat-sheet':
                return $this->postTypePageCheatSheet();
            case 'page-mind-map':
                return $this->postTypePageMindMap();
        }
    }

    private function postTypeDirectory()
    {
        $post = $this->post;
        $subPosts = Post::whereParentId($this->currentPostId)->orderBy('sorting')->get();
        return view('components.post-content-type.directory', compact('post', 'subPosts'));
    }

    private function postTypePage()
    {
        $post = $this->post;
        return view('components.post-content-type.page', compact('post'));
    }

    private function postTypePageCheatSheet()
    {
        $post = $this->post;
        $subPosts = Post::whereParentId($this->currentPostId)->orderBy('sorting')->get();
        return view('components.post-content-type.page-cheat-sheet', compact('post', 'subPosts'));
    }

    private function postTypePageCheatSheetSub()
    {
        $subPosts = Post::whereParentId($this->parentPostId)->orderBy('sorting')->get();
        return view('components.post-content-type.page-cheat-sheet-sub', compact('subPosts'));
    }

    private function postTypePageMindMap()
    {
        $post = $this->post;
        return view('components.post-content-type.page-mind-map', compact('post'));
    }

    private function postTypePageMindMapSub()
    {
        if ($this->parentPostId === 'root') {
            $subPosts = Post::whereParentId(null)
                ->orderBy('sorting')
                ->get();
        } else {
            $subPosts = Post::whereParentId(intval($this->parentPostId))
                ->orderBy('sorting')
                ->get();
        }
        return view('components.post-content-type.page-mind-map-sub', compact('subPosts'));
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
}
