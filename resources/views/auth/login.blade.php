@extends('layouts.default')

@section('pageLayoutTitle', 'Вход')
@section('pageLayoutHeader', 'Вход')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('login'))

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
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
            <label class="col-sm-2 col-form-label" for="checkboxRemember">Запомнить вход?</label>
            <div class="col-sm-10">
                <input type="checkbox" class="form-check-input" name="remember" id="checkboxRemember">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Вход</button>
    </form>
@endsection
