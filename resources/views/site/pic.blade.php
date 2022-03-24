@extends('layouts.default')

@section('pageLayoutTitle', 'Разные картинки')
@section('pageLayoutHeader', 'Разные картинки')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('pic'))

@section('content')
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
