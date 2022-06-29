/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Визуальный редактор
tinymce.baseURL = window.location.protocol + '//' + window.location.host;
tinymce.init({
    selector: '#tinymce',
    menubar: true,
    height: 500,
    plugins: 'lists advlist table link code codesample',
    toolbar1: 'undo redo | removeformat | formatselect fontselect fontsizeselect |' +
    'styleselect backcolor forecolor |' +
    'bold italic strikethrough underline |' +
    'alignleft aligncenter alignjustify alignright',
    toolbar2: 'outdent outdent bullist numlist |' +
    'quicktable quicklink | table | link codesample code',
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
        {text: 'YAML', value: 'yaml'},
        {text: 'C/C++', value: 'c'},
        // {text: 'UML', value: ''} ???
    ]
});