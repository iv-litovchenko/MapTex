@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Главная')
@section('LayoutSectionPageHeader', 'Главная')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.home'))

@section('LayoutSectionPageContent')
    <div class="jumbotron">
        <h1>PHP: Roadmap backend</h1>
        <p>
            На данном проекте знакомлюсь с Web-разработкой и изучаю все, что с этим связано, делюсь опытом.
            Основа это Laravel (<a href="https://github.com/iv-litovchenko/maptex/">исходники проекта на github</a>
            - здесь можно добавить свой реквест в этот проект).
            Возможно, ты найдешь здесь что-то полезное для себя, прокомментируешь то,
            что есть или добавишь что-то новое свое!
        </p>
        <p>
            Также данный проект стал для меня спасением от бесконечного числа заметок
            на бумажках (листочках, чеках) и в тетрадках в линеечку, в клеточку, в кружочек
            которые потом лежат, лежат и все. А здесь открыл, читаешь, вспоминаешь и добавляешь новое.
            Пробовал разные сервисы для всего этого - но мне нравится мой проект.
            Минимализм. Только самое необходимое. Все в 1 месте. Вдохновляют - БД, ООП, принципы и шаблоны
            проектирования.
            Начал 15 февраля 2022 г.
        </p>
        <p>
            <a class="btn btn-primary btn-lg" href="http://ivan-litovchenko.ru/" role="button">
                Мой скромный сайт №2
            </a>
        </p>
    </div>
{{--    <div class="mindmap jumbotron">--}}
{{--        <div class="node node_root context-menu-one btn btn-neutral">--}}
{{--            <div class="node__text">--}}
{{--                <span class="glyphicon glyphicon glyphicon-plane" aria-hidden="true"></span>--}}
{{--                Карта--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <x-post-content-type parent-post-id="root"/>--}}
{{--    </div>--}}
    <div class="row">
        @foreach($posts as $post)
            <div class="col-sm-4">
                <a href="{{ route('site.post', $post->id) }}" class="thumbnail no-underline">
                    <div class="caption">
                        <h3>
                            @component('components.icon')
                                @slot('data', $post)
                                @slot('height', '32')
                                @slot('valign', 'top')
                            @endcomponent
                            {{ $post->name }}
                        </h3>
                    </div>
                </a>
            </div>
            @if(is_int($loop->iteration/3))
                <div class="clearfix"></div>
            @endif
        @endforeach
    </div>
    {{--    <center>--}}
    {{--        <div class="btn-group" role="group">--}}
    {{--            <a href="{{ route('admin.post.edit-sorting', 0) }}"--}}
    {{--               class="btn btn-default btn-lg" target="_blank">--}}
    {{--                Изменить сортировку дочерних элементов--}}
    {{--            </a>--}}
    {{--        </div>--}}
    {{--    </center>--}}
@stop
