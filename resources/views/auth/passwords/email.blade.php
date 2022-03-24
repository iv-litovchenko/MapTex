@extends('layouts.default')

@section('pageLayoutTitle', 'Забыли пароль?')
@section('pageLayoutHeader', 'Забыли пароль?')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('password.email'))

@section('content')
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Сбросить ссылку на восстановление</button>
    </form>
@endsection
