@if($post->post_images)
    @foreach(explode(chr(10),$post->post_images) as $image)
        <img src="{{ asset('storage/'.$image) }}"
             class="img-thumbnail img-site-figma" style="text-align: center"/>
        <hr/>
    @endforeach
@endif
