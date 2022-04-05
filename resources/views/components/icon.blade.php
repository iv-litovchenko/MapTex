@if($asset)

    <img
        src="{{ asset('storage/'.$asset) }}"
        height="{{ $height }}"
        style="
            vertical-align: {{ $valign }};
            padding: 0px;
            border-radius: 0%;
            border: gray 0px solid;
            "
    />

@else

    <img
        src="{{ asset('img/page.png') }}"
        height="{{ $height }}"
        style="
            vertical-align: {{ $valign }};
            padding: 0px;
            border-radius: 0%;
            border: gray 0px solid;
            "
    />

@endif
