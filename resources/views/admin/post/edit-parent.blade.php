@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Сменить родителя')
@section('LayoutSectionPageHeader', 'Сменить родителя')
@section('LayoutSectionPageBreadcrumb', null)

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.post.update-parent', $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="id" disabled value="{{ $post->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" disabled value="{{ $post->name }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Родитель</label>
            <div class="col-sm-10">
                @include('admin.post.partials.html-select-parent-id', [
    'default' => $post->parent_id,
    'changeAllow' => true
    ])
            </div>
        </div>
        <button type="submit" name="redirect" class="btn btn-primary" value="none">Сохранить</button>
    </form>
@endsection
