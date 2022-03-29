@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Главная')
@section('LayoutSectionPageHeader', 'Главная')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.home'))

@section('LayoutSectionPageContent')

    <div class="mindmap">
        <div class="node node_root context-menu-one btn btn-neutral">
            <div class="node__text" onclick="window.location.href='{{ route('site.home') }}';">
                Roadmap backend
            </div>
        </div>
        <x-mindmap record-id="0"/>
    </div>

    @if(isset($images))
        <hr class="my-12">
        <center>
            @foreach($images as $image)
                <img src="{{ asset('uploads/image/pic/'.$image->getBasename()) }}" class="img-thumbnail"
                     style="width: 100%; max-width: 500px;"/>
                <hr/>
            @endforeach
        </center>
    @endif
@stop
