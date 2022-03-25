@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Добавить')
@section('LayoutSectionPageHeader', 'Добавить')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.user.create'))

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.user.store') }}" method="post">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Пароль (подтверждение)</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password_confirmation">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
