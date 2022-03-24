@extends('layouts.default')

@section('pageLayoutTitle', 'Технологии')
@section('pageLayoutHeader', 'Технологии')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('admin.technology.index'))

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('admin.technology.create') }}" class="btn btn-primary" role="button">Добавить</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($technologies as $technology)
                <tr>
                    <th scope="row">{{ $technology->id }}</th>
                    <td>{{ $technology->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.technology.edit', $technology->id) }}">Редактировать</a>
                            <a class="btn btn-danger btn-sm" href="#"
                               onclick="document.getElementById('formId{{ $technology->id }}').submit(); return false;">Удалить</a>
                        </div>
                        <form action="{{ route('admin.technology.destroy', $technology->id) }}" method="post"
                              id="formId{{ $technology->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">Всего записей: {{ $technologies->total() }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
    {{ $technologies->links() }}
@endsection
