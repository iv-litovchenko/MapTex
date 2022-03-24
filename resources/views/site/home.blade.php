@extends('layouts.default')

@section('pageLayoutTitle', 'Главная')
@section('pageLayoutHeader', 'Главная')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('site.home'))

@section('content')
    <div class="mindmap">
        @if(isset($back_id))
            <ol class="children children_leftbranch">
                <li class="children__item">
                    <div class="node" style="">
                        <div class="node__text">
                            <a href="{{ route('site.home') }}">Главная</a>
                        </div>
                    </div>
                </li>
            </ol>
            @if($back_id > 0)
                @include('partials/rowParent', ['parentId'=>$back_id])
            @endif
        @endif
        <div class="node node_root context-menu-two btn btn-neutral"
             @if (is_object($row))
             data-id="{{ $row->id }}"
             data-parent-id="{{ $row->parent_id }}"
             data-sorting="{{ $row->sorting }}"
             @else
             data-id="0"
             data-parent-id="0"
             data-sorting="0"
            @endif
        >
            <div class="node__text">Roadmap backend</div>
        </div>
        @include('partials/rowChildren')
    </div>

    @if (is_object($row) && $row['is_page_flag'] == 1)
        <div style="margin: 0 auto; margin-top: 100px; padding-bottom: 300px; width: 50%;">
            <h1>{{ $row->name }}</h1>
            <hr/>
            <center>
                @foreach($files as $file)
                    <img src="/images/posts/{{ $row->id }}/{{ $file->getBasename() }}"
                         style="width: 100%; max-width: 100%; border: gray 3px solid;"/>
                    @auth
                        <br/>
                        <b>{{ $file->getBasename() }}</b>
                    @endauth
                    <br/>
                    <hr/>
                @endforeach
            </center>
            <pre>{{ $row->description }}</pre>
            <br/>
            {!! $row->description_tinymce !!}
        </div>
    @endif

    @if(isset($images))
        <br/>
        <br/>
        <center>
            @foreach($images as $image)
                <img src="/images/home/{{ $image->getBasename() }}"
                     style="width: 100%; max-width: 50%;"/>
                <br/>
            @endforeach
        </center>
    @endif
@stop
