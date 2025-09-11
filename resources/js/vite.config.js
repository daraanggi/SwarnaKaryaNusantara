// vite.config.js
export default defineConfig({
    plugins: [laravel({
        input: ['resources/css/app.css', 'resources/js/alamat.js'],
        refresh: true,
    })],
});