<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('LayoutSectionPageTitle') | IT-заметки</title>
    @section('LayoutSectionPageCssFiles')
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @show
    @section('LayoutSectionPageCssCode')

    @show
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('site.home') }}">
                <center>
                    <img src="{{ asset('assets/images/logo.png') }}" width="20" height="20"
                         style="display: inline; vertical-align: top;" alt="">
                    IT-конспекты <br/>
                    <code>MapTex.Ru</code>
                </center>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            {!! Menu::get('menu.header.left')->asUl(['class' => 'nav navbar-nav'],['class' => 'dropdown-menu']) !!}
            {!! Menu::get('menu.header.right')->asUl(['class' => 'nav navbar-nav navbar-right'],['class' => 'dropdown-menu']) !!}
            @auth
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                    @csrf
                </form>
            @endauth
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#">Всего знаний: {{ $appDbCountPosts }}/{{ $appFilesCount }}</a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

<div class="container">
    <div class="page-header">
        @if (!Route::is('site.home') && !Route::is('site.post'))
            <h1>@yield('LayoutSectionPageHeader')</h1>
        @endif
        @if (!Route::is('site.home'))
            @yield('LayoutSectionPageBreadcrumb')
        @endif
        @if(Route::is('site.home') || Route::is('site.post') || Route::is('site.search'))
            @include('layouts.partials.form-search')
        @endif
    </div>
    @include('layouts.partials.flash-message')
    @yield('LayoutSectionPageContent')
</div> <!-- /container -->

<footer class="footer">
    <div class="container">
        <hr class="my-12"/>
        <p class="text-muted">Версия {{ $appProjectVersion }} | {{ config('app.name', 'Laravel') }}</p><br />
        <img src="{{ asset('assets/images/life.gif') }}" style="width: 130px;text-align: left;margin-right: 15px;" align="left">
        <a href="http://ivan-litovchenko.ru/"><img src="http://ivan-litovchenko.ru/typo3conf/ext/siteivlitovchenko/Resources/Public/Images/Iv.png" width="300"></a>
        <p>
            Над кодом - как это работает? Интерактивный справочник и копилка знаний. <br/>
            Код пишется для людей. Я не ходячая энциклопедия - дайте мне гугл и я найду ответ (не возможно знать все)<br/>
            Самый ценный навык - быстро научится новой технологии. 3 дня и научился...<br/>
            <a href="https://getbootstrap.com/docs/3.4/components/">Bootstrap компоненты</a> |
            <a href="https://github.com/iv-litovchenko/maptex/">Исходники проекта на github</a> |
            <a href="{{ route('site.sitemap') }}">Оглавление (карта сайта)</a> |
            <a href="{{ route('deploy') }}">Deploy</a>
        </p>
    </div>
</footer>

@section('LayoutSectionPageJsFooterFiles')

    <script src="{{ mix('js/app.js') }}"></script>

@show

@section('LayoutSectionPageJsFooterCode')

@show

</body>
</html>
