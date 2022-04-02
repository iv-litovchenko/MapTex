<?php

namespace App\View\Components;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class MenuSidebar extends Component
{
    /** @var int */
    public $parentId = 0;

    /** @var string */
    public $htmlUlClass = 'nav navbar-nav';

    /**
     * Инициализируем компонент.
     *
     * @param int $parentId
     * @param string $htmlUlClass
     * @return void
     */
    public function __construct(int $parentId = 0, $htmlUlClass = '')
    {
        $this->parentId = $parentId;
        $this->htmlUlClass = $htmlUlClass;
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
            $rows = Post::whereParentId($this->parentId)->orderBy('sorting')->limit(1)->get();
        }
        $htmlUlClass = $this->htmlUlClass;
        return view('components.menusidebar', compact('rows', 'htmlUlClass'));
    }
}
