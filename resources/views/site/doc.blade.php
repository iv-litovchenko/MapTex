@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Документы')
@section('LayoutSectionPageHeader', 'Документы')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.doc'))

@section('LayoutSectionPageContent')

    <div class="row">
        <div class="col-sm-8">
            @foreach($docs as $doc)
                @can('update', $doc)
                    <a href="{{ route('admin.doc.edit', $doc->id) }}" type="button" class="btn btn-success btn-sm">Изменить</a>
                @endcan
                @can('delete', $doc)
                    <a href="{{ route('admin.doc.delete', $doc->id) }}" type="button" class="btn btn-danger btn-sm">Удалить</a>
                @endcan
                <a href="{{ route('site.doc-download', $doc->id) }}">
                    [{{ $doc->id }}] {!! ($doc->bodytext) !!}
                </a>
                <hr/>
            @endforeach
        </div>
        <div class="col-sm-4">
            @foreach(\App\Models\Doc::getCategories() as $key => $name)
                <a href="{{ route('site.doc-cat', $key) }}" class="">{{ $key }}. {{ $name }}</a><br />
            @endforeach
        </div>
    </div>
    <form action="{{ route('site.doc-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="file" class="form-control" name="file_path[upload]">
        </div>
        <div class="form-group">
            <select class="form-control" name="category">
                @foreach(\App\Models\Doc::getCategories() as $key => $name)
                    <option value="{{ $key }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Добавить документ</button>
    </form>
@stop
