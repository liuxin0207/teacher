import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import AutoImport from 'unplugin-auto-import/vite';
import Components from 'unplugin-vue-components/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        Components({
          dirs: ['resources/js/Components'],
        }),
        AutoImport({
          imports: ['vue'],
          dirs: ['resources/js/Store/**'],
          vueTemplate: true,
          eslintrc: {
            enabled: true,
          },
        }),
    ],
    resolve: {
      alias: {
        // 預設 @ 設置為/resources/js路徑，來引入組件
        // 將 /images 設置為/resources/images路徑，來獲取圖片路徑
        '/css': '/resources/css',
        '/images': '/resources/images',
        'ziggy': '/vendor/tightenco/ziggy/src/js',
      },
    },
});
