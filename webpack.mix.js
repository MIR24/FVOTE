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

mix.webpackConfig({
        plugins: [
            new webpack.IgnorePlugin(/^codemirror$/)
        ]
    })
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'node_modules/js-cookie/src/js.cookie.js',
        'node_modules/smooth-scroll/dist/js/jquery/smooth-scroll.min.js',
        'node_modules/moment/min/moment.min.js',
        'node_modules/wnumb/wNumb.js',
        'node_modules/zenscroll/zenscroll.js',
        'node_modules/tooltip.js/dist/umd/tooltip.min.js',
        'node_modules/jquery-form/dist/jquery.form.min.js',
        'node_modules/tether/dist/css/tether.css',
        'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.js',
        'node_modules/block-ui/jquery.blockUI.js',
        'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'node_modules/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js',
        'node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
        'resources/src/js/framework/components/plugins/forms/bootstrap-timepicker.init.js',
        'node_modules/bootstrap-daterangepicker/daterangepicker.js',
        'resources/src/js/framework/components/plugins/forms/bootstrap-daterangepicker.init.js',
        'node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js',
        'node_modules/bootstrap-maxlength/src/bootstrap-maxlength.js',
        'node_modules/bootstrap-switch/dist/js/bootstrap-switch.js',
        'resources/src/js/framework/components/plugins/forms/bootstrap-switch.init.js',
        'resources/src/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js',
        'node_modules/bootstrap-select/dist/js/bootstrap-select.js',
        'node_modules/select2/dist/js/select2.full.js',
        'node_modules/typeahead.js/dist/typeahead.bundle.js',
        'node_modules/handlebars/dist/handlebars.js',
        'node_modules/inputmask/dist/jquery.inputmask.bundle.js',
        'node_modules/inputmask/dist/inputmask/inputmask.date.extensions.js',
        'node_modules/inputmask/dist/inputmask/inputmask.numeric.extensions.js',
        'node_modules/inputmask/dist/inputmask/inputmask.phone.extensions.js',
        'node_modules/nouislider/distribute/nouislider.js',
        'node_modules/owl.carousel/dist/owl.carousel.js',
        'node_modules/autosize/dist/autosize.js',
        'node_modules/clipboard/dist/clipboard.min.js',
        'node_modules/ion-rangeslider/js/ion.rangeSlider.js',
        'node_modules/dropzone/dist/dropzone.js',
        'node_modules/summernote/dist/summernote.js',
        'node_modules/markdown/lib/markdown.js',
        'node_modules/bootstrap-markdown/js/bootstrap-markdown.js',
        'resources/src/js/framework/components/plugins/forms/bootstrap-markdown.init.js',
        'node_modules/jquery-validation/dist/jquery.validate.js',
        'node_modules/jquery-validation/dist/additional-methods.js',
        'resources/src/js/framework/components/plugins/forms/jquery-validation.init.js',
        'node_modules}/bootstrap-notify/bootstrap-notify.min.js',
        'resources/src/js/framework/components/plugins/base/bootstrap-notify.init.js',
        'node_modules/toastr/build/toastr.min.js',
        'node_modules/jstree/dist/jstree.js',
        'node_modules/raphael/raphael.js',
        'node_modules/morris.js/morris.js',
        'node_modules/chartist/dist/chartist.js',
        'node_modules}/chart.js/dist/Chart.bundle.js',
        'resources/src/js/framework/components/plugins/charts/chart.init.js',
        'resources/src/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js',
        'resources/src/vendors/jquery-idletimer/idle-timer.min.js',
        'node_modules/waypoints/lib/jquery.waypoints.js',
        'node_modules/counterup/jquery.counterup.js',
        'node_modules/es6-promise-polyfill/promise.min.js',
        'node_modules/sweetalert2/dist/sweetalert2.min.js',
        'resources/src/js/framework/components/plugins/base/sweetalert2.init.js',
        'resources/src/js/framework/base/util.js',
        'resources/src/js/framework/base/app.js',
        'resources/src/js/framework/components/general/datatable/datatable.js',
        'resources/src/js/framework/**/*.js',
        'resources/src/js/demo/default/base/**/*.js',
        'resources/src/js/app/base/**/*.js',
        'resources/src/js/snippets/base/**/*.js',
        'resources/src/js/demo/default/custom/**/*.js'
    ], 'public/js/all.js')
    .styles([
        'node_modules/sweetalert2/dist/sweetalert2.min.css',
        'resources/src/vendors/metronic/css/styles.css',
        'resources/src/vendors/flaticon/css/flaticon.css',
        'resources/src/vendors/line-awesome/css/line-awesome.css',
        'node_modules/font-awesome/css/font-awesome.css',
        'node_modules/socicon/css/socicon.css',
        'node_modules/chartist/dist/chartist.min.css',
        'node_modules/morris.js/morris.css',
        'node_modules/jstree/dist/themes/default/style.css',
        'node_modules/toastr/build/toastr.css',
        'node_modules/animate.css/animate.min.css',
        'node_modules/bootstrap-markdown/css/bootstrap-markdown.min.css',
        'node_modules/summernote/dist/summernote.css',
        'node_modules/dropzone/dist/dropzone.css',
        'node_modules/ion-rangeslider/css/ion.rangeSlider.skinFlat.css',
        'node_modules/ion-rangeslider/css/ion.rangeSlider.css',
        'node_modules/owl.carousel/dist/assets/owl.theme.default.css',
        'node_modules/owl.carousel/dist/assets/owl.carousel.css',
        'node_modules/nouislider/distribute/nouislider.css',
        'node_modules/select2/dist/css/select2.css',
        'node_modules/bootstrap-select/dist/css/bootstrap-select.css',
        'node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css',
        'node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css',
        'node_modules/bootstrap-daterangepicker/daterangepicker.css',
        'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
        'node_modules/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css',
        'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css',
        'node_modules/tether/dist/css/tether.css',
        'node_modules/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css',
        'resources/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css'
    ], 'public/css/all.css')
    .sass('resources/src/sass/demo/default/style.scss', 'public/css')
    .copyDirectory([
        'node_modules/font-awesome/fonts',
        'node_modules/summernote/dist/font',
        'node_modules/socicon/font',
        'resources/src/vendors/line-awesome/fonts',
        'resources/src/vendors/flaticon/fonts',
        'resources/src/vendors/metronic/fonts',
    ], 'public/fonts')
    .copy([
        'node_modules/malihu-custom-scrollbar-plugin/mCSB_buttons.png',
        'node_modules/ion-rangeslider/img/sprite-skin-flat.png',
        'resources/src/vendors/jstree/32px.png',
        'node_modules/jstree/dist/themes/default/40px.png',
        'node_modules/jstree/dist/themes/default/*.gif',
        'resources/src/media/demo/default/**/*.*',
    ], 'public/storage/img')
    .sourceMaps()
    .version();