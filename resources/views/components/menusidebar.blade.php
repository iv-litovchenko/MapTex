@if(count($rows)>0)
    <ul class="{{ $htmlUlClass }}">
        @foreach($rows as $row)
            <li>  <!--class="active"-->
                <a href="#">{{ $row->name }} <span class="badge">1,118</span></a>
                <x-menu-sidebar parent-id="{{ $row->id }}" html-ul-class="dropdown-menu menu-sidebar-level-next"/>
            </li>
        @endforeach
    </ul>
@endif
