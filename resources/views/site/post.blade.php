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

    @if ($post->is_page_flag == 1)
        @foreach($images as $image)
            <img src="{{ asset('uploads/image/post/'.$post->id.'/'.$image->getBasename()) }}"
                 style="width: 100%; max-width: 100%; border: gray 3px solid;"/>
            @auth
                <br/>
                <b>{{ $image->getBasename() }}</b>
            @endauth
            <br/>
            <hr/>
        @endforeach
        <pre>{{ $post->description }}</pre>
        <br/>
        {!! $post->description_tinymce !!}
    @endif

@endsection
