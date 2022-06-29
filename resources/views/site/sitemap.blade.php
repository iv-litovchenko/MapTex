@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Результаты поиска')
@section('LayoutSectionPageHeader', 'Результаты поиска')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.search'))

@section('LayoutSectionPageContent')
    @foreach($postsTreeArray as $postItemId => $postItemName)

        <a href="{{ route('site.post', $postItemId) }}">{{ $postItemName }}</a><br/>

    @endforeach
@stop
