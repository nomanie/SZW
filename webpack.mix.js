const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
    resolve: {
        alias: {
            ziggy: path.resolve('vendor/tighten/ziggy/dist/js/route.js'),
            '@js': path.resolve(__dirname, 'resources/js'),
            '@workshop': path.resolve(__dirname, 'resources/views/workshop/components')
        },
    },
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css/admin');
