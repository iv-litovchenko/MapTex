<?php

use App\Models\Technology;

/** @var $parentId */
$row = Technology::find($parentId);
?>

@if($row->parent_id > 0)
    @include('partials/rowParent', ['parentId'=>$row->parent_id])
@endif

<ol class="children children_leftbranch">
    <li class="children__item">
        <div class="node" style="">
            <div class="node__text btn btn-neutral">
                @if($row->branch_stop_flag == 1 || $row->is_page_flag == 1)
                    <a href="{{ route('tech', ['id'=>$row->id]) }}">
                        {{ Str::limit($row->name, 14) }}
                    </a>
                @else
                    {{ Str::limit($row->name, 14) }}
                @endif
            </div>
        </div>
    </li>
</ol>
