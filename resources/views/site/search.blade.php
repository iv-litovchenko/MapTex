@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Результаты поиска')
@section('LayoutSectionPageHeader', 'Результаты поиска')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.search'))

@section('LayoutSectionPageContent')
    @foreach($posts as $post)
        <h4>
            <a href="{{ route('site.post', $post->id) }}" style="font-size: 32px;">
                {{ $post->name }}
            </a>
        </h4>
        <div class="jumbotron backlightText">
            {!! nl2br(strip_tags($post->description)) !!}
        </div>
        <hr/>
    @endforeach
@stop
