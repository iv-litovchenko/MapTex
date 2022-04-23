global.jquery = global.jQuery = global.$ = require('jquery/dist/jquery');
require('bootstrap/dist/js/bootstrap'); // Bootstrap
require('bootbox/dist/bootbox.min');
require('bootbox/dist/bootbox.locales.min');

const hljs = require('highlight.js/lib/common'); // Highlight.Js
const tinymce = require('tinymce/tinymce'); // TinyMCE

require('tinymce/icons/default');
require('tinymce/models/dom');
require('tinymce/themes/silver');
require('tinymce/plugins/advlist');
require('tinymce/plugins/autolink');
require('tinymce/plugins/lists');
require('tinymce/plugins/link');
require('tinymce/plugins/anchor');
require('tinymce/plugins/table');
require('tinymce/plugins/code');
require('tinymce/plugins/codesample');

$(document).ready(function () {

    // Визуальный редактор
    tinymce.baseURL = window.location.protocol + '//' + window.location.host;
    tinymce.init({
        selector: '#tinymce',
        menubar: false,
        height: 500,
        plugins: 'lists advlist table link code codesample',
        toolbar1: 'undo redo | formatselect fontselect fontsizeselect | ' +
        'styleselect backcolor forecolor removeformat codesample code | ' +
        'bold italic strikethrough underline | ' +
        'alignleft aligncenter alignjustify alignright',
        toolbar2: 'outdent outdent bullist numlist  | ' +
        'quicktable quicklink | table | link ',
        // 'tableprops tablerowprops tablecellprops | ' +
        // 'tableinsertrowbefore tableinsertrowafter | ' +
        // 'tableinsertcolbefore tableinsertcolafter ',
        codesample_languages: [
            {text: 'Plain', value: 'plaintext'},
            {text: 'HTML/XML', value: 'xml'},
            {text: 'JavaScript', value: 'javascript'},
            {text: 'CSS', value: 'css'},
            {text: 'PHP', value: 'php'},
            {text: 'SQL', value: 'sql'},
            {text: 'Markdown', value: 'markdown'},
            {text: 'Lua', value: 'lua'},
            {text: 'JSON', value: 'json'},
            {text: 'YAML', value: 'yaml'}
            // {text: 'UML', value: ''} ???
        ]
    });

    // Подсветка синтаксиса
    // html = hljs.highlight('<h1>Hello World!</h1>', {language: 'xml'}).value
    $("pre[class^='language']").each(function () {
        var content = $(this).text();
        var codeLanguage = $(this).attr('class');
        codeLanguage = codeLanguage.replace('language-', '');
        var hljsContent = hljs.highlight(content, {language: codeLanguage}).value;
        $(this).html(hljsContent);
        $(this).css('border', 'none');
        $(this).css('border-radius', 'none');
        // alert(codeLanguage + ' : ' + hljsContent);
    });

    // Подсветка текста в разделе поиск
    var qSearchValue = $('#qSearch').val();
    $('.backlightText').html(function () {
        return $(this).html().replace(new RegExp(qSearchValue + "(?=[^>]*<)", "ig"), "<span class='search-sot'>$&</span>");
    });

    // Подтвердить удаление (для изображений)?
    // function handleCommandConfirm(obj) {
    //     var checkbox = obj; // $(this);
    //     if (!checkbox.is(':checked')) {
    //         bootbox.confirm("Are you sure?", function (result) {
    //             if (result) {
    //                 // your code
    //             } else {
    //                 checkbox.prop('checked', true);
    //             }
    //         });
    //     }
    // }

});

