<?php

use App\Models\TechnologyModel;

/** @var $parentId */
$row = TechnologyModel::find($parentId);

?>

<ol class="children">
    @php $cssStyleBrunchStop = '' @endphp
    @if($row->branch_stop_flag == 1)
        @php $cssStyleBrunchStop = 'background: #8bc34a' @endphp
    @elseif($row->is_page_flag == 1)
        @php $cssStyleBrunchStop = 'background: #ff9800' @endphp
    @endif
    <li class="children__item">
        <div class="node" style="{{ $cssStyleBrunchStop }}">
            <div class="node__text context-menu-one btn btn-neutral"
                 data-id="{{ $row->id }}"
                 data-parent-id="{{ $row->parent_id }}"
            >
                @if($row->branch_stop_flag == 1 || $row->is_page_flag == 1)
                    <a href="{{ route('tech', ['id'=>$row->id]) }}">{{ $row->name }}</a>
                @else
                    {{ $row->name }}
                @endif
            </div>
        </div>
    </li>
</ol>
