import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/bootstrap.min.css',
                'resources/css/fontawesome.min.css',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/bootstrap.bundle.min.js',
                'resources/js/fontawesome.min.js',
            ],
            refresh: true,
        }),
    ],
});
