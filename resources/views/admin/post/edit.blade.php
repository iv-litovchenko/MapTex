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
            <label class="col-sm-2 col-form-label">Имя/статус/тип</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="{{ old('name', $post->name) }}">
            </div>
            <div class="col-sm-2">
                <select class="form-control" name="post_type">
                    @foreach($postTypes as $postTypeKey => $postTypeName)
                        <option @if($postTypeKey === 'page-figma') disabled @endif
                        value="{{ $postTypeKey }}"
                            {{ (collect(old('post_type', $post->post_type))->contains($postTypeKey)) ? 'selected' : '' }}
                        >
                            {{ $postTypeName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select class="form-control" name="study_status">
                    @foreach(\App\Models\Post::getStudyStatusOptions() as $key => $name)
                        <option
                            value="{{ $key }}" {{ (collect(old('study_status', $post->study_status))->contains($key)) ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Имя (краткое)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name_short"
                       value="{{ old('name_short', $post->name_short) }}">
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
            <div class="col-sm-7">
                @include('admin.post.partials.html-select-parent-id',['default'=>$post->parent_id, 'changeAllow'=>false])
            </div>
            <div class="col-sm-3">
                <a href="{{ route('admin.post.edit-parent', $post->id) }}" target="_blank"
                   class="btn btn-primary form-control">Сменить родителя</a>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Описание</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="maptex_content_link" disabled
                       value="https://raw.githubusercontent.com/iv-litovchenko/maptex_content/master/{{ old('maptex_content_link', $post->maptex_content_link) }}"
                       placeholder="https://raw.githubusercontent.com/iv-litovchenko/maptex_content/master/example.txt">
                <br />
                <textarea type="text" class="form-control" name="description" id="tinymce"
                          rows="15">{{ old('description', $post->description) }}</textarea>
            </div>
            <div class="col-sm-2">
                <b>Изображение (иконка)</b>
                @if($post->logo_image)
                    <label class="form-check-label">
                        <img src="{{ asset('storage/'.$post->logo_image) }}"
                             class="img-thumbnail">
                        <br/>
                        <input class="form-check-input handleCommandConfirm"
                               type="checkbox" name="logo_image[delete]" value="1"
                        >
                        Удалить изображение?
                    </label>
                @endif
                <br/>
                <div class="form-group">
                    <input type="file" class="form-control" name="logo_image[upload]">
                </div>
                <hr/>
                <b>Изображение зарисовки (figma)</b>
                @if($post->figma_image)
                    <label class="form-check-label">
                        <img src="{{ asset('storage/'.$post->figma_image) }}"
                             class="img-thumbnail">
                        <br/>
                        <input class="form-check-input handleCommandConfirm"
                               type="checkbox" name="figma_image[delete]" value="1"
                        >
                        Удалить изображение?
                    </label>
                @endif
                <br/>
                <div class="form-group">
                    <input type="file" class="form-control" name="figma_image[upload]">
                </div>
                <hr/>
                <b>Исходник зарисовки (figma)</b>
                @if($post->figma_file)
                    <label class="form-check-label">
                        <a href="{{ asset('storage/'.$post->figma_file) }}">= СКАЧАТЬ =</a>
                        <br/>
                        <input class="form-check-input handleCommandConfirm"
                               type="checkbox" name="figma_file[delete]" value="1"
                        >
                        Удалить файл?
                    </label>
                @endif
                <br/>
                <div class="form-group">
                    <input type="file" class="form-control" name="figma_file[upload]">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Изображения</label>
            <div class="col-sm-10">
                @if($post->post_images)
                    <div class="row">
                        @foreach(explode(chr(10),$post->post_images) as $image)
                            <div class="col-sm-2" style="text-align: center;">
                                <label class="form-check-label">
                                    <img src="{{ asset('storage/'.$image) }}" class="img-thumbnail"
                                         style="height: 100px;">
                                    <br/>
                                    <input class="form-control" name="post_images[name][{{ md5($image) }}]" disabled
                                           value="-- NAME --">
                                    <input class="form-control" name="post_images[sorting][{{ md5($image) }}]" disabled
                                           value="{{ $loop->iteration }}">
                                    <input class="form-check-input handleCommandConfirm"
                                           type="checkbox"
                                           name="post_images[delete][{{ md5($image) }}]"
                                           value="1"
                                    >
                                    Удалить изображение {{ $loop->iteration }}?
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endif
                <input type="file" class="form-control" name="post_images[upload][]" multiple>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Дополнительные настройки</label>
            <div class="col-sm-10">
                <label class="form-check-label">
                    <input class="form-check-input" type="hidden" disabled name="branch_stop_flag" value="0">
                    <input class="form-check-input" type="checkbox" disabled name="branch_stop_flag" value="1"
                        {{ old('branch_stop_flag', $post->branch_stop_flag) == 1 ? 'checked' : '' }}>
                    Продолжить ветку на отдельной странице?
                </label>
                <br/>
                <label class="form-check-label">
                    <input class="form-check-input" type="hidden" disabled name="is_protected" value="0">
                    <input class="form-check-input" type="checkbox" disabled name="is_protected" value="1"
                        {{ old('is_protected', $post->is_protected) == 1 ? 'checked' : '' }}>
                    Закрыть раздел для публичного доступа?
                </label>
                <br/>
                <label class="form-check-label">
                    Подтвердить удаление файлов (изображений)?
                </label>
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="files_delete_confirm" value="0" checked> Нет /
                    <input class="form-check-input" type="radio" name="files_delete_confirm" value="1"> Да
                </label>
            </div>
        </div>
        <button type="submit" name="redirect" class="btn btn-primary" value="none">Сохранить</button>
        <button type="submit" name="redirect" class="btn btn-primary" value="show">Сохранить и к просмотру</button>
    </form>

    <h2>История изменений записи</h2>
    @foreach($postHistoryChanges as $change)
        <div class="row">
            <div class="col-sm-2"><h3>Версия №{{ $loop->remaining }}</h3></div>
            <div class="col-sm-5"><h3>Перед</h3></div>
            <div class="col-sm-5"><h3>После</h3></div>
        </div>
        @foreach(json_decode($change->getAttribute('changes'),true) as $field => $value)
            <div class="row">
                <div class="col-sm-2">{{ $field }}</div>
                <div class="col-sm-5">{{ $value['before'] }}</div>
                <div class="col-sm-5">{{ $value['after'] }}</div>
            </div>
        @endforeach
        <hr/>
    @endforeach

@endsection
