import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',     // file bawaan
                'resources/js/app.js',       // file JS bawaan
                'resources/css/admin.css',   
                'resources/css/login.css',   
                'resources/css/register.css',
                'resources/css/user.css',
                'resources/css/profile.css',    
            ],
            refresh: true,
        }),
    ],
});
