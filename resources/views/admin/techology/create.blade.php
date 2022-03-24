@extends('layouts.default')

@section('pageLayoutTitle', 'Создать')
@section('pageLayoutHeader', 'Создать')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('admin.technology.index'))

@section('content')
    <form action="{{ route('admin.technology.store') }}" method="post">
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
                    @foreach($technologies as $technology)
                        <option value="{{ $technology->id }}" {{ (collect(old('parent_id'))->contains($technology->id)) ? 'selected':'' }}>{{ $technology->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
