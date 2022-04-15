@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Удалить пост')
@section('LayoutSectionPageHeader', 'Удалить пост')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.post.delete'))

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.post.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="id" disabled value="{{ $post->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" disabled value="{{ $post->name }}">
            </div>
        </div>
        <div class="alert alert-danger alert-block">
            <strong>
                Внимание - удаление записи приведет к ее потере,
                а также к потере дочерних (вложенных) записей!
            </strong>
            <br />
            <button type="submit" class="btn btn-danger">Выполнить удаление</button>
        </div>
    </form>
@endsection
