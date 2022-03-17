<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>{{ $pageTitle ?? '' }} | IT-заметки</title>

    <link rel="stylesheet" href="/assets/mindmap/dist/mindmap.css">
    <link rel="stylesheet" href="/assets/contextmenu/dist/jquery.contextMenu.css">

    <style rel="stylesheet">
        body {
            background: white;
        }
    </style>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/i7rtvlx6g594hivyfqzi1d4yk6e0uvnt71bu0wysnpqkkrnl/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="/assets/mindmap/dist/mindmap.js"></script>
    <script src="/assets/contextmenu/dist/jquery.contextMenu.js"></script>

</head>
<body>

@if(session('success'))
    {{ session('success') }}
@endif

@include('partials/menu')
@yield('content')

<br/>
<br/>
<br/>

<div style="text-align: center;">
    @guest
        <a href="{{ route('login') }}">Логин</a>
    @else
        {{ Auth::user()->name }} |
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Выйти
        </a>
        <form action="{{ route('logout') }}" method="post" style="d-none">
            @csrf
        </form>
    @endguest
</div>

<br/>
<br/>
<br/>

<div class="card-body">
    @if (session('status'))
        {{ session('status') }}
    @endif
</div>

<div style="position: fixed; bottom: 15px; right: 15px;">Версия 0.0.1 | {{ config('app.name', 'Laravel') }}</div>
</body>
</html>
