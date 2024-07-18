<template>
    <a-modal v-model:visible="visible" @ok="handleOk" @cancel="close" :width="500" :height="420" :footer="false">
	    <template #title>
	    	修改头像
	    </template>

    <a-upload
      action="https://passport.520.com/web-api/profile/picture"
      :fileList="file ? [file] : []"
      :show-file-list="false"
      :with-credentials="true"
      @change="onChange"
      @progress="onProgress"
      @success="onSuccess"
      @error="onError"
    >
      <template #upload-button>
        <div
          :class="`arco-upload-list-item${
            file && file.status === 'error' ? ' arco-upload-list-item-error' : ''
          }`"
        >

          <div
            class="arco-upload-list-picture custom-upload-avatar"
            v-if="file && file.url"
          >
            <img :src="file.url" :width="250" />
            <div class="arco-upload-list-picture-mask upload-avatar-icon">
              <IconEdit :size="20"/>
            </div>
            <a-progress
              v-if="file.status === 'uploading' && file.percent < 100"
              :percent="file.percent"
              type="circle"
              size="mini"
              :style="{
                position: 'absolute',
                left: '50%',
                top: '50%',
                transform: 'translateX(-50%) translateY(-50%)',
              }"
            />
          </div>

          <div class="arco-upload-picture-card" v-else>
            <div class="arco-upload-picture-card-text">
              <IconPlus />
              <div style="margin-top: 10px; font-weight: 600">Upload</div>
            </div>
          </div>
        </div>
      </template>
    </a-upload>

        <div style="height:82px">
            <a-alert type="error" v-if="message!=''">
                <template #title>
                    Error
                </template>
                {{message}}
            </a-alert>
        </div>

    </a-modal>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { Notification } from '@arco-design/web-vue';
import { useUserStore } from '@/store/user';

const visible = ref(false);
const message = ref('');

const file = ref({
  url: useUserStore().userInfo.avatar
});


const open = ()=>{
	visible.value = true;
}
const close = ()=>{
	visible.value = false;
}
const handleOk = ()=>{

}

const onChange = (_, currentFile) => {
  	file.value = {
    	...currentFile,
    	// url: URL.createObjectURL(currentFile.file),
  	};
};
const onProgress = (currentFile) => {
    message.value = '';
  	file.value = currentFile;
};

const onSuccess = (fileItem) => {
    var response = fileItem.response

    if( response.code === 0 ){
        Notification.success('头像修改成功')
        useUserStore().loadProfile();

    }else{
        message.value = response.message
        fileItem.url = useUserStore().userInfo.avatar;
        // Notification.error(response.message);
    }
};

const onError = (fileItem) => {
  console.log('errors')
  console.log(fileItem)
};

// error

defineExpose({
	open,
})
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