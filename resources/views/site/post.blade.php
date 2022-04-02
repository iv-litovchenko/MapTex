@extends('layouts.default')

@section('LayoutSectionPageTitle', $post->name)
@section('LayoutSectionPageHeader', $post->name)
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.post', $post))

@section('LayoutSectionPageContent')

    <div class="mindmap">
        <div class="node node_root context-menu-one btn btn-neutral">
            <div class="node__text" onclick="window.location.href='{{ route('site.home') }}';">
                Roadmap backend
            </div>
        </div>
        <x-mindmap record-id="{{ $post->id }}" show-breadcrumbs="1"/>
    </div>

    <hr class="my-12">

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
                        <x-menu-sidebar parent-id="0"/>
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Menu Item 1</a></li>
                            <li><a href="#">Menu Item 2</a></li>
                            <li class="dropdown">
                                <a href="#">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu menu-sidebar-level-next">
                                    <li><a href="#">Action</a></li>
                                    <li>
                                        <a href="#">Another action <b class="caret"></b></a>
                                        <ul class="dropdown-menu menu-sidebar-level-next">
                                            <li><a href="#">Level 3</a></li>
                                            <li><a href="#">Level 3</a></li>
                                            <li><a href="#">Level 3</a></li>
                                            <li><a href="#">Level 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Something else here</a></li>
                                    <!-- <li class="divider"></li> -->
                                    <!-- <li class="dropdown-header">Nav header</li> -->
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Menu Item 4</a></li>
                            <li><a href="#">Reviews <span class="badge">1,118</span></a></li>
                        </ul>
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
