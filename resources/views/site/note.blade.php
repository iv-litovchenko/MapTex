@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Барахолка (заметки)')
@section('LayoutSectionPageHeader', 'Барахолка (заметки)')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.note'))

@section('LayoutSectionPageContent')

    <div class="row">
        <div class="col-sm-8">
            @foreach($notes->items() as $note)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        #{{ $note->id }} | {{ $note->created_at }}
                        @if($note->user_id === 1)
                            <span class="glyphicon glyphicon glyphicon-leaf" aria-hidden="true"></span>
                        @endif
                    </div>
                    <div class="panel-body">
                        {!! clean($note->bodytext, 'default') !!}
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
            <form action="{{ route('site.note-store') }}" method="post">
                @csrf
                <div class="form-group">
                    <textarea id="tinymce" type="text" class="form-control" name="bodytext"
                              rows="15" placeholder="Введите барахольный текст"
                    >{{ old('bodytext') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Добавить в барахолку</button>
            </form>
        </div>
    </div>

@stop
