@extends('layouts.default')

@section('pageLayoutTitle', 'Результаты поиска')
@section('pageLayoutHeader', 'Результаты поиска')
@section('pageLayoutBreadcrumb', Breadcrumbs::render('site.search'))

@section('content')
    <center>
        <h3>Результаты поиска: {{ $q }}</h3>
        <hr/>
        <div>
            @foreach($searchResult as $searchItem)
                <h4 style="padding-top: 15px;">
                    <a href="{{ route('tech', ['id'=>$searchItem->id]) }}" style="font-size: 32px;">
                        {{ $searchItem->name }}
                    </a>
                </h4>
                <div class="backlightText" style="width: 50%; padding: 15px; background: #eee; text-align: justify">
                    {!! $searchItem->description !!}
                </div>
                <hr/>
            @endforeach
        </div>
    </center>

    <style rel="stylesheet">

        .sot {
            display: inline-block;
            padding: 5px;
            background: yellow;
            border-radius: 10px;
            border: #afafaf 3px solid;
            font-width: bold;
            font-size: 15px;
            font-color: black;
        }

    </style>

    <script type="text/javascript">

        // Подсветка текста
        $(function () {
            var value = '{{ $q }}';
            $('.backlightText').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                nt = $(this).text();
                $(this).html(nt.replace(value, "<span class=\"sot\">" + value + "</span>"));
            });
        });

    </script>
@stop
