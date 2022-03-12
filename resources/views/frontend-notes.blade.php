@extends('layouts.frontend')

@section('content')
    <h3 align="center">Здесь можно оставить заметки - возможно они попадут в ветки!</h3>
    <form action="" method="post">
        @csrf
        <center>
            <textarea name="bodytext" style="
            width: 50%;
            height: 100px;
            border: gray 3px solid;
             border-radius: 10px;"
            ></textarea><br/>
            <input type="submit" value="Добавить">
        </center>
    </form>
    <br/>
    <br/>
    @foreach($rows as $row)
        <div style="margin: 0 auto; width: 50%; background: #eee;">
            #{{ $row->id }}.
            {{ $row->bodytext }}
            @if($row->is_me === 1)
                [Me!]
            @endif
        </div>
        <hr/>
    @endforeach
@stop
