var elixir = require('laravel-elixir')

require('laravel-elixir-vueify')

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .sass('app.scss')
        .styles('materialize.clockpicker.css', 'public/css/materialize.clockpicker.main.css')
        .browserify('app.js', 'public/js/app.main.js')
        .version([
            'public/css/app.css',
            'public/css/materialize.clockpicker.main.css',
            'public/js/app.main.js',
            'public/js/materialize.clockpicker.main.js'
        ])
})
