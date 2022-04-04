<?php

namespace App\View\Components;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
use App\Models\Post;

class PostContentTypeMindMap extends Component
{
    /** @var int */
    public $recordId = 0;

    /** @var array Пример инкапсуляции */
    private $backgroundColor = [
        1 => '#8bc34a',
        2 => '#ff9800'
    ];

    /**
     * Инициализируем компонент.
     *
     * @param int $recordId
     * @return void
     */
    public function __construct(int $recordId = 0)
    {
        $this->recordId = $recordId;
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

        if ($this->recordId == 0) {
            $rows = Post::whereIsRoot()->orderBy('sorting')->get();
        } else {
            $rows = Post::orderBy('sorting')
                ->descendantsOf($this->recordId)
                ->toTree($this->recordId);
        }

        return view('components.mindmap', compact('rows'));
    }
}
