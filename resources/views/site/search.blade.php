@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Результаты поиска')
@section('LayoutSectionPageHeader', 'Результаты поиска')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.search'))

@section('LayoutSectionPageContent')
    @foreach($posts as $post)
        <h2>
            <a href="{{ route('site.post', $post->id) }}">
                {{ $post->name }}
            </a>
        </h2>
        <div class="backlightText">
            @include('components.post-content-type.partials.content')
            @include('components.post-content-type.partials.images')
        </div>
        <hr/>
    @endforeach
@stop
