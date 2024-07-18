<template>

    <a-card>
        <a-page-header
            :style="{ background: 'var(--color-bg-2)', 'margin-bottom':'0px'  }"
            title="修改登录密码"
            :subtitle="false"
            @back="onBack"
        >
        </a-page-header>

        <div style="width:450px;margin: 0 auto;margin-top:100px;margin-bottom:100px;">
            <a-form :model="passwordForm" layout="vertical" size="large" @submit="saveFormHandle">
                <a-form-item field="old_password" label="旧密码">
                    <a-input v-model="passwordForm.old_password" placeholder="旧密码"/>
                </a-form-item>
                <a-form-item field="password" label="新密码">
                    <a-input v-model="passwordForm.password" placeholder="新密码"/>
                </a-form-item>
                <a-form-item>
                    <a-space>
                        <a-button type="primary" html-type="submit">提交编辑</a-button>
                    </a-space>
                </a-form-item>
            </a-form>
        </div>

    </a-card>

</template>

<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';
import { useRoute, useRouter } from "vue-router";
import { Notification } from '@arco-design/web-vue';
import { useUserStore } from '@/store/user';
import request from '@/utils/request';

const router = useRouter();

const passwordForm = reactive({
    old_password: '',
    password: '',
})

const onBack = (event)=>{
    return router.push({name:'dashboard'})
}

const saveFormHandle = ()=>{

}


onMounted(async() => {

});
onBeforeUnmount(() => {

});
</script>