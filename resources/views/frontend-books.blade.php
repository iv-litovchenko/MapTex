@extends('layouts.frontend')

@section('pageLayoutTitle', 'Книги')
@section('pageLayoutHeader', 'Книги')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('books'))

@section('content')
    <center>
        @foreach($files as $file)
            <img src="images/books/{{ $file->getBasename() }}" height="200" style="margin-bottom: 5px; border: gray 3px solid;"/>
        @endforeach
    </center>
@stop
