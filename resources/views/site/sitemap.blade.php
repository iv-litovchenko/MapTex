@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Карта сайта')
@section('LayoutSectionPageHeader', 'Карта сайта')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.sitemap'))

@section('LayoutSectionPageContent')
<div style="overflow: scroll; border: red 0px solid;">
    @foreach($postsTreeArray as $postItemId => $postItemName)

		<a href="{{ route('site.post', $postItemId) }}" style="white-space: nowrap;">{{ $postItemName }}</a><br/>
		
    @endforeach
</div>
@stop
