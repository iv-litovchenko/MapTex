@if(count($rows)>0)
    <ul class="{{ $htmlUlClass }}">
        @foreach($rows as $row)
            <li>  <!--class="active"-->
                <a href="{{ route('site.post', $row->id) }}">
                    @if($row->logo_image)
                        <img src="{{ asset('storage/site/post/logo/'.$row->logo_image) }}" height="32">
                    @endif
                    @auth
                        #{{ $row->id }} |
                    @endauth
                    {{ Str::limit($row->name, 32) }}
                    <span class="badge">1,118</span>
                </a>
                <x-menu-sidebar parent-id="{{ $row->id }}" html-ul-class="dropdown-menu menu-sidebar-level-next"/>
            </li>
        @endforeach
    </ul>
@endif
