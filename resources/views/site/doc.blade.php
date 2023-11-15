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
            <div class="sidebar-nav">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".sidebar-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="visible-xs navbar-brand">Навигация</span>
                    </div>
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <ul>
                            @foreach(\App\Models\Doc::getCategories() as $key => $name)
                                <li @if($key == $cat) class="active" @endif>
                                    <a href="{{ route('site.doc-cat', $key) }}">{{ $key }}. {{ $name }}</a><
                                </li>
                            @endforeach

                        </ul>
                    </div><!--/.nav-collapse -->
                </div>

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
                    <option value="{{ $key }}" @if($key == $cat) selected @endif>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Добавить документ</button>
    </form>
@stop
