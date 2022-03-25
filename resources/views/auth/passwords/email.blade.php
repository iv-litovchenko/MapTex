@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Забыли пароль?')
@section('LayoutSectionPageHeader', 'Забыли пароль?')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('password.email'))

@section('LayoutSectionPageContent')
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сбросить ссылку на восстановление пароля</button>
    </form>
@endsection
