import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/css/bootstrap.min.css',
                'resources/assets/css/fontawesome.min.css',
                'resources/assets/css/brands.min.css',
                'resources/assets/css/regular.min.css',
                'resources/assets/css/solid.min.css',
                'resources/assets/css/app.css',
                'resources/assets/js/app.js',
                'resources/assets/js/bootstrap.bundle.min.js',
                'resources/assets/js/fontawesome.min.js',
                'resources/assets/js/brands.min.js',
                'resources/assets/js/regular.min.js',
                'resources/assets/js/solid.min.js',
            ],
            refresh: true,
        }),
    ],
});
