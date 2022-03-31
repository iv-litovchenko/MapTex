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

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <a href="{{ route('admin.post.create', ['default_parent_id' => $post->parent_id]) }}" type="button" class="btn btn-warning btn-lg">Добавить знание</a>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-success btn-lg">Редактировать знание</a>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('admin.post.create', ['default_parent_id' => $post->id]) }}" type="button" class="btn btn-warning btn-lg">Создать ветку</a>
        </div>
    </div>

    <hr class="my-12">

    {!! clean($post->description, 'default') !!}

    <hr class="my-12">

    <center>
        @foreach($images as $image)
            <img src="{{ asset('storage/'.$image) }}"
                 class="img-thumbnail img-site-post"/>
            @auth
                <br/>
                <b>{{ basename($image) }}</b>
            @endauth
            <br/>
            <hr/>
        @endforeach
    </center>

@endsection
