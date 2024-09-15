import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/pace-theme-default.css',
                'resources/css/pace-theme-loading-bar.css',
                'resources/js/pace.min.js'
            ],
            refresh: true,
        }),
    ],
});
