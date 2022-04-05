<hr class="my-12">
<center>
    @foreach(explode(chr(10),$post->post_images) as $image)
        <img src="{{ asset('storage/'.$image) }}"
             class="img-thumbnail img-site-figma"/>
        <hr/>
    @endforeach
</center>
