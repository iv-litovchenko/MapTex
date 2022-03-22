<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle ?? '' }} | IT-заметки</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/mindmap/dist/mindmap.css">
    <link rel="stylesheet" href="/assets/contextmenu/dist/jquery.contextMenu.css">
</head>
<body>

@if (session('status'))
    {{ session('status') }}
@endif

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
            <a class="navbar-brand" href="{{ route('home') }}">
                IT-заметки
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            @include('partials/menu')
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

<div class="container">
    @include('partials/searchForm')
    @yield('content')
</div> <!-- /container -->

<footer class="footer">
    <div class="container">
        <p class="text-muted">Версия 0.0.1/{{ $appProjectVersion }} | {{ config('app.name', 'Laravel') }}</p>
        <p>
            Над кодом - как это работает? Интерактивный справочник и копилка знаний. <br/>
            Код пишется для людей. https://bootstrap-4.ru/docs/3.4/getting-started/
        </p>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script
    src="https://cdn.tiny.cloud/1/i7rtvlx6g594hivyfqzi1d4yk6e0uvnt71bu0wysnpqkkrnl/tinymce/5/tinymce.min.js"></script>
<script src="/assets/mindmap/dist/mindmap.js"></script>
<script src="/assets/contextmenu/dist/jquery.contextMenu.js"></script>
</body>
</html>
