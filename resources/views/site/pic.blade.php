@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Разные картинки')
@section('LayoutSectionPageHeader', 'Разные картинки')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.pic'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($images as $image)
            <img src="{{ asset('storage/site/pic/'.$image->getBasename()) }}"
                 class="img-thumbnail img-site-pic"/>
            @auth
                <br/>
                <b>{{ $image->getBasename() }}</b>
            @endauth
            <hr/>
        @endforeach
    </center>
@stop
