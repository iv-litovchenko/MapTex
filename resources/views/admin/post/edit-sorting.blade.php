@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Изменить сортировку дочерних элементов')
@section('LayoutSectionPageHeader', 'Изменить сортировку дочерних элементов')
@section('LayoutSectionPageBreadcrumb', null)

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.post.update-sorting', $post->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="id" disabled value="{{ $post->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" disabled value="{{ $post->name }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Дочерние элементы</label>
            <div class="col-sm-10">
                <div class="row">
                    @foreach($posts as $postItem)
                        <div class="col-sm-6 col-form-label" style="text-align: right;">
                                {{ $postItem->name }}
                        </div>
                        <div class="col-sm-6 form-group">
                            <input class="form-control" name="sort_list[{{ $postItem->id  }}]"
                                   value="{{ $postItem->sorting }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit" name="redirect" class="btn btn-primary" value="none">Сохранить</button>
    </form>
@endsection
