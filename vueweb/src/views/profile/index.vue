<template>
    <a-card title="个人资料" :style="{'min-height':'500px' }">
        <template #extra>
            <a-space>
                <a-button type="dashed" html-type="submit" @click="openEdit" v-if="disabled==true">编辑</a-button>
            </a-space>
        </template>


        <a-form :model="profileForm" :style="{ width: '500px' }" size="large" @submit="updateProfileHandle">
            <a-form-item field="name" label="昵称" :disabled="disabled||submitIng">
                <a-input v-model="profileForm.name" placeholder="please enter your post..."/>
                <!-- <span v-else>{{profileForm.name}}</span> -->
            </a-form-item>
            <a-form-item field="email" label="邮箱" :disabled="disabled||submitIng">
                <a-input v-model="profileForm.email" placeholder="please enter your post..."/>
                <!-- <span v-else>{{profileForm.email}}</span> -->
            </a-form-item>
            <a-form-item>
                <a-space>
                    <a-button type="primary" html-type="submit" :loading="submitIng" v-if="disabled==false&&!submitMessgae.show">提交编辑</a-button>
                    <a-button type="primary" status="success" v-if="submitMessgae.show">
                        <template #icon>
                            <icon-check />
                        </template>
                        {{ submitMessgae.content }}
                    </a-button>
                </a-space>
            </a-form-item>
        </a-form>

    </a-card>
</template>

<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';
import { useRoute, useRouter } from "vue-router";
import { Notification } from '@arco-design/web-vue';
import { useUserStore } from '@/store/user';
import request from '@/utils/request';

const router = useRouter();
const route = useRoute();

const showPage = ref(false);
const disabled = ref(true);
const submitIng = ref(false);

const Message = ref(false);
const submitMessgae = reactive({
    show: false,
    type: 'success',
    content: '',
});

const profileForm = reactive({
    name: '',
    email: '',
})

const openEdit = ()=>{
    router.push({name:'profile.edit'});
    disabled.value = false
}
const closeEdit = ()=>{
    router.push({name:'profile'});
   disabled.value = true;
}

const updateProfileHandle = ()=>{
    submitIng.value = true;
    request.put('/api/profile', profileForm).then(function (response) {

        // 显示成功提示
        submitMessgae.show = true;
        submitMessgae.content = response.data.message;
        useUserStore().loadProfile();

        // 关闭成功提示
        setTimeout(function(){
            submitIng.value = false;
            submitMessgae.show = false;
            submitMessgae.content = '';
            closeEdit();
        }, 1500)


    }).catch(function (error) {
        submitIng.value = false;
        Notification.error('操作失败');
    });
}

onMounted(async() => {
    if( route.name == 'profile.edit' ){
        openEdit();
    }
    
    profileForm.name = useUserStore().userInfo.name;
    profileForm.email = useUserStore().userInfo.email;
    await useUserStore().loadProfile();
    profileForm.name = useUserStore().userInfo.name;
    profileForm.email = useUserStore().userInfo.email;
    showPage.value = true;
});

</script>