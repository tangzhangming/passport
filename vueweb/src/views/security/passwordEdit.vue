<template>
    <el-card shadow="hover">
        <template #header>
            <div class="card-header">
                <span>修改密码</span>
            </div>
        </template>

        <el-form :model="profileForm" label-width="120px" label-position="top">
            <el-form-item label="账户">
                <el-input v-model="profileForm.email" placeholder="邮箱|手机号" />
            </el-form-item>
            <el-form-item label="密码">
                <el-input v-model="profileForm.password" />
            </el-form-item>
            <el-form-item label="">
                <el-button type="primary" @click="loginHandle">登录</el-button>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';

const profileForm = reactive({
    email: 'tangzhangming@live.com',
    password: '12345678',
})

const loginHandle = ()=>{

}
</script>