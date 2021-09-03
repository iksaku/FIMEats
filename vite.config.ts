import {defineConfig, UserConfigExport} from 'vite'
import Vue from '@vitejs/plugin-vue'
import path from 'path'
import Pages from 'vite-plugin-pages'
import ViteFaviconsPlugin from 'vite-plugin-favicon'
import DatabaseGenerator from "./src/api/database/generator";

export default defineConfig(({ command}) => {
  const config: UserConfigExport = {
    plugins: [
      Vue(),
      Pages(),
      DatabaseGenerator(),
    ],
    resolve: {
      alias: {
        '@': path.resolve(__dirname, './src'),
      },
    }
  }

  if (command === 'build') {
    config.plugins!.push(ViteFaviconsPlugin('src/assets/logo.svg'))
  }

  return config
})
