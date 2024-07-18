<template>
    <div class="login-card">
        <div class="login-card-header">
            <div class="login-card-header-content">
                <!-- <el-button :icon="Close" circle @click="sendCloseMessage"/> -->
                <div style="width:32px;height:32px;float:right;line-height:32px;" @click="sendCloseMessage">
                    <el-icon class="el-icon--right"><Close /></el-icon>
                </div>
                

                <svg t="1720683392228" style="height:32px;width:32px" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1319" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200">
                    <path d="M519.4856 366.676h18.264v103.948h-18.264z" fill="#FFFFFF" opacity=".15" p-id="1320"></path>
                    <path d="M794.9176 366.676h21.076v103.948h-21.076z" fill="#6E6E96" opacity=".15" p-id="1321"></path>
                    <path d="M485.9336 37.752c2.708-1.92-122.144 215.224-378.288 181.932 1.32 1.068-22.7 115.12 8.068 266.792 31.76 150.24 118.296 338.1 363.62 453.712-2.372 0.4 134.288-49.212 248.812-172.056 116.568-121.244 210.996-315.736 171.256-568.256 4.104 3.08-285.36 69.54-413.468-162.124z" fill="#00CCC6" p-id="1322"></path>
                    <path d="M492.9856 102.984c125.28 214.484 394.992 132.084 417.976 122.2-1.568-22.548 0 0-3.352-23.592 4.256 3.068-285.74 71.7-414.312-167.88 2.8-1.92-121.54 223.252-378.276 190.616 0.008 0 1.28-15.88-0.988 27.256C389.8136 305.824 495.5416 100.416 492.9816 102.984z" fill="#B0EDC1" p-id="1323"></path>
                    <path d="M492.6096 26.468c3.116-1.808-133.688 224.876-392.232 190.32 1.4 1.088-22.956 120.44 8.372 278.924 32.336 157.012 120.356 353.156 369.8 473.884-2.652 0.572 143.54-51.54 262.588-180.324 121.44-127.04 215.74-330.76 164.536-593.068 4.284 3.004-283.784 71.752-413.064-169.736z m-14.08 870.38C78.5656 691.58 170.1616 263.92 163.7416 268.768c210.32 16.644 322.524-154.32 320.744-153.148 109.228 172.98 353.12 139.184 350.912 136.96 28.416 219.508-52.952 387.112-150.452 492.808-96 106.808-208.124 151.7-206.42 151.46z" fill="#00B3AD" p-id="1324"></path>
                    <path d="M463.1896 683.016c-7.8 0-15.348-4.144-21.26-11.652-31.376-40.116-68.48-76.8-110.292-109.068-16.492-12.696-22.584-36.56-13.848-54.312 6.444-13.24 20.72-21.804 36.344-21.804 5.696 0 11.14 1.16 16.168 3.44a649.98 649.98 0 0 1 62.628 32.292c4.012 2.336 8.892 3.576 14.08 3.576 7.856 0 15.32-2.792 20.48-7.66 57.352-54.536 125.24-99.26 201.76-132.904 6.44-2.864 13.856-4.384 21.416-4.384 15.008 0 28.912 5.948 36.296 15.52 5.236 6.752 7.24 15.148 5.624 23.62-1.976 10.356-9.072 19.816-19.464 25.968-96.272 57.152-175.072 134.344-227.868 223.22-5.372 9-13.408 14.148-22.064 14.148z" fill="#FFFFFF" p-id="1325"></path>
                    <path d="M690.6656 389.004c11.952 0 23.576 4.428 29.592 12.228 9.168 11.816 3.424 28.34-11.444 37.132-101.276 60.124-179.356 139.52-230.832 226.184-3.976 6.648-9.288 10.004-14.792 10.004-5.012 0-10.18-2.792-14.608-8.42-31.248-39.952-68.656-77.264-111.776-110.536-12.736-9.8-18.564-29.364-11.428-43.876 5.176-10.624 16.92-17.08 28.752-17.08 4.32 0 8.64 0.86 12.668 2.688 21.6 9.696 42.228 20.36 61.84 31.88 5.488 3.2 11.904 4.74 18.368 4.74 9.628 0 19.36-3.436 26.28-9.96 54.452-51.78 121.48-97.072 199.356-131.308 5.624-2.504 11.864-3.676 18.024-3.676m0-16.924c-8.732 0-17.344 1.772-24.892 5.128-77.348 34.008-146.056 79.272-204.144 134.504-3.504 3.304-8.988 5.308-14.62 5.308-3.7 0-7.104-0.84-9.856-2.44a656.976 656.976 0 0 0-63.424-32.7 47.16 47.16 0 0 0-19.6-4.168c-18.84 0-36.1 10.44-43.972 26.592-10.416 21.184-3.26 49.632 16.32 64.7 41.24 31.824 77.84 68.008 108.772 107.556 7.58 9.632 17.492 14.916 27.94 14.916 11.708 0 22.392-6.652 29.32-18.248 52.1-87.7 129.876-163.872 224.944-220.312 12.464-7.372 21.02-18.916 23.448-31.648 2.072-10.892-0.504-21.692-7.264-30.412-9.056-11.744-25.132-18.776-42.972-18.776z" fill="#FFFFFF" p-id="1326"></path>
                </svg>
            </div>
        </div>
        <div class="login-card-content">
            <template v-if="isGuest==true">
                <el-form :model="loginForm" label-width="120px" label-position="top" :disabled="loginFormDisabled">
                    <el-form-item label="账户" :error="loginFormErrors.email">
                        <el-input v-model="loginForm.email" placeholder="邮箱|手机号" />
                    </el-form-item>
                    <el-form-item label="密码" :error="loginFormErrors.password">
                        <el-input v-model="loginForm.password" />
                    </el-form-item>
                    <el-form-item label="">
                        <el-button type="primary login-button" @click="loginHandle">登录</el-button>
                    </el-form-item>
                </el-form>
                <el-divider>第三方登录</el-divider>

                <el-space wrap class="bird-buttons">
                    <el-button>QQ</el-button>
                    <el-button>微信</el-button>
                    <el-button>Google</el-button>
                </el-space>
            </template>
            <template v-else>
                <div style="text-align: center;">
                    <el-avatar shape="square" :size="100" :src="guserinfo.avatar"  />
                </div>

                <el-input v-model="guserinfo.email" placeholder="邮箱" disabled/>
            </template>
        </div>
    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, reactive, ref } from 'vue';
import { Close } from '@element-plus/icons-vue';
import { ElMessage } from 'element-plus';
// import axios from 'axios';
import request from '@/utils/request'

const isGuest = ref(true);
const guserinfo = reactive({
    email: 'tangzhangming@live.com',
    avatar: 'https://passport.520.com/storage/images/zmEpnRw5dPWAweeqoOkEDvCymKBLVMEiMx0COAn5.jpg',
})



const loginFormDisabled = ref(false);

const loginForm = reactive({
    email: 'tangzhangming@live.com',
    password: '12345678',
})

const loginFormErrors = reactive({
    email: '',
    password: '',
})


// const axiosInstance = axios.create({
//   withCredentials: true, // 允许跨域请求携带cookie
// });

// 关闭这个iframe页面
const sendCloseMessage = () => {
    console.log("关闭这个页面");
    return window.parent.postMessage('closeLoginPage', '*');
};


// 登录成功后的操作
const loginSuccessHandle = () => {
    window.parent.postMessage('loginSuccess', '*');
}


// function setCrossDomain(logoutList){
const setCrossDomain = (logoutList) =>{
    var down = 0;
    var target = 0;
    var time=(new Date()).getTime();
    // var callback=document.getElementById("callback").value;
    function onload(){
      down++;
    }
    for(var i = 0,img; i < logoutList.length ; i++){ 
      img = new Image();
      img.onload = img.onerror = img.oncomplete = onload
      try{
        // img.src = protocol+"://"+logoutList[i] ;
        img.src = logoutList[i] ;
        target++;
      }catch(e){
      }
    }
    function check(){
      if(down>=target){
          loginSuccessHandle();

      }else{
        if((new Date()).getTime()-time > 10000){
          loginSuccessHandle();

        }else{
          setTimeout(check, 200);
        }
      }
    }
    check();
}


const loginHandle = () => {
    loginFormDisabled.value = true;

    request.post('/sso/login', loginForm).then(function (response) {
        loginFormDisabled.value = false;

        // 登录失败
        if( response.data.code!=0 && response.data.code!=200 ){
            var showMessage = false;
            var errors = response.data.errors;
            for(var field in errors){
                if( loginFormErrors[field] != undefined ){
                    loginFormErrors[field] = errors[field][0];
                }else{
                    showMessage = true;
                }
            }
            if( showMessage ){
                ElMessage({message:response.data.message, type: 'warning'})
            }
            return;
        }

        // 登录成功之处理
        console.log(response.data.data.endpoint)
        setCrossDomain(response.data.data.endpoint);

    }).catch(function (error) {
        console.log(error);
        ElMessage.error('服务器发生错误');
    });
};




// 设置页面背景颜色
onMounted(() => {
    document.querySelector("body").setAttribute("style", "background-color: #ccc");

    request.get('/sso/status').then(function (response) {
        isGuest.value = response.data.guest;
        if( response.data.guest == false ){
            console.log("已经登录");
            window.parent.postMessage('loginSuccess', '*');
        }

    }).catch(function (error) {
        console.log(error);
    });
});
// 页面销毁时清空背景色
onBeforeUnmount(() => {
    document.querySelector("body").removeAttribute("style")
})
</script>

<style scoped>
.login-card{
    background-color: #FFF;
    width: 350px;
    min-height: 450px;
    position: relative;
    margin: auto;
    
}
.login-card-header{
    width:100%;
    height: 40px;
    border-bottom: 1px solid #f1ecec;
}
.login-card-header .login-card-header-content{
    padding: 4px;
}
.login-card-header .el-button {
    float: right;
}
.login-card-content{
    padding: 10px;
}



.login-button{
    width:100%;
    margin-top:10px
}

.bird-buttons .el-button{
    width: 100%;
}
</style>
