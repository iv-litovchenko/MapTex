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
    
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(91569979, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/91569979" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</head>
<body>

{{--<div id="app">--}}
{{--    ....--}}
{{--    <example-component></example-component>--}}
{{--</div>--}}

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
        <img src="{{ asset('assets/images/new/Screenshot from 2022-12-20 17-31-32.png') }}" style="text-align: left; margin-right: 15px;" align="left" height="90">
        <img src="{{ asset('assets/images/new/photo_2022-12-20_17-18-00.jpg') }}" style="text-align: left; margin-right: 15px;" align="left" height="90">
        <img src="{{ asset('assets/images/damboldor.png') }}" style="text-align: left; margin-right: 15px;" align="left" height="90">
        <img src="{{ asset('assets/images/life.gif') }}" style="text-align: left; margin-right: 15px;" align="left" height="90">
        <img src="{{ asset('assets/images/tony.jpeg') }}" style="text-align: left; margin-right: 15px;" align="left" height="90">
        <a href="http://ivan-litovchenko.ru/"><img src="http://ivan-litovchenko.ru/typo3conf/ext/siteivlitovchenko/Resources/Public/Images/Iv.png" width="300"></a>
        <p>
            Над кодом - как это работает? Интерактивный справочник и копилка знаний. <br/>
            Код пишется для людей. Я не ходячая энциклопедия - дайте мне гугл и я найду ответ (не возможно знать все)<br/>
            Самый ценный навык - быстро научится новой технологии. 3 дня и научился...<br/>
            <a href="https://getbootstrap.com/docs/3.4/components/">Bootstrap компоненты</a> |
            <a href="https://github.com/iv-litovchenko/maptex/">Исходники проекта на github</a> |
            <a href="{{ route('site.sitemap') }}">Оглавление (карта сайта)</a> |
            <a href="{{ route('deploy') }}">Deploy Ci/Cd</a> <br />
            Когда достижения - то мы, когда косяки - то я. В этом и есть суть ответственности. <br />
            Видеть картину в целом - разностороннее развитие. Пробуй каждый день что-то новое.
            Не ставь личные цели. Цели это рамки ожидания как должно быть. У тех кто мертв тоже были цели ставь ориентиры
            Просто делай и(или) иди. Все это приключения. Подари себя, подари то что ты умеешь
            Любая цель должна быть потдвоепленна цем то (деньги время ресурсы)
            Думай о том что говоришь, так как ты начинаешь верить в это
            Не реагируй на эмоциях
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
