@extends('layouts.default')

@section('LayoutSectionPageTitle', 'Барахолка')
@section('LayoutSectionPageHeader', 'Барахолка')
@section('LayoutSectionPageBreadcrumb', Breadcrumbs::render('site.note'))

@section('LayoutSectionPageContent')
    <h3 align="center">Здесь можно оставить заметки - возможно они попадут в ветки!</h3>
    <form action="" method="post">
        @csrf
        <center>
            <textarea id="tinymce" name="bodytext" style="
            width: 50%;
            height: 100px;
            border: gray 3px solid;
             border-radius: 10px;"
            ></textarea>
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
            <br/>
            <input type="submit" value="Добавить">
        </center>
    </form>
    <br/>
    <br/>
    @foreach($rows->items() as $row)
        <div style="margin: 0 auto; width: 50%; padding: 15px; background: #dcdc7e;">
            #{{ $row->id }}.
            {!! $row->bodytext !!}
            @if($row->is_me === 1)
                [Me!]
            @endif
        </div>
        <hr/>
    @endforeach
    {{ $rows->links() }}
    Всего записей: {{ $rows->total() }}
@stop
