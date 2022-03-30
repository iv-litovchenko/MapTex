@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Книги')
@section('LayoutSectionPageHeader', 'Книги')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.book'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($images as $image)
            <img src="{{ asset('uploads/site/book/'.$image->getBasename()) }}"
                 class="img-thumbnail img-site-book"/>
        @endforeach
    </center>
@stop
