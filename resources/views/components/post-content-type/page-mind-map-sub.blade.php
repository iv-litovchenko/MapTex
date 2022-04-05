{{-- Вывод дерева --}}
@if(count($subPosts) > 0)
    <ol class="children">
        @foreach ($subPosts as $subPost)
            <li class="children__item">
                <div class="node">
                    <div class="node__text context-menu-one">
                        <a href="{{ route('site.post', $subPost->id) }}" target="_blank">
                            @component('components.icon')
                                @slot('asset', $subPost->logo_image)
                                @slot('height', 22)
                                @slot('valign', 'top')
                            @endcomponent
                            {{ Str::limit($subPost->name, 24) }}
                        </a>
                    </div>
                </div>
                <x-post-content-type parent-post-id="{{ $subPost->id }}"/>
            </li>
        @endforeach
    </ol>
@endif
