<?php

namespace App\View\Components;

use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class MenuSidebar extends Component
{
    /** @var int */
    public $startParentId = 0;

    /** @var int */
    public $currentPostId = 0;

    /** @var string */
    public $htmlUlClass = 'nav navbar-nav';

    /**
     * Инициализируем компонент.
     *
     * @param int $parentId
     * @param int $currentPostId
     * @param string $htmlUlClass
     * @return void
     */
    public function __construct(
        int $parentId = 0,
        int $currentPostId = 0,
        $htmlUlClass = 'nav navbar-nav'
    ) {
        $this->parentId = $parentId;
        $this->currentPostId = $currentPostId;
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

    public function isActive($currentRowId = 0, $currentPostId = 0)
    {
        // Проверка активности пункта меню для текущего раздела
        if ($currentRowId == $currentPostId) {
            return true;
        }
        // Проверка активности пункта меню для разделов выше
        foreach (Post::defaultOrder()->ancestorsAndSelf($currentPostId) as $ancestor) {
            if ($currentRowId == $ancestor->id) {
                return true;
            }
        }
        return false;
    }

    public function countChildrens($currentRowId = 0)
    {
        return Post::whereParentId($currentRowId)->count();
    }
}
