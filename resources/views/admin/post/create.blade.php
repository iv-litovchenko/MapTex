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
                <select class="form-control" name="parent_id">
                    <option value="">Без родителя</option>
                    @foreach($postsList as $postItem)
                        <option
                            value="{{ $postItem->id }}" {{ (collect(old('parent_id'))->contains($postItem->id)) ? 'selected':'' }}>
                            [{{ $postItem->id }}]
                            {{ $postItem->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
