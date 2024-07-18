<template>
	<div style="line-height: 45px;color: #FFF;">
		<div class="account-head-right">
			<a-space>
				<!-- <span>{{ useUserStore().userInfo.name }}</span> -->
<!-- 				<a-dropdown>
					<a-avatar :size="32" shape="square">
						<img :src="useUserStore().userInfo.avatar">
					</a-avatar>
				    <template #content>
				        <a-doption>个人资料</a-doption>
				        <a-doption @click="logout">退出登录</a-doption>
				    </template>
				</a-dropdown> -->

				<div class="logoutButton">
					<a-popconfirm content="您确定要退出当前登录状态吗?" position="lb" @ok="logout">
						<a-button type="primary" status="warning">
					      	<template #icon>
					        	<icon-export />
					      	</template>
							退出登录
						</a-button>
					</a-popconfirm>
				</div>


			</a-space>
		</div>

		<div style="float:left;color: #fff;">
			<div style="padding: 5px 5px 5px 20px;">
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24"><path fill="currentColor" d="M21 11c0 5.55-3.84 10.74-9 12c-5.16-1.26-9-6.45-9-12V5l9-4l9 4zm-9 10c3.75-1 7-5.46 7-9.78V6.3l-7-3.12z"/></svg>
			</div>
		</div>
	</div>
</template>


<script setup>
import { ref } from 'vue'
import { Grid, Bell, InfoFilled } from '@element-plus/icons-vue';
import { useUserStore } from '@/store/user';

const logout = ()=>{
	location.href = '/logout';
}
</script>

<style scoped>
.account-head-right{
	float: right;
}

.site-switch-btn{
	width: 45px;
	text-align: center;
	cursor: pointer;
}
.site-switch-btn:hover{
	background-color: #005792;
}

.logoutButton{
/*	width: 150px;*/
/*	height: 45px;*/
/*    color: #FFF;*/
    text-align: center;
/*    border-bottom: 1px solid #ccc;*/
/*    border-left: 1px solid #532323;*/
	cursor: pointer;
	padding-right: 15px;
}
/*.logoutButton:hover{
	background: #548fcd;
}*/
</style>