@extends('layouts.default')

@section('LayoutSectionPageTitle', 'TODO по сайту')
@section('LayoutSectionPageHeader', 'TODO по сайту')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.todo'))

@section('LayoutSectionPageContent')
    {!! nl2br(file_get_contents($todoHttpLink)) !!}<br/><br/>
    <pre class="language-xml">{{ $todoHttpLink }}</pre>
@stop
