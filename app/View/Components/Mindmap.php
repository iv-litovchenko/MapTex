<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Technology;

class Mindmap extends Component
{
    /** @var int */
    public $parentId = 0;

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
        $rows = Technology::whereParentIdWithNull($this->parentId)
            ->orderBy('sorting')
            ->get();

        if (count($rows) > 0) {
            return view('components.mindmap', compact('rows'));
        }
        return '';
    }
}
