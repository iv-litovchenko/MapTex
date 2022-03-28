@extends('layouts.default')

@section('LayoutSectionPageContent')

    @if($errors->any())
        @foreach($erros->all() as $error)
            ...dww
        @endforeach
    @endif

    <form method="post">
        @csrf
        <center><a href="{{ route('site.post', ['id'=>$model->id]) }}">Вернуться к элементу</a></center>
        <table width="80%" align="center" border="1">
            @foreach($rows as $k => $v)
                <tr>
                    <td width="50%">{{ $v->name }}</td>
                    <td><input name="sort_list[{{ $v->id  }}]" style="width: 100%" value="{{ $v->sorting }}"></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2">
                    <input type="submit">
                </td>
            </tr>
        </table>
    </form>

@endsection
