@extends('layouts.default')

@section('pageLayoutTitle', 'Панель управления')
@section('pageLayoutHeader', 'Панель управления')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('admin.dashboard'))

@section('content')

    @php $menus = Menu::get('menu.admin.dashboard'); dd($menus); exit(); @endphp
    @foreach(Menu::get('menu.admin.dashboard') as $menu)
        {{ dd($menu) }}
        <div class="list-group">
            <div class="list-group-item active">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="list-group-item-heading">{{ $item->title }} ({{ $item->data->count })</h2>
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-default">Управлять</button>
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
        </div>
    @endforeach

@endsection
