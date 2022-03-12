<div style="padding: 25px; background: #c7c7f5; text-align: center; color: white">
    <table width="100%">
        <tr>
            <td width="25%" align="left" style="font-size: 15px; color: gray;">
                IT-заметки (над кодом - как это работает?)<br/>
                Интерактивный справочник
            </td>
            <td>
                <a href="{{ route('home') }}" style="font-size: 24px;">Главная</a> &nbsp;|
                <a href="{{ route('notes') }}" style="font-size: 24px;">Барахолка</a> |&nbsp;
                <a href="{{ route('pics') }}" style="font-size: 24px;">Разные картинки</a> &nbsp;|&nbsp;
                <a href="{{ route('books') }}" style="font-size: 24px;">Книги</a>
                <br/>
                <a href="{{ route('login') }}" style="font-size: 24px;">Логин</a> /
                <a href="{{ route('logout') }}" style="font-size: 24px;">Выход</a>
            </td>
            @php
                $countTechnology = \App\Models\Technology::count();
            @endphp
            <td width="25%" align="right" style="font-size: 15px; color: gray;">
                Всего знаний ({{ $countTechnology }})<br/>
                Код пишется для людей</b>
            </td>
        </tr>
    </table>

</div>

<div style="padding: 25px; background: #afe282; text-align: center; color: white">
    <form action="{{ route('search') }}">
        @csrf
        <input type="text" name="q" placeholder="Введите запрос на поиск"
               style="width: 50%; height: 42px; padding: 5px 10px 5px 10px;
                border-radius: 10px; border: gray 1px solid; font-size: 32px;">
        <input type="submit" value="Go"
               style="height: 42px; padding-left: 5px; padding-right: 5px;
                border-radius: 10px; border: gray 1px solid; font-size: 32px;">
    </form>
</div>

<br/>
<br/>
