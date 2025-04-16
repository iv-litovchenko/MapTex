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
    <pre class="language-xml">{!! nl2br(file_get_contents(public_path('/interactive/content_wiki/' . $maptexContentLink))) !!}</pre>
    <pre class="language-xml">/interactive/content_wiki/{{ $maptexContentLink }}</pre>
    <hr class="my-12">

@endif
