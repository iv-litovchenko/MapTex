@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Отказано в доступе!')
@section('LayoutSectionPageHeader', 'Отказано в доступе!')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.post'))

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
        <div class="col-sm-9">
            ...
        </div>
    </div>
@endsection
