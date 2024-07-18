import { ref, computed } from 'vue'
import { defineStore } from 'pinia';
import request from '@/utils/request'

export const useUserStore = defineStore('user', {
    // 状态
    state: () => ({
        userInfo: {
            id: 0,
            name: '',
            email: '',
            email_verified_at: '',
            avatar: '',
            created_at: '',
            updated_at: '',
        },
    }),
    // 派生状态
    getters: {
        isUserLoggedIn: (state) => !!state.userInfo,
    },
    // 动作
    actions: {
        async loadProfile() {
            try {

                const response = await request.get('/profile');
                this.userInfo = response.data.data;

                return response.data;

            } catch (error) {
                // 处理错误
                console.error(error);
                return error;
            }
        },
        async login(payload) {
            // 登录逻辑
            return new Promise(function(resolve, reject) {
                createToken(payload).then(response => {
                    if( response.code === 0 ){
                        setToken(response.data.token);
                        resolve(response);
                    }else{
                        reject(response.errors);
                    }
                })
            });
        },
        logout() {
            // 注销逻辑
            this.userInfo = null;
        },
    },
});