@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Редактировать')
@section('LayoutSectionPageHeader', 'Редактировать')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('admin.post.edit'))

@section('LayoutSectionPageContent')
    <form action="{{ route('admin.post.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="id" disabled value="{{ $post->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Название</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ old('name', $post->name) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Сортировка</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="sorting" value="{{ old('sorting', $post->sorting) }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Родитель</label>
            <div class="col-sm-10">
                @include('admin.post.partials.html-select-parent-id',['default'=>$post->parent_id])
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control" name="description" id="tinymce"
                          rows="15">{{ old('description', $post->description) }}</textarea>
            </div>
            <div class="col-sm-3">
                <textarea type="text" class="form-control" disabled
                          rows="15">{{ $post->description_tinymce }}</textarea>
            </div>
            <div class="col-sm-2">
                <b>Изображение (иконка или логотип поста) для ветки</b>
                @if($post->logo_image)
                    <img src="{{ asset('uploads/site/post/logo/'.$post->logo_image) }}"
                         class="img-thumbnail">
                    <br/>
                    <label class="form-check-label">
                        <input class="form-check-input" type="hidden" name="logo_image_delete" value="0">
                        <input class="form-check-input" type="checkbox" name="logo_image_delete" value="1"
                            {{ old('branch_stop_flag', $post->branch_stop_flag) == 1 ? 'checked' : '' }}>
                        Удалить изображение?
                    </label>
                @endif
                <br/>
                <div class="form-group">
                    <input type="file" class="form-control" name="logo_image">
                </div>
            </div>
        </div>

        {{--        <tr>--}}
        {{--            <td>Изображения</td>--}}
        {{--            <td>--}}
        {{--                @foreach($images as $image)--}}
        {{--                    <img src="{{ url('images/posts/'.$model->id.'/'.$image->getFilename()) }}" width="100">--}}
        {{--                    <br/>--}}
        {{--                @endforeach--}}
        {{--                <input type="file" name="images[]">--}}
        {{--            </td>--}}
        {{--        </tr>--}}

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Дополнительные настройки</label>
            <div class="col-sm-10">
                <label class="form-check-label">
                    <input class="form-check-input" type="hidden" name="branch_stop_flag" value="0">
                    <input class="form-check-input" type="checkbox" name="branch_stop_flag" value="1"
                        {{ old('branch_stop_flag', $post->branch_stop_flag) == 1 ? 'checked' : '' }}>
                    Продолжить ветку на отдельной странице?
                </label>
            </div>
        </div>
        <button type="submit" name="redirect" class="btn btn-primary" value="none">Сохранить</button>
        <button type="submit" name="redirect" class="btn btn-primary" value="show">Сохранить и к просмотру</button>
    </form>
@endsection
