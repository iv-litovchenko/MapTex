@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Панель управления')
@section('LayoutSectionPageHeader', 'Панель управления')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.dashboard'))

@section('LayoutSectionPageContent')

    @foreach(Menu::get('menu.admin.dashboard')->all() as $menuItem)
        <div class="list-group">
            <div class="list-group-item active">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="list-group-item-heading">{{ $menuItem->title }} ({{ $menuItem->data['count'] }})</h2>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6 text-right">
                        <a href="{{ route( $menuItem->link->path['route'] ) }}" class="btn btn-default">Управлять записями</a>
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
        </div>
    @endforeach

@endsection

