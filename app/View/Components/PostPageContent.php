<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class PostPageCheatSheet extends Component
{
    /** @var int */
    public $currentPostId = 0;

    /**
     * Инициализируем компонент.
     *
     * @param int $currentPostId
     * @return void
     */
    public function __construct(
        int $currentPostId = 0
    ) {
        $this->currentPostId = $currentPostId;
    }

    /**
     * Выводим содержимое компонента
     *
     * @return \Illuminate\Contracts\View\View|void
     */
    public function render()
    {
        if ($this->parentId == 0) {
            $rows = Post::whereParentId(null)->orderBy('sorting')->get();
        } else {
            $rows = Post::whereParentId($this->parentId)->orderBy('sorting')->get();
        }

        $htmlUlClass = $this->htmlUlClass;
        $currentPostId = $this->currentPostId;
        return view('components.menusidebar', compact(
                'rows',
                'htmlUlClass',
                'currentPostId'
            )
        );
    }
}
