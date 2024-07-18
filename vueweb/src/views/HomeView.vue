<template>

    <a-card>
        <a-page-header subtitle="" :show-back="false" :style="{ background: 'var(--color-bg-2)', 'margin-bottom':'30px' }">
            <template #title>
                <icon-idcard /> 战网账号中心
            </template>
        </a-page-header>


        <div style="margin: 25px;min-height: 200px;">
            <div style="float:right;">
                <a-avatar shape="square" :size="120" trigger-type="mask">
                    <img :src="useUserStore().userInfo.avatar">
                    <template #trigger-icon>
                        <IconEdit />
                    </template>
                </a-avatar>
            </div>
            <div style="float:left;">
                <a-descriptions :data="data" size="large" :column="2">
                    <template #title>
                        <icon-user /> 个人资料
                    </template>
                </a-descriptions>
            </div>
        </div>
        <div style="clear: both;height: 20px;"></div>


        <a-list :bordered="false" >
            <template #header>
                <icon-safe /> 安全设置
            </template>
            <a-list-item>
                <a-list-item-meta title="安全邮箱">
                    <template #avatar>
                        <a-avatar shape="square" :style="{ backgroundColor: '#3370ff' }">
                            <icon-email />
                        </a-avatar>
                    </template>
                    <template #description>
                        {{ useUserStore().userInfo.email }} <a-badge status="success" />
                    </template>
                </a-list-item-meta>
                <template #actions>
                    
                    <a-button>修改</a-button>
                </template>
            </a-list-item>
            <a-list-item>
                <a-list-item-meta title="安全手机">
                    <template #avatar>
                        <a-avatar shape="square" :style="{ backgroundColor: 'rgb(208 50 0)' }">
                            <icon-phone />
                        </a-avatar>
                    </template>
                    <template #description>
                        15523170804
                    </template>
                </a-list-item-meta>
                <template #actions>
                    <a-button type="primary">设置</a-button>
                </template>
            </a-list-item>
            <a-list-item>
                <a-list-item-meta title="登录密码" description="用于保护账号信息和登录安全">
                    <template #avatar>
                        <a-avatar shape="square" :style="{ backgroundColor: 'rgb(208 0 200)' }">
                            <icon-lock />
                        </a-avatar>
                    </template>
                </a-list-item-meta>
                <template #actions>
                    <a-button  @click="router.push({ name: 'password.update' })">修改</a-button>
                </template>
            </a-list-item>
            <a-list-item>
                <a-list-item-meta title="社交账号绑定" description="连接你的google、微信、Github账号，用于快速登录">
                    <template #avatar>
                        <a-avatar shape="square" :style="{ backgroundColor: '#232324' }">
                            <icon-github />
                        </a-avatar>
                    </template>
                </a-list-item-meta>
                <template #actions>
                    <a-button @click="router.push({ name: 'social' })">管理</a-button>
                </template>
            </a-list-item>
        </a-list>
    </a-card>

</template>

<script setup>
import { useRoute, useRouter } from "vue-router";
import { useUserStore } from '@/store/user';

const router = useRouter();

const logout = ()=>{
    location.href = '/logout';
}

const data = [{
    label: '昵称',
    value: useUserStore().userInfo.name,
    span: 2,
}, {
    label: '电子邮箱',
    value: useUserStore().userInfo.email,
    span: 1,
}, {
    label: '验证',
    value: useUserStore().userInfo.email_verified_at==null?'待验证':'已验证',
    span: 1,
}, {
    label: '注册时间',
    value: useUserStore().userInfo.created_at,
    span: 2,
}];
</script>