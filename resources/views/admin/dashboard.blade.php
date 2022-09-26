@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Панель управления')
@section('LayoutSectionPageHeader', 'Панель управления')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.dashboard'))

@section('LayoutSectionPageContent')

    @foreach(Menu::get('menu.admin.dashboard')->all() as $menuItem)
        <div class="list-group">
            <div class="list-group-item active">
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="list-group-item-heading">{{ $menuItem->title }} ({{ $menuItem->data['count'] }})</h2>
                    </div><!-- /.col-lg-8 -->
                    <div class="col-lg-4 text-right">
                        <a href="{{ route( $menuItem->link->path['route'] ) }}" class="btn btn-default">Управлять записями</a>
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
            </div>
        </div>
    @endforeach

    <center>
        <a href="{{ route('admin.post.maptexcontentsync') }}" class="btn btn-warning btn-lg">
            Синхронизировать контент с "maptex_content"
        </a>
        |
        <a href="{{ route('admin.backup') }}" class="btn btn-warning btn-lg">
            Создать Бэкап проекта (файлы, БД)
        </a>
    </center>

@endsection

