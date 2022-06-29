@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Карта сайта')
@section('LayoutSectionPageHeader', 'Карта сайта')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.sitemap'))

@section('LayoutSectionPageContent')
    @foreach($postsTreeArray as $postItemId => $postItemName)

        <a href="{{ route('site.post', $postItemId) }}">{{ $postItemName }}</a><br/>

    @endforeach
@stop
