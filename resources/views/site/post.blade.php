@extends('layouts.default')

@section('LayoutSectionPageTitle', $post->name)
@section('LayoutSectionPageHeader', $post->name)
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.post', $post))

@section('LayoutSectionPageContent')

{{--    <div class="mindmap">--}}
{{--        <div class="node node_root context-menu-one btn btn-neutral">--}}
{{--            <div class="node__text" onclick="window.location.href='{{ route('site.home') }}';">--}}
{{--                Roadmap backend--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <x-mindmap record-id="{{ $post->id }}" show-breadcrumbs="1"/>--}}
{{--    </div>--}}

{{--    <hr class="my-12">--}}

    <div class="row">
        <div class="col-sm-9">

            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.post.create', ['default_parent_id' => $post->parent_id]) }}" type="button"
                       class="btn btn-warning btn-lg">Добавить знание</a>
                </div>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-success btn-lg">Редактировать
                        знание</a>
                </div>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.post.create', ['default_parent_id' => $post->id]) }}" type="button"
                       class="btn btn-warning btn-lg">Создать ветку</a>
                </div>
            </div>

            <hr class="my-12">

            {!! clean($post->description, 'default') !!}

            <hr class="my-12">

            <center>
                @foreach($images as $image)
                    <img src="{{ asset('storage/'.$image) }}"
                         class="img-thumbnail img-site-post"/>
                    @auth
                        <br/>
                        <b>{{ basename($image) }}</b>
                    @endauth
                    <br/>
                    <hr/>
                @endforeach
            </center>

        </div>
        <div class="col-sm-3">
            {{-- https://jonathanbriehl.com/posts/vertical-menu-for-bootstrap-3 --}}
            <div class="sidebar-nav">
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".sidebar-navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="visible-xs navbar-brand">Sidebar menu</span>
                    </div>
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <x-menu-sidebar parent-id="0" current-post-id="{{ $post->id }}"/>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </div>


    <div id="more_options">
        <div class="page-header">
            <h2>More Options</h2>
        </div>
        <div class="container-flex">
            <div class="row gutter-20">

                <div class="col-xs-6 col-sm-4">
                    <a href="/fulldocs/components/navmenu/navmenu-default" class="thumbnail no-underline btn-block">
                        <div class="caption">
                            <h3>Default navmenu</h3>
                        </div>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-4">
                    <a href="/fulldocs/components/navmenu/navmenu-fixed" class="thumbnail no-underline btn-block">
                        <div class="caption">
                            <h3>Navmenu Fixed to left or right</h3>
                        </div>
                    </a>
                </div>

                <div class="col-xs-6 col-sm-4">
                    <a href="/fulldocs/components/navmenu/navmenu-offcanvas" class="thumbnail no-underline btn-block">
                        <div class="caption">
                            <h3>Navmenu offcanvas</h3>
                        </div>
                    </a>
                </div>

                <div class="col-xs-12 col-sm-12">
                    <a href="/fulldocs/components/navmenu/navmenu-inverse" class="thumbnail no-underline btn-block">
                        <div class="caption">
                            <h3>Inverted Navmenu</h3>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
