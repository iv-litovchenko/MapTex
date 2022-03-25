@extends('layouts.default')

@section('LayoutSectionPageContent')

    @if($errors->any())
        @foreach($erros->all() as $error)
            ...dww
        @endforeach
    @endif

    <form method="post" enctype="multipart/form-data">
        @csrf
        <center><a href="{{ route('tech', ['id'=>$model->id]) }}">Вернуться к элементу</a></center>
        <table width="80%" align="center" border="1">
            <tr>
                <td width="30%">Имя:</td>
                <td><input name="name" style="width: 100%" value="{{ $model->name }}"></td>
            </tr>
            <tr>
                <td width="30%">Сотрировка:</td>
                <td><input name="sorting" style="width: 100%" value="{{ $model->sorting }}"></td>
            </tr>
            <tr>
                <td>Описание:</td>
                <td>
                    <textarea name="description"
                              style="width: 100%; height: 500px;">{{ $model->description }}</textarea>
                    <textarea id="tinymce" name="description_tinymce"
                              style="width: 100%; height: 500px;">{{ $model->description_tinymce }}</textarea>
                    <script>
                        tinymce.init({
                            selector: '#tinymce',
                            menubar: false,
                            plugins: ' lists advlist table link code',
                            toolbar1: 'undo redo | styleselect backcolor forecolor |' +
                                ' bold italic strikethrough underline | ' +
                                'aligncenter alignjustify alignleft alignright | removeformat',
                            toolbar2: 'outdent outdent bullist numlist  | ' +
                                'quicktable quicklink | table | ' +
                                'tableprops tablerowprops tablecellprops | ' +
                                'tableinsertrowbefore tableinsertrowafter | ' +
                                'tableinsertcolbefore tableinsertcolafter | link codesample code ',
                            height: 350
                        });
                    </script>
                </td>
            </tr>
            <tr>
                <td>Продолжить ветку на отдельной странице?</td>
                <td><input type="checkbox" name="branch_stop_flag" value="1"
                        {{ $model->branch_stop_flag == 1 ? 'checked=checked' : '' }}></td>
            </tr>
            <tr>
                <td>Создать отдельную страницу?</td>
                <td><input type="checkbox" name="is_page_flag" value="1"
                        {{ $model->is_page_flag == 1 ? 'checked=checked' : '' }}></td>
            </tr>
            <tr>
                <td>Черновик?</td>
                <td><input type="checkbox" name="is_draft_flag" value="1"
                        {{ $model->is_draft_flag == 1 ? 'checked=checked' : '' }}></td>
            </tr>
            <tr>
                <td>Изображение (логотип технологии)</td>
                <td>
                    @if($model->logo_image)
                        <img src="{{ url($model->logo_image) }}" width="100"> <br/>
                    @endif
                    <input type="file" name="logo_image">
                </td>
            </tr>
            <tr>
                <td>Изображения</td>
                <td>
                    @foreach($images as $image)
                        <img src="{{ url('images/posts/'.$model->id.'/'.$image->getFilename()) }}" width="100">
                        <br/>
                    @endforeach
                    <input type="file" name="images[]">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit">
                </td>
            </tr>
        </table>
    </form>

@endsection

