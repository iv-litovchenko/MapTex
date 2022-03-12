<?php

use App\Models\Technology;

$parentId = 0;

/** @var $row */
if (isset($row['id'])) {
    $parentId = $row['id'];
}

$rows = Technology::where('parent_id', '=', $parentId)
    ->orderBy('sorting')
    ->get();

?>

@if(count($rows) > 0)
    <ol class="children">
        @foreach ($rows as $row)
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
                         data-sorting="{{ $loop->iteration }}"
                    >
                        @if($row->is_draft_flag == 1)
                            [Черновик]
                        @endif
                        @if($row->branch_stop_flag == 1 || $row->is_page_flag == 1)
                            <a href="{{ route('tech', ['id'=>$row->id]) }}">{{ Str::limit($row->name, 32) }}</a>
                        @else
                            {{ Str::limit($row->name, 32) }}
                        @endif
                    </div>
                </div>
                @if($row->branch_stop_flag != 1)
                    @include('inc/rowChildren', ['row' => $row, 'brunch_type' => 0])
                @endif
            </li>
        @endforeach
    </ol>
@endif
