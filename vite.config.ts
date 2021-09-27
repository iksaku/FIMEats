import { defineConfig } from 'vite'
import Vue from '@vitejs/plugin-vue'
import path from 'path'
import Pages from 'vite-plugin-pages'
import ViteSvgLoader from 'vite-svg-loader'
import DatabaseGenerator from './src/api/database/generator'

export default defineConfig(({ command }) => ({
  plugins: [Vue(), Pages(), ViteSvgLoader(), DatabaseGenerator()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
    },
  },
}))
