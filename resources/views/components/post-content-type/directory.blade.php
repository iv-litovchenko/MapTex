@include('components.post-content-type.partials.h1')
@include('components.post-content-type.partials.buttons')
@include('components.post-content-type.partials.content')
@include('components.post-content-type.partials.images')

<div class="container-flex">
    <div class="row">
        @foreach($subPosts as $subPost)
            <div class="col-sm-4">
                <a href="{{ route('site.post', $subPost->id) }}" class="thumbnail no-underline">
                    <div class="caption">
                        <h4>
                            @component('components.icon')
                                @slot('asset', $subPost->logo_image)
                                @slot('height', '20')
                                @slot('valign', 'top')
                            @endcomponent
                            {{ $subPost->name }}
                        </h4>
                    </div>
                </a>
            </div>
            @if(is_int($loop->iteration/3))
                <div class="clearfix"></div>
            @endif
        @endforeach
    </div>
</div>
