<input type="hidden" name="parent_id" value="{{ old('parent_id', $default) }}">
<select class="form-control" name="parent_id_zzz" disabled>
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
