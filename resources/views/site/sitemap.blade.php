@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Карта сайта')
@section('LayoutSectionPageHeader', 'Карта сайта')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.sitemap'))

@section('LayoutSectionPageContent')
    <div style="overflow: scroll; border: red 0px solid;">
        <ol type="I">
            @foreach($postsList as $k => $post)
                <li>
                    <h3><a href="{{ route('site.post', $post->id) }}"
                       style="white-space: nowrap;">{{ $post->name }}</a>
                    </h3>
                    <ol type="I">
                        @foreach($post->children as $k2 => $post2)
                            <li>
                                @if(intval($post2->is_protected) == true)[🔒] @endif
                                <a href="{{ route('site.post', $post2->id) }}"
                                   style="white-space: nowrap;">{{ $post2->name }}</a><br/>
                                <ol type="I">
                                    @foreach($post2->children as $k3 => $post3)
                                        <li>
                                            @if(intval($post3->is_protected) == true)[🔒] @endif
                                            <a href="{{ route('site.post', $post3->id) }}"
                                               style="white-space: nowrap;">{{ $post3->name }}</a><br/>
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        @endforeach
                    </ol>
                </li>
            @endforeach
        </ol>
    </div>
@stop
