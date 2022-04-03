@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Книжки')
@section('LayoutSectionPageHeader', 'Книжки')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.book'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($images as $image)
            <img src="{{ asset('storage/'.$image) }}"
                 class="img-thumbnail img-site-book"/>
        @endforeach
    </center>
@stop
