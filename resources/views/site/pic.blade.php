@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Разные картинки')
@section('LayoutSectionPageHeader', 'Разные картинки')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.pic'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($images as $image)
            <img src="{{ asset('uploads/image/pic/'.$image->getBasename()) }}" class="img-thumbnail"
                 style="width: 100%; max-width: 500px;"/>
            @auth
                <br/>
                <b>{{ $image->getBasename() }}</b>
            @endauth
            <hr/>
        @endforeach
    </center>
@stop
