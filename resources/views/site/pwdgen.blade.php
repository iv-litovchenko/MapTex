@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Генератор пароля')
@section('LayoutSectionPageHeader', 'Генератор пароля')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.pwdgen'))

@section('LayoutSectionPageContent')

    <form action="{{ route('site.pwdgen') }}" method="post">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Название сервиса</label>
            <div class="col-sm-10">
                <input type="input" class="form-control" name="service_name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Мой префикс</label>
            <div class="col-sm-10">
                <input type="input" class="form-control" name="prefix_name">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Получать пароль</button>
    </form>

@stop