let mix = require('laravel-mix');

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
mix.setPublicPath('public');

mix.js('./src/resources/assets/js/app.js', 'js')
.sass('./src/resources/assets/sass/app.scss', 'css');

//mix.copy('node_modules/font-awesome/fonts/', 'public/fonts/');
//mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap/', 'public/fonts/');

mix.copy('node_modules/tinymce/skins', 'public/css/libs/tinymce/skins');
mix.copy('node_modules/tinymce/themes', 'public/css/libs/tinymce/themes');

mix.copy('node_modules/tinymce/plugins/emoticons/img', 'public/js/plugins/emoticons/img');
mix.copy('node_modules/tinymce/plugins/codesample/css', 'public/js/plugins/codesample/css');
mix.copy('node_modules/tinymce/plugins/visualblocks/css', 'public/js/plugins/visualblocks/css');

mix.setResourceRoot('/vendor/parameters/');
