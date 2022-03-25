@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Книги')
@section('LayoutSectionPageHeader', 'Книги')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.book'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($images as $image)
            <img src="{{ asset('uploads/image/book/'.$image->getBasename()) }}" height="200"
                 style="margin-bottom: 5px; border: gray 3px solid;"/>
        @endforeach
    </center>
@stop
