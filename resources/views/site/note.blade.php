@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Барахолка (заметки)')
@section('LayoutSectionPageHeader', 'Барахолка (заметки)')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.note'))

@section('LayoutSectionPageContent')

    <div class="row">
        <div class="col-sm-8">
            @foreach($notes->items() as $note)
                <div class="panel panel-default" style="@if($note->is_close == 1) opacity: 0.2; @endif">
                    <div class="panel-heading">
                        #{{ $note->id }} | {{ $note->created_at }}
                        @if($note->user_id === 1)
                            <span class="glyphicon glyphicon glyphicon-leaf" aria-hidden="true"></span>
                        @endif
                        <span class="label label-default" style="float: right;">
                        @if($note->is_close == 1)
                                Заметка закрыта
                            @else
                                Заметка открыта
                            @endif
                        </span>
                    </div>
                    <div class="panel-body">
                        {!! clean($note->bodytext, 'default') !!}
                        @if($note->is_close != 1)
                            <form action="{{ route('site.note-or-pic-close',$note->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Закрыть</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
            {{ $notes->links() }}
            Всего записей: {{ $notes->total() }} <br/>
            <span class="glyphicon glyphicon glyphicon-leaf" aria-hidden="true"></span> - записи созданные
            администратором
        </div>
        <div class="col-sm-4">
            <div class="alert alert-success">
                Здесь можно оставить заметки - возможно они попадут в ветки!
            </div>
            @component('components.note.form-note')
                @slot('route', route('site.note-store'))
                @slot('inputPlaceholder', 'Введите барахольный текст')
                @slot('btmSubmitName', 'Добавить в барахолку')
            @endcomponent
        </div>
    </div>

@stop
