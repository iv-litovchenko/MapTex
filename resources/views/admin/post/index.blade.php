@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Посты')
@section('LayoutSectionPageHeader', 'Посты')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.post.index'))

@section('LayoutSectionPageContent')

    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ route('admin.post.create') }}" class="btn btn-primary" role="button">Добавить</a>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Родительский раздел</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->parent_id }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success btn-sm" href="{{ route('site.post', $post->id) }}">Смотреть</a>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.post.edit', $post->id) }}">Редактировать</a>
                            <a class="btn btn-danger btn-sm" href="{{ route('admin.post.delete', $post->id) }}">Удалить</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="4">Всего записей: {{ $posts->total() }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
    {{ $posts->links() }}
@endsection
