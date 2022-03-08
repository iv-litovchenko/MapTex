<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $pageTitle }} | IT-заметки</title>
    <link rel="stylesheet" href="/assets/mindmap/dist/mindmap.css">
    <link rel="stylesheet" href="/assets/contextmenu/dist/jquery.contextMenu.css">
</head>
<body>

@if(session('success'))
    {{ session('success') }}
@endif

<div class="mindmap">
    {{--    @include('inc/rowChildren', ['brunch_type' => \App\Models\TechnologyModel::BRUNCH_LEFT_CODE])--}}
    @if(isset($back_id))
        <ol class="children children_leftbranch">
            <li class="children__item">
                <div class="node" style="">
                    <div class="node__text">
                        @if($back_id > 0)
                            <a href="{{ route('tech',['id'=>$back_id]) }}">Обратно</a>
                        @else
                            <a href="{{ route('home') }}">Обратно</a>
                        @endif
                    </div>
                </div>
            </li>
        </ol>
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
    @include('inc/rowChildren')
</div>


@if (is_object($row) && $row['is_page_flag'] == 1)
    <div style="margin: 0 auto; margin-top: 100px; padding-bottom: 300px; width: 50%;">
        <h1>{{ $row->name }}</h1>
        <hr/>
        <pre>{{ $row->description }}</pre>
    </div>
@endif

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/assets/mindmap/dist/mindmap.js"></script>
<script src="/assets/contextmenu/dist/jquery.contextMenu.js"></script>
<script type="text/javascript">

    $(function () {
        $('.mindmap').mindmap();
        $.contextMenu({
            selector: '.context-menu-one',
            callback: function (key, options) {
                // var m = "clicked: " + key;
                // window.console && console.log(m) || alert(m);
                // Вставка элемента
                if (key == 'insertAfter') {
                    var httpLink = '{{ route('backend-add', ['parent_id'=>100,'sorting'=>200]) }}';
                    var dataId = $(this).data("id");
                    var dataParentId = $(this).data("parent-id");
                    var dataSorting = $(this).data("sorting");
                    httpLink = httpLink.replace(100, dataParentId);
                    httpLink = httpLink.replace(200, dataSorting);
                    window.location.href = httpLink;
                }
                // Создание новой ветки
                if (key == 'createBrunch') {
                    var httpLink = '{{ route('backend-add', ['parent_id'=>100,'sorting'=>200]) }}';
                    var dataId = $(this).data("id");
                    var dataParentId = $(this).data("parent-id");
                    var dataSorting = $(this).data("sorting");
                    httpLink = httpLink.replace(100, dataId);
                    httpLink = httpLink.replace(200, 0);
                    window.location.href = httpLink;
                }
                // Редактирование
                if (key == 'edit') {
                    var httpLink = '{{ route('backend-update', ['id'=>100]) }}';
                    var dataId = $(this).data("id");
                    httpLink = httpLink.replace(100, dataId);
                    window.location.href = httpLink;
                }
                // Редактирование сортировки
                if (key == 'edit_sorting') {
                    var httpLink = '{{ route('backend-update-sorting', ['id'=>100]) }}';
                    var dataId = $(this).data("id");
                    httpLink = httpLink.replace(100, dataId);
                    window.location.href = httpLink;
                }
            },
            items: {
                "insertAfter": {name: "Вставить элемент после"},
                "createBrunch": {name: "Создать ветку элементов"},
                "edit": {name: "Редактировать"},
                "edit_sorting": {name: "Редактировать сортировку"}
            }
        });
        $.contextMenu({
            selector: '.context-menu-two',
            callback: function (key, options) {
                // var m = "clicked: " + key;
                // window.console && console.log(m) || alert(m);
                if (key == 'insert') {
                    var httpLink = '{{ route('backend-add', ['parent_id'=>100,'sorting'=>200]) }}';
                    var dataId = $(this).data("id");
                    var dataSorting = $(this).data("sorting");
                    httpLink = httpLink.replace(100, dataId);
                    httpLink = httpLink.replace(200, dataSorting);
                    window.location.href = httpLink;
                }
                if (key == 'edit') {
                    var httpLink = '{{ route('backend-update', ['id'=>100]) }}';
                    var dataId = $(this).data("id");
                    httpLink = httpLink.replace(100, dataId);
                    window.location.href = httpLink;
                }
                // Редактирование сортировки
                if (key == 'edit_sorting') {
                    var httpLink = '{{ route('backend-update-sorting', ['id'=>100]) }}';
                    var dataId = $(this).data("id");
                    httpLink = httpLink.replace(100, dataId);
                    window.location.href = httpLink;
                }
            },
            items: {
                "insert": {name: "Добавить элемент"},
                "edit": {name: "Редактировать"},
                "edit_sorting": {name: "Редактировать сортировку"}
            }
        });
    });

</script>
</body>
</html>
