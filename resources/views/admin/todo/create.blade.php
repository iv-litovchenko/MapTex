@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Добавить')
@section('LayoutSectionPageHeader', 'Добавить')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.user.create'))

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.todo.store') }}" method="post">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Текст</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="bodytext" value="{{ old('bodytext') }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Тип</label>
            <div class="col-sm-10">
                <select class="form-control" name="todo_type">
                    @foreach(\App\Models\Todo::getTypeOptions() as $key => $name)
                        <option
                            value="{{ $key }}" {{ (collect(old('todo_type', $defaultTodoType))->contains($key)) ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
