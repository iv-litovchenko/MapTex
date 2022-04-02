@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Барахолка (разные картинки)')
@section('LayoutSectionPageHeader', 'Барахолка (разные картинки)')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.pic'))

@section('LayoutSectionPageContent')
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                @foreach($notes->items() as $note)
                    <div class="col-sm-4 mh-100">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                #{{ $note->id }} | {{ $note->created_at }}
                                @if($note->user_id === 1)
                                    <span class="glyphicon glyphicon glyphicon-leaf" aria-hidden="true"></span>
                                @endif
                            </div>
                            <div class="panel-body">
                                <img src="{{ asset('storage/site/pic/'.$note->image_upload) }}"
                                     class="img-site-pic"/>
                                <center><b>{{ $note->bodytext }}</b></center>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $notes->links() }}
            Всего записей: {{ $notes->total() }} <br/>
            <span class="glyphicon glyphicon glyphicon-leaf" aria-hidden="true"></span> - записи созданные
            администратором
        </div>
        <div class="col-sm-4">
            <div class="alert alert-success">
                Здесь можно добавить картинки (по 1 шт.) - возможно они попадут в ветки!
            </div>
            <form action="{{ route('site.pic-store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control" name="image_upload">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="bodytext"
                           placeholder="Комментарий к изображению"
                           value="{{ old('bodytext') }}">
                </div>
                <button type="submit" class="btn btn-primary">Добавить в барахолку</button>
            </form>
        </div>
    </div>
@stop
