@if($changeAllow == false)
    <input type="hidden" name="parent_id" value="{{ old('parent_id', $default) }}">
@endif

<select class="form-control"
        @if($changeAllow == true)
        name="parent_id" size="{{ count($postsTreeArray)+1 }}"
        @else
        name="parent_id_zzz" disabled
    @endif
>
    <option value="">-- Без родителя (корень) --</option>
    @foreach($postsTreeArray as $postItemId => $postItemName)
        <option
            value="{{ $postItemId }}"
            {{ (collect(old('parent_id', $default))->contains($postItemId)) ? 'selected' : '' }}
        >
            {{ $postItemName }}
        </option>
    @endforeach
</select>
