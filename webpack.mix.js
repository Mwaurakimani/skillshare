const mix = require('laravel-mix');

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

mix.browserSync('127.0.0.1:8000')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/App/user', 'public/js/App/user.js')
    .js('resources/js/App/contractorCard.js', 'public/js/App/contractorCard.js')
    .js('resources/js/App/projects.js', 'public/js/App/projects.js')
    .js('resources/js/res/live.js', 'public/js/res/live.js')
    .sass('resources/scss/app.scss', 'public/css/Assets/app.css')
    .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
