import {defineConfig, UserConfigExport} from 'vite'
import vue from '@vitejs/plugin-vue'
import path from 'path'
import { ViteFaviconsPlugin } from 'vite-plugin-favicon'
import databaseGenerator from "./src/api/database/generator";

// https://vitejs.dev/config/
export default defineConfig(({ command}) => {
  const config: UserConfigExport = {
    plugins: [vue(), databaseGenerator()],
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
