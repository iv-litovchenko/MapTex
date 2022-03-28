@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Главная')
@section('LayoutSectionPageHeader', 'Главная')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.home'))

@section('LayoutSectionPageContent')

    <div class="mindmap">
        <div class="node node_root context-menu-one btn btn-neutral">
            <div class="node__text" onclick="window.location.href='{{ route('site.home') }}';">
                Roadmap backend
            </div>
        </div>
        <x-mindmap record-id="0"/>
    </div>

    @if(isset($images))
        <hr class="my-12">
        <center>
            @foreach($images as $image)
                <img src="{{ asset('uploads/image/home/'.$image->getBasename()) }}"
                     style="width: 100%; max-width: 50%;"/>
                <br/>
            @endforeach
        </center>
    @endif
@stop

@section('LayoutSectionPageJsFooterCode')

    @parent
    <script type="text/javascript">

        {{--$(function () {--}}
        {{--    $('.mindmap').mindmap();--}}
        {{--    $.contextMenu({--}}
        {{--        selector: '.context-menu-one',--}}
        {{--        callback: function (key, options) {--}}
        {{--            // var m = "clicked: " + key;--}}
        {{--            // window.console && console.log(m) || alert(m);--}}
        {{--            // Вставка элемента--}}
        {{--            if (key == 'create') {--}}
        {{--                var httpLink = '{{ route('admin.post.create', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                var dataParentId = $(this).data("parent-id");--}}
        {{--                httpLink = httpLink.replace(100, parseInt(dataParentId));--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--            // Создание новой ветки--}}
        {{--            if (key == 'createBrunch') {--}}
        {{--                var httpLink = '{{ route('admin.post.create', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                var dataParentId = $(this).data("parent-id")--}}
        {{--                httpLink = httpLink.replace(100, dataId);--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--            // Редактирование--}}
        {{--            if (key == 'edit') {--}}
        {{--                var httpLink = '{{ route('admin.post.edit', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                httpLink = httpLink.replace(100, dataId);--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--            // Редактирование сортировки--}}
        {{--            if (key == 'editSorting') {--}}
        {{--                var httpLink = '{{ route('admin.post.edit-sorting', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                httpLink = httpLink.replace(100, dataId);--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--            // Изменить родителя--}}
        {{--            if (key == 'editParent') {--}}
        {{--                var httpLink = '{{ route('admin.post.edit-parent', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                httpLink = httpLink.replace(100, dataId);--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--        },--}}
        {{--        items: {--}}
        {{--            "create": {name: "Добавить элемент"},--}}
        {{--            "edit": {name: "Редактировать элемент"},--}}
        {{--            "editSorting": {name: "Редактировать (сортировку)"},--}}
        {{--            "editParent": {name: "Редактировать (родителя)"},--}}
        {{--            "createBrunch": {name: "Создать ветку элементов"},--}}
        {{--        }--}}
        {{--    });--}}
        {{--    $.contextMenu({--}}
        {{--        selector: '.context-menu-two',--}}
        {{--        callback: function (key, options) {--}}
        {{--            // var m = "clicked: " + key;--}}
        {{--            // window.console && console.log(m) || alert(m);--}}
        {{--            if (key == 'create') {--}}
        {{--                var httpLink = '{{ route('admin.post.create', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                httpLink = httpLink.replace(100, dataId);--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--            if (key == 'edit') {--}}
        {{--                var httpLink = '{{ route('admin.post.edit', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                httpLink = httpLink.replace(100, dataId);--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--            // Редактирование сортировки--}}
        {{--            if (key == 'editSorting') {--}}
        {{--                var httpLink = '{{ route('admin.post.edit-sorting', 100) }}';--}}
        {{--                var dataId = $(this).data("id");--}}
        {{--                httpLink = httpLink.replace(100, dataId);--}}
        {{--                window.location.href = httpLink;--}}
        {{--            }--}}
        {{--        },--}}
        {{--        items: {--}}
        {{--            "create": {name: "Добавить элемент"},--}}
        {{--            "edit": {name: "Редактировать элемент"},--}}
        {{--            "editSorting": {name: "Редактировать сортировку"}--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

    </script>

@stop
