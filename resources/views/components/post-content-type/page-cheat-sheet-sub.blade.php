@if(count($subPosts)>0)
    @if($htmlHeaderSize > 2)
        <div style="padding: 10px 20px; margin-bottom: 10px; border-left: #eceeef 5px solid;">
            @endif
            @foreach($subPosts as $subPost)
                <h{{ $htmlHeaderSize }}>{{ $subPost->name }}</h{{ $htmlHeaderSize }}>
                @include('components.post-content-type.partials.buttons', ['post'=>$subPost])
                @include('components.post-content-type.partials.content', ['post'=>$subPost])
                @include('components.post-content-type.partials.images', ['post'=>$subPost])
                <x-post-content-type parent-post-id="{{ $subPost->id }}" html-header-size="3"/>
            @endforeach
            @if($htmlHeaderSize > 2)
        </div>
    @endif
@endif
