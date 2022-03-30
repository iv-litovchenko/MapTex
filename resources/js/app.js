global.jquery = global.jQuery = global.$ = require('jquery/dist/jquery');
const Bootstrap = require('bootstrap/dist/js/bootstrap');
hljs = require('highlight.js/lib/common'); // Highlight.Js

$(document).ready(function () {

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

