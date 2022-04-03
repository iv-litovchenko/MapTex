@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Зарисовки')
@section('LayoutSectionPageHeader', 'Зарисовки')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.figma'))

@section('LayoutSectionPageContent')
    @foreach($postsWithFigmaImages as $post)
        <img src="{{ asset('storage/figma/'.$post->figma_image) }}"
             class="img-thumbnail" style="width: 100%;"/>
        <hr />
    @endforeach
@stop
