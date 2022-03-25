@extends('layouts.default')

@section('LayoutSectionPageContent')

    @if($errors->any())
        @foreach($erros->all() as $error)
            ...dww
        @endforeach
    @endif

    <form method="post">
        @csrf
        <center><a href="{{ route('tech', ['id'=>$model->id]) }}">Вернуться к элементу</a></center>
        <table width="80%" align="center" border="1">
            <tr>
                <td width="50%">{{ $model->name }}</td>
                <td><input name="parent_id" style="width: 100%" value="{{ $model->parent_id }}"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit">
                </td>
            </tr>
        </table>
    </form>

@endsection
