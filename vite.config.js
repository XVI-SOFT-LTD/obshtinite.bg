import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import copy from 'rollup-plugin-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        copy({
            targets: [
                /* Admnistration */
                // css
                { src: 'node_modules/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css', dest: 'public/build/css' },
                { src: 'node_modules/gentelella/vendors/font-awesome/css/font-awesome.min.css', dest: 'public/build/css' },
                { src: 'node_modules/gentelella/vendors/nprogress/nprogress.css', dest: 'public/build/css' },
                { src: 'node_modules/gentelella/vendors/switchery/dist/switchery.min.css', dest: 'public/build/css', rename: 'switchery.css' },
                { src: 'node_modules/gentelella/vendors/iCheck/skins/flat/green.css', dest: 'public/build/css', rename: 'icheck.css' },
                { src: 'node_modules/gentelella/build/css/custom.min.css', dest: 'public/build/css', rename: 'gentelella.css' },
                { src: 'node_modules/gentelella/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css', dest: 'public/build/css', rename: 'datetimepicker.css' },
                { src: 'node_modules/gentelella/vendors/dropzone/dist/min/dropzone.min.css', dest: 'public/build/css', rename: 'dropzone.css' },
                { src: 'node_modules/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css', dest: 'public/build/css', rename: 'dataTables.bootstrap.min.css' },
                { src: 'node_modules/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css', dest: 'public/build/css', rename: 'dataTables.buttons.bootstrap.min.css' },
                { src: 'node_modules/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css', dest: 'public/build/css', rename: 'dataTables.fixedheader.bootstrap.min.css' },
                { src: 'node_modules/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css', dest: 'public/build/css', rename: 'dataTables.responsive.bootstrap.min.css' },
                { src: 'node_modules/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css', dest: 'public/build/css', rename: 'dataTables.scroller.bootstrap.min.css' },                

                // js
                { src: 'node_modules/gentelella/vendors/jquery/dist/js/jquery.min.js', dest: 'public/build/js' },
                { src: 'node_modules/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js', dest: 'public/build/js' },
                { src: 'node_modules/gentelella/vendors/fastclick/lib/fastclick.js', dest: 'public/build/js' },
                { src: 'node_modules/gentelella/vendors/nprogress/nprogress.js', dest: 'public/build/js' },
                { src: 'node_modules/gentelella/vendors/switchery/dist/switchery.min.js', dest: 'public/build/js', rename: 'switchery.js' },
                { src: 'node_modules/gentelella/vendors/iCheck/icheck.min.js', dest: 'public/build/js', rename: 'icheck.js' },
                { src: 'node_modules/gentelella/build/js/custom.min.js', dest: 'public/build/js', rename: 'gentelella.js' },
                { src: 'node_modules/nestable/jquery.nestable.js', dest: 'public/build/js', rename: 'nestable.min.js' },
                { src: 'node_modules/gentelella/vendors/dropzone/dist/min/dropzone.min.js', dest: 'public/build/js', rename: 'dropzone.js' },
                
                // { src: 'node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js', dest: 'public/build/js', rename: 'ckeditor.js' },
                { src: 'node_modules/tinymce/**/*', dest: 'public/build/js/tinymce' },
                { src: 'node_modules/gentelella/vendors/moment/min/moment.min.js', dest: 'public/build/js/', rename: 'moment.min.js' },
                { src: 'node_modules/gentelella/vendors/moment/locale/bg.js', dest: 'public/build/js/', rename: 'moment.bg.js' },
                { src: 'node_modules/gentelella/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', dest: 'public/build/js/', rename: 'datetimepicker.js' },
                { src: 'node_modules/gentelella/vendors/jquery.tagsinput/src/jquery.tagsinput.js', dest: 'public/build/js/', rename: 'tagsinput.js' },

                // datatable-dynamics
                { src: 'node_modules/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js', dest: 'public/build/js/', rename: 'datatables.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js', dest: 'public/build/js/', rename: 'datatables.bootstrap.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js', dest: 'public/build/js/', rename: 'datatables.buttons.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js', dest: 'public/build/js/', rename: 'buttons.bootstrap.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js', dest: 'public/build/js/', rename: 'datatables.fixedheader.min.js' },
                { src: 'node_modules/gentelella/vendors/pdfmake/build/pdfmake.min.js', dest: 'public/build/js/', rename: 'pdfmake.min.js' },
                { src: 'node_modules/gentelella/vendors/pdfmake/build/vfs_fonts.js', dest: 'public/build/js/', rename: 'vfs_fonts.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js', dest: 'public/build/js/', rename: 'buttons.html5.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js', dest: 'public/build/js/', rename: 'buttons.print.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js', dest: 'public/build/js/', rename: 'buttons.flash.min.js' },
                { src: 'node_modules/gentelella/vendors/jszip/dist/jszip.min.js', dest: 'public/build/js/', rename: 'jszip.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js', dest: 'public/build/js/', rename: 'dataTables.keyTable.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js', dest: 'public/build/js/', rename: 'dataTables.responsive.min.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js', dest: 'public/build/js/', rename: 'responsive.bootstrap.js' },
                { src: 'node_modules/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js', dest: 'public/build/js/', rename: 'dataTables.scroller.min.js' },
                
                // images
                /* { src: 'node_modules/gentelella/build/images/*', dest: 'public/images' },
                { src: 'node_modules/gentelella/production/images/*', dest: 'public/images' }, */
                
                // fonts
                { src: 'node_modules/gentelella/vendors/font-awesome/fonts/*', dest: 'public/fonts' },
                { src: 'node_modules/gentelella/documentation/fonts/*', dest: 'public/fonts' },                           
            ],
            hook: 'writeBundle' // Copy after the bundle is written
        }),
    ],
});
