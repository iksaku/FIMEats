import { defineConfig } from 'vite'
import path from 'path'
import Vue from '@vitejs/plugin-vue'
import Pages from 'vite-plugin-pages'
import ViteSvgLoader from 'vite-svg-loader'
import { ViteFaviconsPlugin } from 'vite-plugin-favicon'
import DatabaseCompiler from './src/api/database/compiler'

export default defineConfig((env) => {
  const isProduction = env.mode === 'production'

  return {
    plugins: [
      Vue(),
      Pages(),
      ViteSvgLoader(),
      ViteFaviconsPlugin({
        logo: path.resolve(__dirname, './src/assets/logo.svg'),
        favicons: {
          icons: {
            android: isProduction,
            appleIcon: isProduction,
            appleStartup: isProduction,
            coast: isProduction,
            favicons: true,
            firefox: isProduction,
            windows: isProduction,
            yandex: isProduction,
          },
        },
      }),
      DatabaseCompiler(),
    ],
    resolve: {
      alias: {
        '@': path.resolve(__dirname, './src'),
      },
    },
  }
})
