@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Книги')
@section('LayoutSectionPageHeader', 'Книги')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.book'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($images as $image)
            <img src="{{ asset('uploads/image/book/'.$image->getBasename()) }}" class="img-thumbnail"
                 style="margin: 5px;" height="200"/>
        @endforeach
    </center>
@stop
