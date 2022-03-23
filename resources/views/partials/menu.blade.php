<ul class="nav navbar-nav navbar-right">
    <li>
        <a href="{{ route('home') }}">
            @component('components.db-count-in-model')
                @slot('name', 'Всего знаний:')
            @endcomponent
        </a>
    </li>
</ul>
