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
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.post.edit', $post->id) }}">Редактировать</a>
                            <a class="btn btn-danger btn-sm" href="#"
                               onclick="document.getElementById('formId{{ $post->id }}').submit(); return false;">Удалить</a>
                        </div>
                        <form action="{{ route('admin.post.destroy', $post->id) }}" method="post"
                              id="formId{{ $post->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
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
