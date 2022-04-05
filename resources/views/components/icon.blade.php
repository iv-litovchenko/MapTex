@if($asset)

    <img
        src="{{ asset('storage/'.$asset) }}"
        height="{{ $height }}"
        style="
            vertical-align: {{ $valign }};
            background: white;
            padding: 3px;
            border-radius: 100%;
            border: gray 1px solid;
            "
    />

@else

    <img
        src="{{ asset('img/logo.png') }}"
        height="{{ $height }}"
        style="
            vertical-align: {{ $valign }};
            background: white;
            padding: 3px;
            border-radius: 100%;
            border: gray 1px solid;
            "
    />

@endif
