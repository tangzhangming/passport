<style type="text/css">
	body{
		margin: 0px;
		padding: 0px;
		background: #ccc;
	}
	.login-card{
		background-color: #FFF;
		width: 350px;
		min-height: 450px;
		position: relative;
		margin: auto;
	}
</style>
<div class="login-card">
	<div style="text-align: center;padding-top: 180px;">
		<img src="/static/images/loading_b.gif">
	</div>
</div>
<script type="text/javascript">
// sso已经处于登录状态 sso client打开登录iframe本页面，直接js通知站点登录成功
// 关闭登录框
function closeMe(){
	window.parent.postMessage('closeLoginPage', '*');
}

// 登录成功后的操作
function callback() {
	window.parent.postMessage('loginSuccess', '*');
}

window.onload = function() {
	setTimeout(function(){
		callback();
	}, 500)
};
</script>