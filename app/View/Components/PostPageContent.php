<?php

namespace App\View\Components;

use App\Services\FilePublicService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class PostPageContent extends Component
{
    /** @var int */
    public $currentPostId = 0;

    /** @var int */
    public $parentPostId = 0;

    /** @var FilePublicService */
    public $serviceFilePublic;

    /**
     * Инициализируем компонент.
     *
     * @param int $currentPostId
     * @param int $parentPostId
     * @return void
     */
    public function __construct(
        int $currentPostId = 0,
        int $parentPostId = 0
    ) {
        $this->currentPostId = $currentPostId;
        $this->parentPostId = $parentPostId;
        $this->serviceFilePublic = new FilePublicService();
    }

    /**
     * Выводим содержимое компонента
     *
     * @return \Illuminate\Contracts\View\View|void
     */
    public function render()
    {
        if ($this->currentPostId > 0) {
            $posts = Post::whereId($this->currentPostId)->get();
        } elseif ($this->parentPostId > 0) {
            $posts = Post::whereParentId($this->parentPostId)->orderBy('sorting')->get();
        }
        // $images = $this->serviceFilePublic->files('site/post/' . $post->id);
        $images = [];
        return view('components.post-page-content', compact('posts', 'images'));
    }
}
