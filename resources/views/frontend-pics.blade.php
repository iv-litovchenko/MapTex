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
        <img src="images/pics/{{ $file->getBasename() }}" style="width: auto; max-width: 50%; border: gray 3px solid;"/>
        <br/>
        <hr/>
    @endforeach
</center>

</body>
</html>
