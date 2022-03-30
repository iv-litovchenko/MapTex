global.jquery = global.jQuery = global.$ = require('jquery/dist/jquery');
const Bootstrap = require('bootstrap/dist/js/bootstrap');
const TinyMCE = require('tinymce/tinymce');

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
hljs = require('highlight.js/lib/common'); // Highlight.Js

$(document).ready(function () {

    // Визуальный редактор
    tinymce.init({
        selector: '#tinymce',
        menubar: false,
        height: 350,
        plugins: 'lists advlist table link code codesample',
        toolbar1: 'undo redo | styleselect backcolor forecolor removeformat codesample code  |' +
            'bold italic strikethrough underline | ' +
            'alignleft aligncenter alignjustify alignright',
        toolbar2: 'outdent outdent bullist numlist  | ' +
            'quicktable quicklink | table | ',
        // 'tableprops tablerowprops tablecellprops | ' +
        // 'tableinsertrowbefore tableinsertrowafter | ' +
        // 'tableinsertcolbefore tableinsertcolafter | link ',
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
        $(this).css('border','none');
        $(this).css('border-radius','none');
        // alert(codeLanguage + ' : ' + hljsContent);
    });

});

