@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Книжки')
@section('LayoutSectionPageHeader', 'Книжки')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.book'))

@section('LayoutSectionPageContent')
    <center>
        @foreach($books as $book)
            <img src="{{ asset('storage/'.$book->image_path) }}"
                 class="img-thumbnail img-site-book"/>
        @endforeach
    </center>
    <hr />
    <form action="{{ route('site.book-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" class="form-control" name="image_path[upload]">
        </div>
        <button type="submit" class="btn btn-primary">Добавить книгу</button>
    </form>
@stop
