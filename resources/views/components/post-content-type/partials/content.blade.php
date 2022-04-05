@if($post->fiagma_image)

    <img src="{{ asset('storage/'.$post->figma_image) }}" class="img-thumbnail" style="width: 100%;">
    <hr class="my-12">

@endif

{!! clean($post->description, 'default') !!}
