<?php

namespace App\View\Components;

use App\Services\FilePublicService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class PostContentType extends Component
{
    /** @var int */
    public $currentPostId = 0;

    /** @var int */
    public $parentPostId = 0;

    /** @var string */
    public $htmlHeaderSize = 2;

    /** @var FilePublicService */
    private $serviceFilePublic;

    /** @var Post */
    private $post;

    /**
     * Инициализируем компонент.
     *
     * @param int $currentPostId
     * @param int $parentPostId
     * @return void
     */
    public function __construct(
        int $currentPostId = 0,
        int $parentPostId = 0,
        int $htmlHeaderSize = 2
    ) {
        $this->currentPostId = $currentPostId;
        $this->parentPostId = $parentPostId;
        $this->htmlHeaderSize = $htmlHeaderSize;
        $this->serviceFilePublic = new FilePublicService();
    }

    /**
     * Выводим содержимое компонента
     *
     * @return \Illuminate\Contracts\View\View|void
     */
    public function render()
    {
        // $images = $this->serviceFilePublic->files('site/post/' . $post->id);
        // return view('components.post-page-content', compact('posts', 'images'));
        if ($this->parentPostId > 0) {
            return $this->postTypePageCheatSheetSub();
        }

        $this->post = Post::find($this->currentPostId);
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
}
