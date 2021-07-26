
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/res/live.js', 'public/js/res/live.js')
    .sass('resources/scss/app.scss', 'public/css/Assets/app.css')
    .postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
