@extends('layouts.default')

@section('LayoutSectionPageTitle', $post->name)
@section('LayoutSectionPageHeader', $post->name)
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.post', $post))

@section('LayoutSectionPageContent')

    <div class="row">
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
                        <span class="visible-xs navbar-brand">Навигация</span>
                    </div>
                    <div class="navbar-collapse collapse sidebar-navbar-collapse">
                        <x-menu-sidebar parent-id="0" current-post-id="{{ $post->id }}"/>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
            {{--            <center>--}}
            {{--                <button class="btn btn-warning" disabled>Оглавление</button>--}}
            {{--            </center>--}}
        </div>
        <div class="col-sm-9">
            <x-post-content-type current-post-id="{{ $post->id }}"/>
            {{--            <center>--}}
            {{--                <button class="btn btn-warning" disabled>Обратно</button>--}}
            {{--                <button class="btn btn-warning" disabled>Редактировать сортировку</button>--}}
            {{--                <button class="btn btn-warning" disabled>Далее</button>--}}
            {{--            </center>--}}
            <center>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.post.edit-sorting', $post->id) }}"
                       class="btn btn-default btn-lg" target="_blank">
                        Изменить сортировку
                    </a>
                </div>
            </center>
        </div>
    </div>

@endsection
