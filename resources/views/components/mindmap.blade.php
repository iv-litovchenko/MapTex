{{-- Вывод дерева --}}
@if(count($rows) > 0)
    <ol class="children">
        @foreach ($rows as $row)
            <li class="children__item">
                <div class="node">
                    <div class="node__text context-menu-one">
                        <a href="{{ route('site.post', $row->id) }}" target="_blank">
                            @component('components.icon')
                                @slot('src', asset('storage/site/post/logo/'.$row->logo_image))
                                @slot('height', 22)
                                @slot('valign', 'top')
                            @endcomponent
                            {{ Str::limit($row->name, 24) }}
                        </a>
                    </div>
                </div>
                <x-post-content-type-mind-map record-id="{{ $row->id }}"/>
            </li>
        @endforeach
    </ol>
@endif
