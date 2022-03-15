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

//  Per disattivare le notifiche di Laravel mix
mix.options({notification: false});

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/vue.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
