<template>
    <a-modal v-model:visible="visible" @ok="handleOk" @cancel="close">
  	    <template #title>
  	    	  个人资料编辑
  	    </template>

        <a-form :model="form">
            <a-form-item field="user_id" label="ID" disabled>
                <a-input v-model="form.user_id" />
            </a-form-item>
            <a-form-item field="email" label="邮箱">
                <a-input v-model="form.email" />
            </a-form-item>
            <a-form-item field="name" label="昵称">
                <a-input v-model="form.name" />
            </a-form-item>
            <a-form-item field="gender" label="性别">
                <a-radio-group v-model="form.gender" :options="genderOptions" />
            </a-form-item>
            <a-form-item field="birthday" label="生日">
                <a-date-picker v-model="form.birthday"/>
            </a-form-item>
        </a-form>
    </a-modal>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useRoute, useRouter } from "vue-router";
import { Notification } from '@arco-design/web-vue';
import { useUserStore } from '@/store/user';
import request from '@/utils/request';

const router = useRouter();
const route = useRoute();
const visible = ref(false);

const genderOptions = [
    { label: '男', value: 'M' },
    { label: '女', value: 'F' },
];

const form = reactive({
    user_id: useUserStore().userInfo.user_id + '',
    name: useUserStore().userInfo.name,
    email: useUserStore().userInfo.email,
    gender: 'M', // 性别 M代表男性，F代表女性
    birthday: '1995-06-01', // 生日
});

const open = ()=>{
    router.push({ name: 'profile.edit' });
	visible.value = true;
}
const close = ()=>{
    router.push({ name: 'dashboard' });
	visible.value = false;
}
const handleOk = ()=>{
    request.put('/profile', form).then(function (response) {
        Notification.success('编辑成功');
        useUserStore().loadProfile();

    }).catch(function (error) {
        Notification.error('服务器发生错误');
        console.log(error);
    });
}


defineExpose({
	open,
});

onMounted(() => {
    if( route.name=='profile.edit' ){
        visible.value = true;
    }else{
        visible.value = false;
    }
});
</script>


<style scoped>
.arco-upload-list-item{
  width: 480px;
}
.custom-upload-avatar{
    width: 250px;
    height: 250px;  
    margin: 0 auto;
}
.custom-upload-avatar .upload-avatar-icon{
    line-height: 250px;
}
</style>