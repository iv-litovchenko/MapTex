@if($data->logo_image)

    <img
        src="{{ asset('storage/'.$data->logo_image) }}"
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
        @if($data->post_type == 'directory')
        src="{{ asset('assets/images/folder.png') }}"
        @else
        src="{{ asset('assets/images/page.png') }}"
        @endif
        height="{{ $height }}"
        style="
            vertical-align: {{ $valign }};
            padding: 0px;
            border-radius: 0%;
            border: gray 0px solid;
            "
    />

@endif
