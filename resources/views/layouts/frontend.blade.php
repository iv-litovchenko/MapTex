<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>{{ $pageTitle }} | IT-заметки</title>

    <link rel="stylesheet" href="/assets/mindmap/dist/mindmap.css">
    <link rel="stylesheet" href="/assets/contextmenu/dist/jquery.contextMenu.css">

    <style rel="stylesheet">
        body {
            background: white;
        }
    </style>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/assets/mindmap/dist/mindmap.js"></script>
    <script src="/assets/contextmenu/dist/jquery.contextMenu.js"></script>

</head>
<body>

@if(session('success'))
    {{ session('success') }}
@endif

@include('inc/menu')
@yield('content')

<br/>
<br/>
<br/>

</body>
</html>
