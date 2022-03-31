@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Создать')
@section('LayoutSectionPageHeader', 'Создать')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.post.create'))

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.post.store') }}" method="post">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Родитель</label>
            <div class="col-sm-10">
                @include('admin.post.partials.html-select-parent-id', ['default'=>$defaultParentId])
            </div>
        </div>
        <button type="submit" name="redirect" class="btn btn-primary" value="none">Создать</button>
        <button type="submit" name="redirect" class="btn btn-primary" value="show">Создать и к просмотру</button>
    </form>
@endsection
