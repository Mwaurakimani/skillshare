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

mix.js('resources/js/app.js', 'public/js')
<<<<<<< HEAD
    .js('resources/js/App/user', 'public/js/App/user.js')
=======
>>>>>>> 4bd199ac2787eaadf46a1e77d0a8787a3f6148e2
    .js('resources/js/res/live.js', 'public/js/res/live.js')
    .sass('resources/scss/app.scss', 'public/css/Assets/app.css')
    .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
