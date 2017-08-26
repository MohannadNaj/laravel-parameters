let mix = require('laravel-mix');
var BrowserSyncPlugin = require('browser-sync-webpack-plugin');

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
/*
mix.js('./resources/assets/js/app.js', 'js')
.sass('./resources/assets/sass/app.scss', 'css');

mix.copy('node_modules/tinymce/skins', 'public/css/libs/tinymce/skins');
mix.copy('node_modules/tinymce/themes', 'public/css/libs/tinymce/themes');

mix.copy('node_modules/tinymce/plugins/emoticons/img', 'public/js/plugins/emoticons/img');
mix.copy('node_modules/tinymce/plugins/codesample/css', 'public/js/plugins/codesample/css');
mix.copy('node_modules/tinymce/plugins/visualblocks/css', 'public/js/plugins/visualblocks/css');
*/
mix.setResourceRoot('/vendor/parameters/');

require('./phpunit-watcher');
