<template>
    <a-layout class="layout-main">
        <a-layout-header>
            <app-layout-headers/>
        </a-layout-header>
        <a-layout-content class="layout-content">
            <div style="max-width:960px;min-width:500px;margin: 0 auto;">
                <router-view v-slot="{ Component }">
                    <transition name="fade" mode="out-in">
                        <component :is="Component" />
                    </transition>
                </router-view>
            </div>
        </a-layout-content>
        <a-layout-footer>
            <div style="height:30px;line-height:30px;text-align:center;">
                <span>@ 账号中心 2024</span>
            </div>
        </a-layout-footer>
    </a-layout>
</template>


<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';
import { useRoute, useRouter } from "vue-router";
import { House, User, Key, Lock, Connection } from '@element-plus/icons-vue';
import AppLayoutHeaders from './app-header.vue';

const router = useRouter();
const route = useRoute();

const showContent = ref(true);
const activeMenu = ref('');

const switchRouteHandle = (name) => {
  activeMenu.value = name;
  return router.push({ name: name });
}

// 设置页面背景颜色
onMounted(() => {
    document.querySelector("body").setAttribute("style", "background-color:#f3f3f3");

    activeMenu.value = route.name;

});

// 页面销毁时清空背景色
onBeforeUnmount(() => {
    document.querySelector("body").removeAttribute("style")
})
</script>

<style scoped>
.layout-main{
    height: 100vh;
}
.layout-main :deep(.arco-layout-header)  {
    height: 45px;
    line-height: 45px;
    color: #FFF;
    background-color: #00204a;
    border-bottom: 1px solid #ccc;
}
.layout-content{
    background: rgb( 242,243,245 );
    border-left: 1px solid #ccc;
    padding: 10px;
}


.user-menus{
    margin-bottom: 20px;
}
.user-menu-item{
    padding: 18px 15px;
    cursor: pointer;/* 将光标设置为手形 */
}
.user-menu-item:hover, .user-menu-item.active{
    background-color: #eef2f5;
    border-left: 2px solid #409eff;
    color:#409eff;
    padding-left: 13px;
}


.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>