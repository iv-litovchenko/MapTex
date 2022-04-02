@if(count($rows)>0)
    <ul class="nav navbar-nav">
        @foreach($rows as $row)
            <li>  <!--class="active"-->
                <a href="#">{{ $row->name }}</a>
                <x-menu-sidebar record-id="{{ $row->id }}"/>
            </li>
        @endforeach
    </ul>
@endif
