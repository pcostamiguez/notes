import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/pace-theme-flat-top.css',
                'resources/css/app.css',
                'resources/css/all.min.css',
                'resources/css/bootstrap.min.css',
                'resources/js/pace.min.js',
                'resources/js/app.js',
                'resources/js/all.min.js',
                'resources/js/bootstrap.bundle.min.js'
            ],
            refresh: true,
        }),
    ],
});
