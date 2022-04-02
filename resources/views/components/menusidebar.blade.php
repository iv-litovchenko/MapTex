{{-- https://jonathanbriehl.com/posts/vertical-menu-for-bootstrap-3 --}}
@if(count($rows)>0)
    <ul class="{{ $htmlUlClass }}">
        @foreach($rows as $row)
            <li @if($isActive($row->id, $currentPostId)) class="active" @endif>
                <a href="{{ route('site.post', $row->id) }}">
                    &raquo;
                    @if($row->logo_image)
                        <img src="{{ asset('storage/site/post/logo/'.$row->logo_image) }}" height="20">
                    @endif
                    {{--                    @auth--}}
                    {{--                        #{{ $row->id }} |--}}
                    {{--                    @endauth--}}
                    {{ Str::limit($row->name, 32) }}
                    <span class="badge">1,118</span> <b class="caret"></b>
                </a>
                @if($isActive($row->id, $currentPostId))
                    <x-menu-sidebar
                        parent-id="{{ $row->id }}"
                        current-post-id="{{ $currentPostId }}"
                        html-ul-class="dropdown-menu menu-sidebar-level-next"
                    />
                @endif
            </li>
            <!-- <li class="divider"></li> -->
            <!-- <li class="dropdown-header">Nav header</li> -->
        @endforeach
    </ul>
@endif

{{--@if($row->branch_stop_flag != 1)--}}
