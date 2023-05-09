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
mix.styles([
    'resources/vendor/css/adminlte.min.css',
    'resources/vendor/css/all.min.css',
    'resources/vendor/css/config.css',
    //Plugins
    'resources/vendor/js/plugins/toastr/toastr.min.css'
    ], 'public/css/plantilla.css')
    .js('resources/js/app.js', 'public/js')
    .scripts([
    'resources/vendor/js/adminlte.min.js',
    //Plugins
    'resources/vendor/js/plugins/toastr/toastr.min.js'
    ], 'public/js/plantilla.js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .copy('resources/vendor/fontawesome/webfonts', 'public/webfonts')
    .copy('resources/vendor/js/jquery.min.js', 'public/js/jquery.min.js')
    .copy('resources/vendor/img', 'public/img')
    .copy('resources/vendor/js/bootstrap.bundle.min.js', 'public/js/bootstrap.bundle.min.js');
