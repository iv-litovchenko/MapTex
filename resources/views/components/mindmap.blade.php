{{-- Вывод родительского дерева --}}
@if(count($rowsBreadcrumbs) > 0)

    @foreach ($rowsBreadcrumbs as $row)
        <ol class="children">
            <li class="children__item" style="@if($row->logo_image) margin: 20px 0 20px 0; @endif">

                {{--Подключаем дублирующийся код--}}
                @include('components.mindmap-div')

            </li>
        </ol>
    @endforeach

@endif

{{-- Вывод дерева --}}
@if(count($rows) > 0)

    <ol class="children">
        @foreach ($rows as $row)
            <li class="children__item" style="@if($row->logo_image) margin: 20px 0 20px 0; @endif">

                {{--Подключаем дублирующийся код--}}
                @include('components.mindmap-div')

                @if($row->branch_stop_flag != 1)
                    <x-mindmap record-id="{{ $row->id }}"/>
                @endif

            </li>
        @endforeach
    </ol>

@endif
