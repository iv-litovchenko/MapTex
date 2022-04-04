<img
    {{--    @if(isset($src))--}}
    {{--    src="{{ assert('storage/'.$src) }}"--}}
    {{--    @else--}}
    src="{{ asset('storage/logo.png') }}"
    {{--    @endif--}}
    height="{{ $height }}"
    style="
        vertical-align: {{ $valign }};
        background: white;
        padding: 3px;
        border-radius: 100%;
        border: gray 1px solid;
        "
/>
