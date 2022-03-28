<?php

namespace App\View\Components;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class Mindmap extends Component
{
    /** @var int */
    public $recordId = 0;

    /** @var int */
    public $showBreadcrumbs = 0;

    /** @var array Пример инкапсуляции */
    private $backgroundColor = [
        1 => '#8bc34a',
        2 => '#ff9800'
    ];

    /**
     * Инициализируем компонент.
     *
     * @param int $recordId
     * @param int $showBreadcrumbs
     * @return void
     */
    public function __construct(int $recordId = 0, $showBreadcrumbs = 0)
    {
        $this->recordId = $recordId;
        $this->showBreadcrumbs = $showBreadcrumbs;
    }

    /**
     * Выводим содержимое компонента
     *
     * @return \Illuminate\Contracts\View\View|void
     */
    public function render()
    {
        //        return function ($date){
        //            return $date['componentName'];

        // TODO <x-mindmap my-attr="val"/> сюда попадет все что не определено в конструкторе
        //            return $date['atributes'];

        // TODO сюда попадет все что будет между открывающим и закрывающим тэгом
        /** @var  $slot HtmlString */
        //        $slot = $date['slot']->toHtml();
        // <x-mindmap> --CONTENT-- </x-mindmap>
        //            return $date['slot'];

        //        }

        if ($this->recordId == 0) {
            $rows = Post::whereIsRoot()->orderBy('sorting')->get();
        } else {
            $rows = Post::orderBy('sorting')
                ->descendantsOf($this->recordId)
                ->toTree($this->recordId);
        }

        $rowsBreadcrumbs = [];
        if ($this->showBreadcrumbs == 1) {
            $rowsBreadcrumbs = Post::ancestorsAndSelf($this->recordId);
        }

        return view('components.mindmap', compact('rows', 'rowsBreadcrumbs'));
    }

    public function divCssBackgroundColor($row = [])
    {
        if ($row->branch_stop_flag) {
            return $this->backgroundColor[1];
        } elseif ($row->is_page_flag) {
            return $this->backgroundColor[2];
        }
        return 'none';
    }
}
