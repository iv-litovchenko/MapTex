<div class="btn-group btn-group-justified" role="group">
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.create', ['default_parent_id' => $post->parent_id]) }}"
           class="btn btn-warning btn-lg">
            Добавить
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.edit', $post->id) }}"
           class="btn btn-success btn-lg">
            Изменить
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.edit-sorting', $post->id) }}"
           class="btn btn-success btn-lg" target="_blank">
            Сортировка
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.delete', $post->id) }}"
           class="btn btn-danger btn-lg">
            Удалить
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.create', ['default_parent_id' => $post->id]) }}"
           class="btn btn-info btn-lg">
            Ветка
        </a>
    </div>
</div>
<hr class="my-12">
