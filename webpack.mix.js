let mix = require('laravel-mix');
let webpack = require('webpack');

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

mix.sass('resources/assets/sass/demo/default/style.scss', 'public/css')
    /*.webpackConfig({
        plugins: [
            new webpack.IgnorePlugin(/^codemirror$/)
        ]
    })*/
    .js([
        'resources/assets/js/framework/base/util.js',
        'resources/assets/js/framework/base/app.js',
        'resources/assets/js/framework/components/general/datatable/datatable.js',
        'resources/assets/js/framework/components/general/datatable/datatable.checkbox.js',
        'resources/assets/js/framework/components/general/dropdown.js',
        'resources/assets/js/framework/components/general/header.js',
        'resources/assets/js/framework/components/general/menu.js',
        'resources/assets/js/framework/components/general/offcanvas.js',
        'resources/assets/js/framework/components/general/portlet.js',
        'resources/assets/js/framework/components/general/quicksearch.js',
        'resources/assets/js/framework/components/general/scroll-top.js',
        'resources/assets/js/framework/components/general/toggle.js',
        'resources/assets/js/framework/components/general/wizard.js',
        'resources/assets/js/framework/components/plugins/base/bootstrap-notify.init.js',
        'resources/assets/js/framework/components/plugins/base/sweetalert2.init.js',
        'resources/assets/js/framework/components/plugins/charts/chart.init.js',
        'resources/assets/js/framework/components/plugins/forms/bootstrap-daterangepicker.init.js',
        'resources/assets/js/framework/components/plugins/forms/bootstrap-markdown.init.js',
        'resources/assets/js/framework/components/plugins/forms/bootstrap-switch.init.js',
        'resources/assets/js/framework/components/plugins/forms/bootstrap-timepicker.init.js',
        'resources/assets/js/framework/components/plugins/forms/jquery-validation.init.js',
        'resources/assets/js/demo/default/base/layout.js',
        'resources/assets/js/app/base/main.js',
        'resources/assets/js/snippets/base/quick-sidebar.js',
        'resources/assets/js/demo/default/custom/components/base/blockui.js',
        'resources/assets/js/demo/default/custom/components/base/bootstrap-notify.js',
        'resources/assets/js/demo/default/custom/components/base/dropdown.js',
        'resources/assets/js/demo/default/custom/components/base/scrollable.js',
        'resources/assets/js/demo/default/custom/components/base/sweetalert2.js',
        'resources/assets/js/demo/default/custom/components/base/treeview.js',
        'resources/assets/js/demo/default/custom/components/datatables/api/events.js',
        'resources/assets/js/demo/default/custom/components/datatables/api/methods.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/column-rendering.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/column-width.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/data-ajax.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/data-json.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/data-local.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/html-table.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/local-sort.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/record-selection.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/responsive-columns.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/row-details.js',
        'resources/assets/js/demo/default/custom/components/datatables/base/translation.js',
        'resources/assets/js/demo/default/custom/components/datatables/child/data-ajax.js',
        'resources/assets/js/demo/default/custom/components/datatables/child/data-local.js',
        'resources/assets/js/demo/default/custom/components/datatables/locked/both.js',
        'resources/assets/js/demo/default/custom/components/datatables/locked/html-table.js',
        'resources/assets/js/demo/default/custom/components/datatables/locked/right.js',
        'resources/assets/js/demo/default/custom/components/datatables/scrolling/both.js',
        'resources/assets/js/demo/default/custom/components/datatables/scrolling/horizontal.js',
        'resources/assets/js/demo/default/custom/components/datatables/scrolling/vertical.js'
    ], 'public/js')
    mix.styles([
        'resources/assets/vendors/flaticon/css/flaticon.css',
    ], 'public/css/all.css')
    .copyDirectory([
        'resources/assets/vendors/flaticon/fonts',
    ], 'public/fonts')
    .copyDirectory([
        'resources/assets/media/demo/default',
    ], 'public/storage')
    .sourceMaps()
    .version();
