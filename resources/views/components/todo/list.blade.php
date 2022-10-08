<h3>
    @if(auth()->user() && auth()->user()->id == 1)
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
                <input type="checkbox" @if($todo->is_close == true) checked @endif>
            </span>
            <input type="text" class="form-control" value="{{ $todo->bodytext }}">
			        @if($todo->pics)
						<div class="input-group-btn">
                        @foreach(explode(chr(10),$todo->pics) as $image)
                            <a type="button" class="btn btn-default" href="{{ asset('storage/'.$image) }}"><span class="glyphicon glyphicon-picture"></span></a>
                        @endforeach
						</div>
                    @endif
            <div class="input-group-btn">
                @if(auth()->user() && auth()->user()->id == 1)
                    <div class="btn btn-default">@money($todo->what_does_it_cost)</div>
                    <div class="btn btn-default">{{ $todo->created_at }}</div>
                    <a href="{{ route('admin.todo.edit', $todo->id) }}" class="btn btn-default">Изменить</a>
                    <button type="button" class="btn btn-default" aria-label="Help"><span class="glyphicon glyphicon-question-sign"></span></button>
                @endif
            </div>
        </div><!-- /input-group -->
    @endforeach
</div>
