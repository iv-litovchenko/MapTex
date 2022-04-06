@if($data->logo_image)

    <img
        src="{{ asset('storage/'.$data->logo_images) }}"
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
        src="{{ asset('img/folder.png') }}"
        @else
        src="{{ asset('img/page.png') }}"
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
