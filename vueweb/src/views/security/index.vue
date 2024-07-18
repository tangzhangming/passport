<template>
    <a-card  title="安全设置">
        <template #extra>
            <a-link>More</a-link>
        </template>




        <a-list :bordered="false" >
            <a-list-item>
                <a-list-item-meta title="安全邮箱" description="tanzgahg***@live.com">
                    <template #avatar>
                        <a-avatar shape="square" :style="{ backgroundColor: '#3370ff' }">
                            <icon-email />
                        </a-avatar>
                    </template>
                </a-list-item-meta>
                <template #actions>
                    <a-button type="primary">修改</a-button>
                </template>
            </a-list-item>
            <a-list-item>
                <a-list-item-meta title="安全手机" description="18580251306">
                    <template #avatar>
                        <a-avatar shape="square" :style="{ backgroundColor: '#00d0b6' }">
                            <icon-phone />
                        </a-avatar>
                    </template>
                </a-list-item-meta>
                <template #actions>
                    <a-button type="primary">修改</a-button>
                </template>
            </a-list-item>
        </a-list>




    </a-card>
</template>

<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';
import { Lock, Message, Iphone } from '@element-plus/icons-vue';

const profileForm = reactive({
    email: 'tangzhangming@live.com',
    password: '12345678',
})

const loginHandle = ()=>{

}
</script>