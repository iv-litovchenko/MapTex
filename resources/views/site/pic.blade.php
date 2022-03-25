@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Разные картинки')
@section('LayoutSectionPageHeader', 'Разные картинки')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.pic'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($files as $file)
            <img src="images/pics/{{ $file->getBasename() }}"
                 style="width: auto; max-width: 50%; border: gray 3px solid;"/>
            @auth
                <br/>
                <b>{{ $file->getBasename() }}</b>
            @endauth
            <br/>
            <hr/>
        @endforeach
    </center>
@stop
