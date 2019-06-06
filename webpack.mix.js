let mix = require('laravel-mix');

mix.setPublicPath('dist')
    .js('resources/js/tool.js', 'js')
    .js('resources/js/template-field/template-field.js', 'js')
    .js('resources/js/parent-field/parent-field.js', 'js')
    .js('resources/js/region-field/region-field.js', 'js')
    .sass('resources/sass/tool.scss', 'css');
