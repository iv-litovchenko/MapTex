<form action="{{ route('site.search') }}" method="get">
    @csrf
    <div class="input-group input-group-lg">
        <input id="qSearch" type="text" name="q" class="form-control" value="{{ $q ?? '' }}" placeholder="Введите запрос на поиск">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
        </span>
    </div>
</form>

