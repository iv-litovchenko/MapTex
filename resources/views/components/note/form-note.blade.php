
<form action="{{ $route }}" method="post">
    @csrf
    <div class="form-group">
                    <textarea id="" type="text" class="form-control" name="bodytext"
                              rows="15" placeholder="{{ $inputPlaceholder }}"
                    >{{ old('bodytext') }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">{{ $btmSubmitName }}</button>
</form>