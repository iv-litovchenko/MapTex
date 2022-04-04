{{-- https://jonathanbriehl.com/posts/vertical-menu-for-bootstrap-3 --}}
@if(count($rows)>0)
    <ul class="{{ $htmlUlClass }}">
        @foreach($rows as $row)
            <li @if($isActive($row->id, $currentPostId)) class="active" @endif>
                <a href="{{ route('site.post', $row->id) }}">
                    {{--                    @auth--}}
                    {{--                        #{{ $row->id }} |--}}
                    {{--                    @endauth--}}
                    @component('components.icon')
                        @slot('src', asset('storage/site/post/logo/'.$row->logo_image))
                        @slot('height', 20)
                        @slot('valign', 'top')
                    @endcomponent
                    @if($countChildrens($row->id) > 0)
                        <span class="badge">{{ $countChildrens($row->id) }}</span>
                        <!--<b class="caret"></b>-->
                    @endif
                    {{ Str::limit($row->name, 72) }}
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
