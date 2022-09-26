@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Главная')
@section('LayoutSectionPageHeader', 'Главная')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.home'))

@section('LayoutSectionPageContent')
    <a href="http://plitkapro24.tilda.ws/"><img
            src="http://ivan-litovchenko.ru/typo3conf/ext/siteivlitovchenko/Resources/Public/Images/PlitkaPro24.Ru.png"
            width="100%" style="border-radius: 6px;"></a>
    <hr/>
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
            проектирования. Одним словом проект решает для меня две глобальные задачи: 1) помогает структурировать
            информацию (не стремлюсь сюда перенести документацию по какой-то технологии); 2) есть де попробовать
            любую новую фичу из мира Laravel.
            Начал 15 февраля 2022 г.
        </p>
        <p>
            Мечта - что бы клавиатура, мышка и монитор ушли в прошлое. Что останется? Тони Старк (AV,VR)!
        </p>
        <p>
            <a class="btn btn-primary btn-lg" href="http://ivan-litovchenko.ru/" role="button">
                Мой скромный сайт №2
            </a>
        </p>
    </div>
    {{--         <div class="mindmap jumbotron"> --}}
    {{--             <div class="node node_root context-menu-one btn btn-neutral"> --}}
    {{--                 <div class="node__text"> --}}
    {{--                     <span class="glyphicon glyphicon glyphicon-plane" aria-hidden="true"></span> --}}
    {{--                     Карта --}}
    {{--                 </div> --}}
    {{--             </div> --}}
    {{--             <x-post-content-type parent-post-id="root"/> --}}
    {{--         </div> --}}
    <hr/>
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
    <hr/>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Maptext: TODO (README.md)
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            {!! nl2br($todoReadmeMdContent) !!}<br/><br/><!--todo-->
                            <pre class="language-xml">https://raw.githubusercontent.com/iv-litovchenko/maptex/master/README.md</pre>
                        </div>
                    </div>
                </div>
            </div>
            <div
                style="position: relative; background: url({{ asset('assets/images/school-board.jpeg') }}); height: 800px; padding: 5%; overflow: scroll; color: wheat;">
                @component('components.todo.list')
                    @slot('todo_type', 0)
                    @slot('todos', $todos)
                @endcomponent
                @component('components.todo.list')
                    @slot('todo_type', 1)
                    @slot('todos', $todos)
                @endcomponent
                @component('components.todo.list')
                    @slot('todo_type', 2)
                    @slot('todos', $todos)
                @endcomponent
                @component('components.todo.list')
                    @slot('todo_type', 3)
                    @slot('todos', $todos)
                @endcomponent
                @component('components.todo.list')
                    @slot('todo_type', 4)
                    @slot('todos', $todos)
                @endcomponent
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-sm-8" style="height: 500px;">
            <svg viewBox="0 0 500 100" class="chart"
                 style="background: white; width: 100%; height: 500px; border-left: 1px dotted #555; border-bottom: 1px dotted #555;">
                <polyline
                    fill="none"
                    stroke="#0074d9"
                    stroke-width="2"
                    points="
                   00,120
                   20,60
                   40,80
                   60,20
                   80,80
                   100,80
                   120,60
                   140,100
                   160,90
                 "
                />
            </svg>
        </div>
        <div class="col-sm-4">
            <div style="height: 500px; padding-right: 15px; overflow: auto;">
                <h3>Стек технологий:</h3>
                <div class="list-group">
                    @foreach($postsWithStudyStatus as $postKeySs => $postValueSs)
                        <a href="{{ route('site.post', $postValueSs->id ) }}" class="list-group-item list-group-item-<?=\App\Models\Post::getStudyStatusMapper()[$postValueSs->study_status];?>">
{{--                             <span class="label label-default">Default</span> --}}
                            @component('components.icon')
                                @slot('data', $postValueSs)
                                @slot('height', 20)
                                @slot('valign', 'top')
                            @endcomponent
                            {{ $postValueSs->name_short }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-sm-12">
            <center>
                @foreach($postsWithLogo as $postLogo)
                    @php /** $postLogo App\Models\Post */ @endphp
                    <a href="{{ route('site.post', $postLogo->id) }}" style="display: inline-block">
                        <img src="{{ asset('storage/'.$postLogo->logo_image) }}" height="100"
                             style="margin: 15px;"><br/>
                        <span class="badge badge-secondary">{{ $postLogo->name_short }}</span>
                    </a>
                @endforeach
            </center>
        </div>
    </div>
@stop
