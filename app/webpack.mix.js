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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/scss/app.scss', 'public/css')
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'], // jQueryをglobalで利用可能にする
        bootstrap: ['bootstrap']
    })
    .version(); // キャッシュ対策