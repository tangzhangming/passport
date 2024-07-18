<template>
	<div style="line-height: 45px;color: #FFF;">

		<!-- 右侧 -->
		<div class="account-head-right">
			<a-space>
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
		<!-- 右侧 END -->


		<!-- 左侧 -->
		<div style="float:left;color: #fff;">
			<a-dropdown class="abcd">
				<div class="site-switch-btn">
					<icon-down/> Apps
				</div>
				<template #content :style="{'padding':'10px'}">
					<div style="width:250px;height:500px;">
					    <a-doption>腾讯视频</a-doption>
					    <a-doption>腾讯音乐</a-doption>
					    <a-doption>QQ 阅读</a-doption>
					</div>
				</template>
			</a-dropdown>
		</div>
		<!-- 左侧 END -->


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
	margin-right: 5px;
}
.site-switch-btn{
	width: 80px;
	height: 44px;
	text-align: center;
	cursor: pointer;
}
.site-switch-btn:hover{
	background-color: #005792;
}
.site-switch-btn.arco-dropdown-open{
	background-color: #1d3343;
}
.arco-dropdown-open .arco-icon-down {
  transform: rotate(180deg);
}

</style>