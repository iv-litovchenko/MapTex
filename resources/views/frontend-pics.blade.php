@extends('layouts.frontend')

@section('content')
    <center>
        @foreach($files as $file)
            <img src="images/pics/{{ $file->getBasename() }}"
                 style="width: auto; max-width: 50%; border: gray 3px solid;"/>
            <br/>
            <hr/>
        @endforeach
    </center>
@stop
