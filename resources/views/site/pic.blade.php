@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Барахолка (разные картинки)')
@section('LayoutSectionPageHeader', 'Барахолка (разные картинки)')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.pic'))

@section('LayoutSectionPageContent')
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                @foreach($notes->items() as $note)
                    <div class="col-sm-4">
                        <div class="panel panel-default" style="@if($note->is_close == 1) opacity: 0.2; @endif">
                            <div class="panel-heading">
                                #{{ $note->id }} | {{ $note->created_at }}
                                @if($note->user_id === 1)
                                    <span class="glyphicon glyphicon glyphicon-leaf" aria-hidden="true"></span>
                                @endif
                                <span class="" style="float: right;">
                                    @if($note->is_close == 1)
                                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                                    @else
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    @endif
                                </span>
                            </div>
                            <div class="panel-body">
                                <a href="{{ asset($note->upload_image) }}">
                                    <img src="{{ asset('storage/'.$note->upload_image) }}"
                                         class="img-site-pic"/>
                                </a>
                                <center>
                                    <b>{{ $note->bodytext }}</b><br/>
                                    @if($note->is_close != 1)
                                        <form action="{{ route('site.note-or-pic-close',$note->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">Закрыть</button>
                                        </form>
                                    @endif
                                </center>
                            </div>
                        </div>
                    </div>
                    @if(is_int($loop->iteration/3))
                        <div class="clearfix"></div>
                    @endif
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
                    <input type="file" class="form-control" name="upload_image[upload]">
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
