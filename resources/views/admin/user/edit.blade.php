@extends('layouts.default')

@section('pageLayoutTitle', 'Редактировать')
@section('pageLayoutHeader', 'Редактировать')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('admin.user.edit'))

@section('content')
    <form action="{{ route('admin.user.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{ $user->email }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
