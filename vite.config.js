import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import react from '@vitejs/plugin-react';
// import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel([
            'resources/css/app.css',
            'resources/css/treejs.css',
            'resources/css/treejs-custom.css',
            'resources/css/leaflet.css',
            'resources/js/app.js',
            'resources/js/jstree.js',            
            'resources/js/filters-menu.js',
            'resources/js/leaflet-src.js'
        ]),
    ],
    server: { 
        hmr: {
            host: 'localhost',
        },
    }
});