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
                <select class="form-control" name="parent_id">
                    <option value="">Без родителя</option>
                    @foreach($postsList as $postItem)
                        <option
                            value="{{ $postItem->id }}" {{ (collect(old('parent_id', $post->parent_id))->contains($postItem->id)) ? 'selected':'' }}>
                            [{{ $postItem->id }}]
                            {{ $postItem->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control" name="description"
                          rows="15">{{ old('description', $post->description) }}</textarea>
            </div>
            <div class="col-sm-5">
                <textarea type="text" class="form-control" name="description_tinymce"
                          rows="15">{{ old('description_tinymce', $post->description_tinymce) }}</textarea>
            </div>
        </div>

{{--        <tr>--}}
{{--            <td>Изображение (логотип поста)</td>--}}
{{--            <td>--}}
{{--                @if($model->logo_image)--}}
{{--                    <img src="{{ url($model->logo_image) }}" width="100"> <br/>--}}
{{--                @endif--}}
{{--                <input type="file" name="logo_image">--}}
{{--            </td>--}}
{{--        </tr>--}}
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
                    <input class="form-check-input" type="checkbox" name="branch_stop_flag" value="1"
                        {{ old('is_page_flag', $post->branch_stop_flag) == 1 ? 'checked' : '' }}>
                    Продолжить ветку на отдельной странице?
                </label>
                <br/>
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="is_page_flag" value="1"
                        {{ old('is_page_flag', $post->is_page_flag) == 1 ? 'checked' : '' }}>
                    Создать отдельную страницу?
                </label>
                <br/>
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="is_draft_flag" value="1"
                        {{ old('is_page_flag', $post->is_draft_flag) == 1 ? 'checked' : '' }}>
                    Черновик?
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
@endsection
