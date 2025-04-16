@extends('layouts.default')

@section('LayoutSectionPageTitle', $post->name)
@section('LayoutSectionPageHeader', $post->name)
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.post', $post))

@section('LayoutSectionPageContent')
    <div class="row">
        <div class="col-sm-12">
            <div class="overflow-scroll" style="overflow-x: scroll;">
            <table>
            <tr>
                @foreach($postsWithLogo as $postLogo)
                    @php /** $postLogo App\Models\Post */ @endphp
                    <td align="center" style="padding: 5px;">
                    <a href="{{ route('site.post', $postLogo->id) }}" style="display: inline-block">
                        <img src="{{ asset('storage/'.$postLogo->logo_image) }}" height="38" style="margin: 5px;"><br />
                        <span class="badge badge-secondary" @if($postLogo->id == $post->id) style="background: #a4c95b;" @endif>{{ $postLogo->name_short }}</span>
                    </a>
                    </td>
                @endforeach
            </tr>
            </table>
            </div>
        </div>
    </div>
    <hr />
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
            <center>
                <a href="{{ route('site.sitemap') }}" class="btn btn-warning">Оглавление</a>
            </center>
        </div>
        <div class="col-sm-7">
            <x-post-content-type current-post-id="{{ $post->id }}"/>
            {{--            <center>--}}
            {{--                <button class="btn btn-warning" disabled>Обратно</button>--}}
            {{--                <button class="btn btn-warning" disabled>Редактировать сортировку</button>--}}
            {{--                <button class="btn btn-warning" disabled>Далее</button>--}}
            {{--            </center>--}}
            @can('update', $post)
                <center>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.post.edit-sorting', $post->id) }}"
                           class="btn btn-default btn-lg" target="_blank">
                            Изменить сортировку
                        </a>
                    </div>
                </center>
                <hr/>
            @endcan
            @foreach($postNotes as $note)
                <div class="panel panel-default" style="@if($note->is_close == 1) opacity: 0.2; @endif">
                    <div class="panel-heading">
                        #{{ $note->id }} | {{ $note->created_at }}
                        @if($note->user_id === 1)
                            <span class="glyphicon glyphicon glyphicon-leaf" aria-hidden="true"></span>
                        @endif
                        <span class="label label-default" style="float: right;">
                        @if($note->is_close == 1)
                                Спам
                            @else
                                Проверено
                            @endif
                        </span>
                    </div>
                    <div class="panel-body">
                        {!! clean($note->bodytext, 'default') !!}
                        @if($note->is_close != 1)
                            <form action="{{ route('site.note-or-pic-close',$note->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Убрать в спам</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="alert alert-success">
                Здесь можно оставить комментарий!
            </div>
            @component('components.note.form-note')
                @slot('route', route('site.post-store', $post->id))
                @slot('inputPlaceholder', 'Введите комментарий')
                @slot('btmSubmitName', 'Добавить комментарий')
            @endcomponent
        </div>
        <div class="col-sm-2">
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
                        <ul class="nav navbar-nav">
                            <li href="">
                                <a href="{{ route('site.doc-cat', 0) }}">-- Все --</a>
                                <x-menu-sidebar
                                        parent-id="{{ $post->parent_id }}"
                                        current-post-id="{{ $post->id }}"
                                        html-ul-class="dropdown-menu menu-sidebar-level-next"
                                />
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </div>
@endsection
