<template>

    <a-card>
        <a-page-header
            title="社交网站绑定"
            subtitle=""
            :style="{ background: 'var(--color-bg-2)', 'margin-bottom':'0px'  }"
            @back="onBack"
        >
        </a-page-header>


        <a-list :bordered="false" :loading="loading" :style="{padding:'25px'}">

            <a-list-item v-for="(connect, provider_name) in connects">

                <a-list-item-meta :title="connect.name" :description="connect.display_name">
                    <template #avatar>
                        <!-- 图标区域 -->

                        <a-avatar shape="square" :style="{ backgroundColor: '#EC1A23' }" v-if=" provider_name=='google' ">
                            <icon-google />
                        </a-avatar>

                        <a-avatar shape="square" :style="{ backgroundColor: '#232324' }" v-else-if=" provider_name=='github' ">
                            <icon-github />
                        </a-avatar>

                        <a-avatar shape="square" :style="{ backgroundColor: '#232324' }" v-else-if=" provider_name=='qq' ">
                            <icon-qq />
                        </a-avatar>

                        <a-avatar shape="square" :style="{ backgroundColor: '#00acee' }" v-else-if=" provider_name=='twitter' ">
                            <icon-twitter />
                        </a-avatar>

                        <a-avatar shape="square" :style="{ backgroundColor: '#04BE02' }" v-else-if=" provider_name=='weixin' ">
                            <icon-wechat />
                        </a-avatar>

                        <a-avatar shape="square" v-else>
                            {{ provider_name }}
                        </a-avatar>

                        <!-- 图标区域 END-->
                    </template>
                </a-list-item-meta>

                <template #actions v-if="connect.bind_status!=undefined">
                    <a-button type="outline" status="danger" v-if="connect.bind_status">解绑</a-button>
                    <a-button type="outline" status="success" @click="ProviderBindHandle(connect)" v-else>绑定</a-button>
                </template>

            </a-list-item>

        </a-list>
    </a-card>

</template>

<script setup>
import { ref, reactive, onMounted, onBeforeUnmount } from 'vue';
import { useRoute, useRouter } from "vue-router";
import { Notification } from '@arco-design/web-vue';
import { useUserStore } from '@/store/user';
import request from '@/utils/request';

const router = useRouter();

const loading = ref(true);
var connects = reactive({});


const onBack = (event)=>{
    return router.push({name:'dashboard'})
}

const ProviderBindHandle = (provider)=>{
    var iWidth = 600;                         //弹出窗口的宽度;
    var iHeight = 650;                        //弹出窗口的高度;
    var iTop = (window.screen.height-30-iHeight)/2;       //获得窗口的垂直位置;
    var iLeft = (window.screen.width-10-iWidth)/2;        //获得窗口的水平位置;
  
    // 打开oauth provider网站
    window.open(provider.bind_link,
        'newwindow',
        'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no'
    )
}

const onLoad = async(event)=>{
    loading.value = true;
    const response = await request.get('/oauth/connects');
    connects = response.data.data.connects;
    loading.value = false;
}

const onMessage = (event)=>{

    if (event.origin !== "https://passport.520.com") return;
    if( event.data.message_type == undefined ) return;

    if( event.data.message_type == 'provider_bind' ){
        var provider_name = event.data.provider_name
        var display_name = event.data.display_name
        onLoad();
        Notification.success({
            position: "topLeft",
            title: '绑定成功',
            content: provider_name + ':' + display_name,
        });
    }
}

onMounted(async() => {
    onLoad();
    window.addEventListener('message', onMessage);
});
onBeforeUnmount(() => {
    console.log("移除oauth绑定监听 ")
    window.removeEventListener('message', onMessage);
});
</script>