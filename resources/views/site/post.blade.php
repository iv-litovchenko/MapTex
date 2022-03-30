@extends('layouts.default')

@section('LayoutSectionPageTitle', $post->name)
@section('LayoutSectionPageHeader', $post->name)
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.post', $post))

@section('LayoutSectionPageContent')

    <div class="mindmap">
        <div class="node node_root context-menu-one btn btn-neutral">
            <div class="node__text" onclick="window.location.href='{{ route('site.home') }}';">
                Roadmap backend
            </div>
        </div>
        <x-mindmap record-id="{{ $post->id }}" show-breadcrumbs="1"/>
    </div>

    <hr class="my-12">

    <center>
        @foreach($images as $image)
            <img src="{{ asset('uploads/site/post/'.$post->id.'/'.$image->getBasename()) }}"
                 class="img-thumbnail img-site-post"/>
            @auth
                <br/>
                <b>{{ $image->getBasename() }}</b>
            @endauth
            <br/>
            <hr/>
        @endforeach
    </center>
    <pre>{{ $post->description }}</pre>
    <br/>
    {!! $post->description_tinymce !!}

@endsection
