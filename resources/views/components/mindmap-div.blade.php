<div class="node" style="
    position: relative; background: {{ $divCssBackgroundColor($row) }};
@if($row->logo_image) padding-left: 32px; @endif
    ">
    <div class="node__text context-menu-one"
         data-id="{{ intval($row->id) }}"
         data-parent-id="{{ intval($row->parent_id) }}"
         data-sorting="{{ intval($loop->iteration) }}"
    >
        @if($row->logo_image)
            <img src="{{ asset('uploads/site/post/logo/'.$row->logo_image) }}"
                 width="32"
                 height="32"
                 style="
                            position: absolute;
                            top: -6px;
                            left: -3px;
                            background: white;
                            padding: 3px;
                            border-radius: 100%;
                            border: gray 3px solid;">
        @endif
        @auth
            #{{ $row->id }} |
        @endauth
        <a href="{{ route('site.post', $row->id) }}">{{ Str::limit($row->name, 32) }}</a>
    </div>
</div>
