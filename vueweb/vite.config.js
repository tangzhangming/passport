import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
    // 打包配置
    base: '/',
    build: {
        outDir: './../public',
    },
    plugins: [
      vue(),
    ],
    resolve: {
      alias: {
        '@': fileURLToPath(new URL('./src', import.meta.url))
      }
    },
    // 后端代理配置
    server: {
        host: '0.0.0.0',
        port: 5173,
        open: false,
        proxy: {
            "/passport": {
                target: "https://passport.520.com",
                changeOrigin: true,
                rewrite: (path) => path.replace(/^\/passport/, "/")
            }
        }
    },
})
