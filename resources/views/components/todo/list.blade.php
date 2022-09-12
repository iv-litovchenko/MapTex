<h3>
    @if(auth()->user()->id == 1)
    <a href="{{ route('admin.todo.create', ['todo_type'=>$todo_type]) }}"><span class="label label-default">+</span></a>
    @endif
    <span class="label label-<?=\App\Models\Todo::getTypeMapper()[$todo_type];?>">
        <?=\App\Models\Todo::getTypeOptions()[$todo_type];?>
    </span>
</h3>
<div class="alert alert-<?=\App\Models\Todo::getTypeMapper()[$todo_type];?>" role="alert">
    @foreach($todos as $todo)
        @if ($todo->todo_type != $todo_type)
            @continue
        @endif
        <div class="input-group">
            <span class="input-group-addon">
                <input type="checkbox" @if($todo->is_close == true) checked @endif disabled>
            </span>
            <input type="text" class="form-control" value="{{ $todo->created_at }} | {{ $todo->bodytext }}" disabled>
            @if(auth()->user()->id == 1)
                <div class="input-group-btn">
{{--                     <button type="button" class="btn btn-default" aria-label="Help"><span --}}
{{--                             class="glyphicon glyphicon-question-sign"></span></button> --}}
                    <a href="{{ route('admin.todo.edit', $todo->id) }}" class="btn btn-default">Изменить</a>
                </div>
            @endif
        </div><!-- /input-group -->
    @endforeach
</div>
