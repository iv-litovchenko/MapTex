<div>
    {{ $name }}
    @php
        print '(' . \App\Models\Technology::count() . ')';
    @endphp
</div>
