@include('components.post-content-type.partials.h1')
@include('components.post-content-type.partials.buttons')
@include('components.post-content-type.partials.content')
@include('components.post-content-type.partials.images')
<x-post-content-type parent-post-id="{{ $post->id }}" html-header-size="2"/>
