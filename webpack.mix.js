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

mix.setPublicPath('./src/public/vendor/parameters/');

mix.js('./src/resources/assets/js/app.js', 'js');

mix.copy('node_modules/font-awesome/fonts/', './src/public/vendor/parameters/fonts/');

mix.copy('node_modules/tinymce/skins', './src/public/vendor/parameters/css/libs/tinymce/skins');
mix.copy('node_modules/tinymce/themes', './src/public/vendor/parameters/css/libs/tinymce/themes');

mix.copy('node_modules/tinymce/plugins/emoticons/img', './src/public/vendor/parameters/js/plugins/emoticons/img');
mix.copy('node_modules/tinymce/plugins/codesample/css', './src/public/vendor/parameters/js/plugins/codesample/css');
mix.copy('node_modules/tinymce/plugins/visualblocks/css', './src/public/vendor/parameters/js/plugins/visualblocks/css');

mix.sass('./src/resources/assets/sass/app.scss', 'css');
