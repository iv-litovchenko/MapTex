@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Пользователи')
@section('LayoutSectionPageHeader', 'Пользователи')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.user.index'))

@section('LayoutSectionPageContent')

    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary" role="button">Добавить</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.user.edit', $user->id) }}">Редактировать</a>
                            <a class="btn btn-danger btn-sm" href="{{ route('admin.user.delete', $user->id) }}">Удалить</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">Всего записей: {{ $users->total() }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
    {{ $users->links() }}
@endsection
