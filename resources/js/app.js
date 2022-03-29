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
require('tinymce/plugins/image');
require('tinymce/plugins/charmap');
require('tinymce/plugins/preview');
require('tinymce/plugins/anchor');
require('tinymce/plugins/searchreplace');
require('tinymce/plugins/visualblocks');
require('tinymce/plugins/code');
require('tinymce/plugins/fullscreen');
require('tinymce/plugins/insertdatetime');
require('tinymce/plugins/media');
require('tinymce/plugins/table');
require('tinymce/plugins/code');
require('tinymce/plugins/help');
require('tinymce/plugins/wordcount');

$(document).ready(function () {
    tinymce.init({
        selector: '#tinymce',
        menubar: false,
        plugins: 'lists advlist table link code',
        toolbar1: 'undo redo | styleselect backcolor forecolor removeformat |' +
            'bold italic strikethrough underline | ' +
            'alignleft aligncenter alignjustify alignright',
        toolbar2: 'outdent outdent bullist numlist  | ' +
            'quicktable quicklink | table | ',
        // 'tableprops tablerowprops tablecellprops | ' +
        // 'tableinsertrowbefore tableinsertrowafter | ' +
        // 'tableinsertcolbefore tableinsertcolafter | link codesample ',
        height: 350
    });
});
