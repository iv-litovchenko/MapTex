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

@if($post->maptex_content_link)

    {{-- Контент --}}
    {!! nl2br(file_get_contents($post->maptex_content_link)) !!}<br/><br/>
    <pre class="language-xml">{{ $post->maptex_content_link }}</pre>
    <hr class="my-12">

@endif
