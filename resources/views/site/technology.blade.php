@extends('layouts.default')

@section('LayoutSectionPageTitle', $technology->name)
@section('LayoutSectionPageHeader', $technology->name)
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.technology', $technology))

@section('LayoutSectionPageContent')

    <div class="mindmap">
        <div class="node node_root context-menu-one btn btn-neutral">
            <div class="node__text" onclick="window.location.href='{{ route('site.home') }}';">
                Roadmap backend
            </div>
        </div>
        <x-mindmap record-id="{{ $technology->id }}" show-breadcrumbs="1"/>
    </div>

    <hr class="my-12">

    @if ($technology->is_page_flag == 1)
        @foreach($images as $image)
            <img src="{{ asset('uploads/image/post/'.$technology->id.'/'.$image->getBasename()) }}"
                 style="width: 100%; max-width: 100%; border: gray 3px solid;"/>
            @auth
                <br/>
                <b>{{ $image->getBasename() }}</b>
            @endauth
            <br/>
            <hr/>
        @endforeach
        <pre>{{ $technology->description }}</pre>
        <br/>
        {!! $technology->description_tinymce !!}
    @endif

@endsection
