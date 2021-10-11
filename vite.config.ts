import { defineConfig } from 'vite'
import path from 'path'
import Vue from '@vitejs/plugin-vue'
import Pages from 'vite-plugin-pages'
import ViteSvgLoader from 'vite-svg-loader'
import DatabaseGenerator from './src/api/database/generator'

export default defineConfig(() => ({
  plugins: [Vue(), Pages(), ViteSvgLoader(), DatabaseGenerator()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './src'),
    },
  },
}))
