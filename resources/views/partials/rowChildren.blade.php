
    <ol class="children">
        @foreach ($rows as $row)
            @php $cssStyleBrunchStop = '' @endphp
            @if($row->branch_stop_flag == 1)
                @php $cssStyleBrunchStop = 'background: #8bc34a' @endphp
            @elseif($row->is_page_flag == 1)
                @php $cssStyleBrunchStop = 'background: #ff9800' @endphp
            @endif
            <li class="children__item" style="
            @if($row->logo_image)
                margin: 20px 0 20px 0;
            @endif
                ">
                <div class="node" style="{{ $cssStyleBrunchStop }}; position: relative;
                @if($row->logo_image)
                    padding-left: 20px;
                @endif
                    ">
                    <div class="node__text context-menu-one"
                         data-id="{{ intval($row->id) }}"
                         data-parent-id="{{ intval($row->parent_id) }}"
                         data-sorting="{{ intval($loop->iteration) }}"
                    >
                        @if($row->logo_image)
                            <img src="{{ url($row->logo_image) }}" width="32" height="32" style="
                            position: absolute;
                            top: -6px;
                            left: -3px;
                            background: white;
                            padding: 3px;
                            border-radius: 100%;
                            border: gray 3px solid;">
                            &nbsp;&nbsp;&nbsp;
                        @endif
                        @auth
                            #{{ $row->id }} |
                        @endauth
                        @if($row->is_draft_flag == 1)
                            [Черновик]
                        @endif
                        @if($row->branch_stop_flag == 1 || $row->is_page_flag == 1)
                            <a href="{{ route('site.tech', ['id'=>$row->id]) }}">{{ Str::limit($row->name, 32) }}</a>
                        @else
                            {{ Str::limit($row->name, 32) }}
                        @endif
                    </div>
                </div>
                @if($row->branch_stop_flag != 1)
                    @include('partials/rowChildren', ['row' => $row, 'brunch_type' => 0])
                @endif
            </li>
        @endforeach
    </ol>
@endif
