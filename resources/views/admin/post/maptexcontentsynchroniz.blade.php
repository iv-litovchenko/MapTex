@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Синхронизация содержимого')
@section('LayoutSectionPageHeader', 'Синхронизация содержимого')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.post.maptexcontentsync'))

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.post.maptexcontentsync.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="panel panel-default">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col" width="33%" align="center">Путь к файлу</th>
                    <th scope="col" width="33%" align="center">ID записи в БД</th>
                    <th scope="col" width="33%" align="center">Название записи в БД</th>
                </tr>
                </thead>
                <tbody>
                @foreach($filesList as $file)
                    @if($file->path == '.gitignore')
                        @continue
                    @endif
                    <tr>
                        <td><input type="text" class="form-control" disabled value="{{ $file->path }}"></td>
                        <td><input type="text" class="form-control" name="name_short" value="{{ old('name_short', $posts[$file->path]['id']) }}"></td>
                        <td><input type="text" class="form-control" disabled value="{{ $posts[$file->path]['name'] }}"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="panel-heading">
                <a href="{{ route('admin.post.maptexcontentsync.update') }}" class="btn btn-primary" role="button">Обновить с "https://github.com/iv-litovchenko/maptex_content"</a>
            </div>
        </div>
    </form>
@endsection
