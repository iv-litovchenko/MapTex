const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js').vue().version(); // div id="app"
mix.css('resources/css/app.css', 'public/css').version();
// mix.sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/tinymce/skins', 'public/skins');
mix.copy('resources/assets', 'public/assets');
