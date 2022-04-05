@if($post->figma_image)

    {{-- Изображение фигма --}}
    <img src="{{ asset('storage/'.$post->figma_image) }}" class="img-thumbnail" style="width: 100%;">
    <hr class="my-12">

@endif

@if($post->description)

    {{-- Контент --}}
    {!! clean($post->description, 'default') !!}
    <hr class="my-12">

@endif
