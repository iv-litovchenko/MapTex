@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Изменить документ')
@section('LayoutSectionPageHeader', 'Изменить документ')
@section('LayoutSectionPageBreadcrumb', null)

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.doc.update', $doc->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="bodytext" value="{{ $doc->bodytext }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Категория</label>
            <div class="col-sm-10">
                <select class="form-control" name="category">
                    @foreach(\App\Models\Doc::getCategories() as $key => $name)
                        <option
                                value="{{ $key }}"
                                {{ (collect(old('category', $doc->category))->contains($key)) ? 'selected' : '' }}
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" name="redirect" class="btn btn-primary" value="none">Сохранить</button>
    </form>
@endsection
