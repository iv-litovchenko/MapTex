<div class="btn-group btn-group-justified" role="group">
    @can('create', $post)
        <div class="btn-group" role="group">
            <a href="{{ route('admin.post.create', ['default_parent_id' => $post->parent_id]) }}"
               class="btn btn-warning btn-lg">
                Добавить
            </a>
        </div>
    @endcan
    @can('update', $post)
        <div class="btn-group" role="group">
            <a href="{{ route('admin.post.edit', $post->id) }}"
               class="btn btn-success btn-lg">
                Изменить
            </a>
        </div>

    @endcan
    @can('delete', $post)
        <div class="btn-group" role="group">
            <a href="{{ route('admin.post.delete', $post->id) }}"
               class="btn btn-danger btn-lg">
                Удалить
            </a>
        </div>

    @endcan
    @can('create', $post)
        <div class="btn-group" role="group">
            <a href="{{ route('admin.post.create', ['default_parent_id' => $post->id]) }}"
               class="btn btn-info btn-lg">
                Ветка
            </a>
        </div>
    @endcan
</div>
<hr class="my-12">