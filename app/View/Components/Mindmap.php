<?php

namespace App\View\Components;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Technology;

class Mindmap extends Component
{
    /** @var int */
    public $parentId = 0;

    /** @var array Пример инкапсуляции */
    private $backgroundColor = [
        1 => '#8bc34a',
        2 => '#ff9800'
    ];

    /**
     * Инициализируем компонент.
     *
     * @param int $parentId
     * @return void
     */
    public function __construct(int $parentId = 0)
    {
        $this->parentId = $parentId;
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
        $rows = Technology::whereParentIdWithNull($this->parentId)
            ->orderBy('sorting')
            ->get();
        ;
        if (count($rows) > 0) {
            return view('components.mindmap', compact('rows'));
        }
        return '';
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
