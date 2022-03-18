@extends('layouts.frontend')

@section('content')
    <div class="mindmap">
        @if(isset($back_id))
            <ol class="children children_leftbranch">
                <li class="children__item">
                    <div class="node" style="">
                        <div class="node__text">
                            <a href="{{ route('home') }}">Главная</a>
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
            <div class="node__text">{{ Str::limit($pageHeader, 32) }}</div>
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
                         style="width: auto; max-width: 50%; border: gray 3px solid;"/>
                    <br/>
                    <hr/>
                @endforeach
            </center>
            <pre>{{ $row->description }}</pre>
            <br/>
            {!! $row->description_tinymce !!}
        </div>
    @endif

    <script type="text/javascript">

        $(function () {
            $('.mindmap').mindmap();
            $.contextMenu({
                selector: '.context-menu-one',
                callback: function (key, options) {
                    // var m = "clicked: " + key;
                    // window.console && console.log(m) || alert(m);
                    // Вставка элемента
                    if (key == 'create') {
                        var httpLink = '{{ route('admin.technologies.create', ['parent_id'=>100]) }}';
                        var dataId = $(this).data("id");
                        var dataParentId = $(this).data("parent-id");
                        httpLink = httpLink.replace(100, parseInt(dataParentId));
                        alert(httpLink);
                        window.location.href = httpLink;
                    }
                    // Создание новой ветки
                    if (key == 'createBrunch') {
                        var httpLink = '{{ route('admin.technologies.create', ['parent_id'=>100]) }}';
                        var dataId = $(this).data("id");
                        var dataParentId = $(this).data("parent-id")
                        httpLink = httpLink.replace(100, dataId);
                        window.location.href = httpLink;
                    }
                    // Редактирование
                    if (key == 'edit') {
                        var httpLink = '{{ route('admin.technologies.edit', ['id'=>100]) }}';
                        var dataId = $(this).data("id");
                        httpLink = httpLink.replace(100, dataId);
                        window.location.href = httpLink;
                    }
                    // Редактирование сортировки
                    if (key == 'editSorting') {
                        var httpLink = '{{ route('admin.technologies.edit-sorting', ['id'=>100]) }}';
                        var dataId = $(this).data("id");
                        httpLink = httpLink.replace(100, dataId);
                        window.location.href = httpLink;
                    }
                },
                items: {
                    "create": {name: "Добавить элеент"},
                    "createBrunch": {name: "Создать ветку элементов"},
                    "edit": {name: "Редактировать"},
                    "editSorting": {name: "Редактировать сортировку"}
                }
            });
            $.contextMenu({
                selector: '.context-menu-two',
                callback: function (key, options) {
                    // var m = "clicked: " + key;
                    // window.console && console.log(m) || alert(m);
                    if (key == 'create') {
                        var httpLink = '{{ route('admin.technologies.create', ['parent_id'=>100]) }}';
                        var dataId = $(this).data("id");
                        httpLink = httpLink.replace(100, dataId);
                        window.location.href = httpLink;
                    }
                    if (key == 'edit') {
                        var httpLink = '{{ route('admin.technologies.edit', ['id'=>100]) }}';
                        var dataId = $(this).data("id");
                        httpLink = httpLink.replace(100, dataId);
                        window.location.href = httpLink;
                    }
                    // Редактирование сортировки
                    if (key == 'editSorting') {
                        var httpLink = '{{ route('admin.technologies.edit-sorting', ['id'=>100]) }}';
                        var dataId = $(this).data("id");
                        httpLink = httpLink.replace(100, dataId);
                        window.location.href = httpLink;
                    }
                },
                items: {
                    "create": {name: "Добавить элемент"},
                    "edit": {name: "Редактировать"},
                    "editSorting": {name: "Редактировать сортировку"}
                }
            });
        });

    </script>
@stop
