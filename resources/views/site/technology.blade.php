@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Изучаем технологии')
@section('LayoutSectionPageHeader', 'Изучаем технологии')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.technology'))

@section('LayoutSectionPageContent')

    <div class="row">
        @foreach($content as $k => $tech)
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $tech['name'] }}
                    </div>
                    <div class="panel-body">
                        {!! $tech['content_exec']  !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@stop
