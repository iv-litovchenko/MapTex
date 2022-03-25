@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Сброс пароля')
@section('LayoutSectionPageHeader', 'Сброс пароля')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('password.update'))

@section('LayoutSectionPageContent')
    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
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
        <button type="submit" class="btn btn-primary">Сбросить ссылку на восстановление пароля</button>
    </form>
@endsection
