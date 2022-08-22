import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.js', 'resources/js/vendor/webauthn/webauthn.js'],
            refresh: true,
        }),
    ],
});
