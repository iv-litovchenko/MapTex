@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Документы')
@section('LayoutSectionPageHeader', 'Документы')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.doc'))

@section('LayoutSectionPageContent')
    @foreach($docs as $doc)
        <a href="{{ route('site.doc-download', $doc->id) }}">
            {!! clean($doc->bodytext) !!}
        </a>
        <hr/>
    @endforeach
    <form action="{{ route('site.doc-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" class="form-control" name="file_path[upload]">
        </div>
        <button type="submit" class="btn btn-primary">Добавить документ</button>
    </form>
@stop
