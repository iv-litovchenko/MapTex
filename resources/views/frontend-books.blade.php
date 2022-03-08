<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $pageTitle }} | IT-заметки</title>
</head>
<body>

@include('inc/menu')

<center>
    @foreach($files as $file)
        <img src="images/books/{{ $file->getBasename() }}" height="200" style="border: gray 3px solid;"/>
    @endforeach
</center>

</body>
</html>
