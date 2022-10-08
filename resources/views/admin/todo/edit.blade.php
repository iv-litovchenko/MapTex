@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Редактировать')
@section('LayoutSectionPageHeader', 'Редактировать')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.todo.edit'))

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.todo.update', $todo->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="id" disabled value="{{ $todo->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Тип</label>
            <div class="col-sm-5">
                <select class="form-control" name="todo_type">
                    @foreach(\App\Models\Todo::getTypeOptions() as $key => $name)
                        <option
                            value="{{ $key }}" {{ (collect(old('todo_type', $todo->todo_type))->contains($key)) ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                    <option disabled>Здоровье</option>
                    <option disabled>Семья</option>
                    <option disabled>И т.д. колесо баланса</option>
                </select>
            </div>
            <div class="col-sm-5">
                --
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Текст</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="bodytext" value="{{ $todo->bodytext }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Цена вопроса?</label>
            <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">RUB</span>
                    <input type="number" step="0.01" class="form-control" name="what_does_it_cost" value="{{ $todo->what_does_it_cost }}">
                    <span class="input-group-addon">коп</span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Исполнено?</label>
            <div class="col-sm-10">
                <label class="form-check-label">
                    <input class="form-check-input" type="hidden" disabled name="is_close" value="0">
                    <input class="form-check-input" type="checkbox" name="is_close" value="1"
                        {{ old('is_close', $todo->is_close == 1) ? 'checked' : '' }}>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Изображения</label>
            <div class="col-sm-10">
                @if($todo->pics)
                    <div class="row">
                        @foreach(explode(chr(10),$todo->pics) as $image)
                            <div class="col-sm-2" style="text-align: center;">
                                <label class="form-check-label">
                                    <img src="{{ asset('storage/'.$image) }}" class="img-thumbnail"
                                         style="height: 100px;">
                                    <br/>
                                    <input class="form-control" name="pics[name][{{ md5($image) }}]" disabled
                                           value="-- NAME --">
                                    <input class="form-control" name="pics[sorting][{{ md5($image) }}]" disabled
                                           value="{{ $loop->iteration }}">
                                    <input class="form-check-input handleCommandConfirm"
                                           type="checkbox"
                                           name="pics[delete][{{ md5($image) }}]"
                                           value="1"
                                    >
                                    Удалить изображение {{ $loop->iteration }}?
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
                <input type="file" class="form-control" name="pics[upload][]" multiple>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Дополнительные настройки</label>
            <div class="col-sm-10">
                <label class="form-check-label">
                    Подтвердить удаление файлов (изображений)?
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="files_delete_confirm" value="0" checked> Нет /
                    <input class="form-check-input" type="radio" name="files_delete_confirm" value="1"> Да
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
