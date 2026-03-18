import { resolve } from 'node:path'
import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'
import { wayfinder } from '@laravel/vite-plugin-wayfinder'
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'
import VueDevTools from 'vite-plugin-vue-devtools'

export default defineConfig({
  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources/ts'),
    },
  },
  plugins: [
    VueDevTools({
      appendTo: 'resources/ts/app.ts',
    }),
    laravel({
      input: ['resources/ts/app.ts'],
      refresh: true,
    }),
    tailwindcss(),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    wayfinder({
      path: 'resources/ts',
      command: 'php artisan wayfinder:generate --path=resources/ts',
      formVariants: true,
    }),
    VueI18nPlugin({
      runtimeOnly: true,
      compositionOnly: true,
      include: [resolve(__dirname, 'resources/ts/locales/**')],
    }),
  ],
})
