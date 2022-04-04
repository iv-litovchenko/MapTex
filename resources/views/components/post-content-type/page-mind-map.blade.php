@include('components.post-content-type.partials.h1')
@include('components.post-content-type.partials.buttons')

<div class="mindmap jumbotron">
    <div class="node node_root context-menu-one btn btn-neutral">
        <div class="node__text">
            <span class="glyphicon glyphicon glyphicon-plane" aria-hidden="true"></span>
        </div>
    </div>
    <x-post-content-type parent-post-id="{{ $post->id }}"/>
</div>
<hr class="my-12">

@include('components.post-content-type.partials.content')
@include('components.post-content-type.partials.images')
