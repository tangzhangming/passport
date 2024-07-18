<template>

    <a-card title="登录" :style="{'width':'500px' }" class="login-card">
        <a-form :model="loginForm">
            <a-form-item field="name" label="昵称">
                <a-input v-model="loginForm.name" placeholder="please enter your post..."/>
            </a-form-item>
            <a-form-item field="password" label="邮箱">
                <a-input v-model="loginForm.password" placeholder="please enter your post..."/>
            </a-form-item>
            <a-form-item>
                <a-space>
                    <a-button type="primary" html-type="submit">登录</a-button>
                </a-space>
            </a-form-item>
        </a-form>
    </a-card>

</template>


<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';
import { useRoute, useRouter } from "vue-router";

const router = useRouter();

const loginFormDisabled = ref(false);

const loginForm = reactive({
    email: 'tangzhangming@live.com',
    password: '12345678',
})

const loginFormErrors = reactive({
    email: '',
    password: '',
})

const loginHandle = () => {
    return router.push({ name: 'dashboard' });
}

// 设置页面背景颜色
onMounted(() => {
    document.querySelector("body").setAttribute("style", "background-color: #666666");
    // document.querySelector("body").setAttribute("style", "background-color: hsl(0, 0%, 90%)");
});
// 页面销毁时清空背景色
onBeforeUnmount(() => {
    document.querySelector("body").removeAttribute("style")
})
</script>

<style scoped>
.login-card{
    max-width: 450px;
    min-height: 250px;
    margin: 0 auto;
    margin-top: 180px;
}
.login-button{
    margin-top: 5px;
    width:100%;
}
</style>