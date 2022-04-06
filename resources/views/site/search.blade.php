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
            {!! clean($post->description, 'default') !!}
        </div>
        <hr/>
    @endforeach
@stop
