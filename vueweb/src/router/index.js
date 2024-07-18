import { createRouter, createWebHistory } from 'vue-router'
import request from '@/utils/request'
import {ElMessage} from 'element-plus'
import { useUserStore } from '@/store/user';


import LayoutApp from '../layout/app.vue'

import HomeView from '../views/HomeView.vue'
import LogineView from '../views/guest/login.vue'
import LoginPopupView from '../views/guest/loginPopup.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/xlogin',
      name: 'login',
      component: LogineView
    },
    {
      path: '/xlogin/popup',
      name: 'login.popup',
      component: LoginPopupView
    },



    {
        path: '/',
        name: '',
        component: LayoutApp,
        children: [
            {
                path: '/',
                name: 'dashboard',
                component: HomeView,
                meta:{
                    title: '首页',
                }
            },
            {
                path: '/profile',
                name: 'profile',
                component: () => import('../views/profile/index.vue'),
                meta:{
                    title: '个人资料',
                }
            },
            {
                path: '/profile/edit',
                name: 'profile.edit',
                component: () => import('../views/profile/index.vue'),
                meta:{
                    title: '个人资料编辑',
                }
            },
            {
                path: '/socialite',
                name: 'social',
                component: () => import('../views/social/index.vue'),
                meta:{
                    title: '社交网站绑定',
                }
            },
        ]
    },


    {
        path: '/security',
        name: '',
        component: LayoutApp,
        children: [
            {
                path: 'password/update',
                name: 'password.update',
                component: () => import('../views/security/password.vue'),
                meta:{
                    title: '修改登录密码',
                }
            },
        ]
    },


  ]
})


let status = true;
let statusRes = {};
router.beforeEach(async(to, from, next) => {
    setPageTitle(to);
    
    // if(to.name == 'login'){
    //     next();
    // }

    if( status ){
        // const response = await getStatus();
        const response = await useUserStore().loadProfile();

        statusRes = response
        status = false;
    }



    if( statusRes.code == 0 ){
        // console.log('已登录')
        // 已登录
        if( to.name == 'login' ){
            // 已登录禁止访问登录页面
            ElMessage.success('您已经处于登录状态')
            next(`/?msg=已经登录`)

        }else{
            // 
            next();
        }


    }else{
        // 未登录 放行login页面 其他页面都跳转login
        if( to.name == 'login' || to.name == 'login.popup' ){
            next();

        }else{
            ElMessage.error('访问的页面需要登录.')
            // next(`/login.do?next=${to.path}`)
            // next({name:'login'})
            location.href = '/login'
        }
    }
})

async function getStatus(){
    try {
        // const response = await request.get('/sso/status');
        const response = await request.get('/api/profile');
        // 处理响应
        return response;
    } catch (error) {
        // 处理错误
        console.error(error);
        return error;
    }
}

function setPageTitle(route){
    if( route.name == 'login' ){
        document.title = '登录';
    }else{
        var title = (route.meta.title!==undefined) ? route.meta.title : route.name ;
        document.title = '战网账号中心 | ' + title;
    }
}

export default router
