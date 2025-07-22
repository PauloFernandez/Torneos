import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Importante para que sea accesible desde fuera del contenedor
        port: 5173,      // Puerto que estamos exponiendo en Docker
        strictPort: true,
        hmr: {
            host: 'localhost', // Laravel está accediendo desde localhost
            protocol: 'ws',
        },
    },
});