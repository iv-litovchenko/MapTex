<ul class="nav navbar-nav">
    <li class="active"><a href="{{ route('home') }}">Главная</a></li>
    <li><a href="{{ route('notes') }}">Барахолка</a></li>&nbsp;
    <li><a href="{{ route('pics') }}">Разные картинки</a></li>&nbsp;
    <li><a href="{{ route('books') }}">Книги</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="drowdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
           aria-expanded="false">
            @guest
                Кабинет
            @else
                {{ Auth::user()->name }} |
            @endguest
            <span class="caret"></span></a>
        <ul class="dropdown-menu">
            @guest
                <li><a href="{{ route('login') }}">Логин</a></li>
            @else
                <li><a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Выйти
                    </a></li>
                <form action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                    <input type="submit" id="logout-form">
                </form>
            @endguest
        </ul>
    </li>
    <li>
        <a href="{{ route('home') }}">
            @component('components.db-count-in-model')
                @slot('name', 'Всего знаний:')
            @endcomponent
        </a>
    </li>
</ul>
