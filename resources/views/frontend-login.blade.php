<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
</head>
<body>

@if($errors->any())
    @foreach($erros->all() as $error)
        ...dww
    @endforeach
@endif

<form method="post">
    @csrf
    <table width="80%" align="center" border="1">
        <tr>
            <td width="50%">ID-пользователя:</td>
            <td><input name="id" style="width: 100%"></td>
        </tr>
        <tr>
            <td width="50%">Логин:</td>
            <td><input name="email" style="width: 100%"></td>
        </tr>
        <tr>
            <td width="50%">Пароль:</td>
            <td><input name="password" type="password" style="width: 100%"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit">
            </td>
        </tr>
    </table>
</form>

</body>
</html>
