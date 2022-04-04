<div class="btn-group btn-group-justified" role="group">
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.create', ['default_parent_id' => $post->parent_id]) }}" type="button"
           class="btn btn-warning btn-lg">
            Добавить знание
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-success btn-lg">
            Редактировать знание
        </a>
    </div>
    <div class="btn-group" role="group">
        <a href="{{ route('admin.post.create', ['default_parent_id' => $post->id]) }}" type="button"
           class="btn btn-warning btn-lg">
            Создать ветку
        </a>
    </div>
</div>
<hr class="my-12">
