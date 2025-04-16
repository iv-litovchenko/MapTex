@extends('layouts.default')

@section('LayoutSectionPageTitle', 'В доступе отказано')
@section('LayoutSectionPageHeader', 'В доступе отказано')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.post', $post))

@section('LayoutSectionPageContent')

    <div class="alert alert-warning" role="alert">
        Страница не доступна для публичного просмотра!
    </div>

@endsection
