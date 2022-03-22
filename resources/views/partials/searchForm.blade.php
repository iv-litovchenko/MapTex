<form action="{{ route('search') }}">
    @csrf
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Введите запрос на поиск">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
        </span>
    </div>
</form>
