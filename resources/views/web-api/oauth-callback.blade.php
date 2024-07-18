<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>绑定结果</title>
	<style>
	  body {
	    font-family: Arial, sans-serif;
	    background-color: #f7f7f7;
	    text-align: center;
	    padding: 50px;
	  }
	  .success-message {
	    color: #155724;
	    background-color: #d4edda;
	    border-color: #c3e6cb;
	    padding: 20px;
	    margin: 20px;
	    border-radius: 5px;
	    display: inline-block;
	    min-width:350px;
	  }
	  .success-icon {
	    font-size: 48px;
	    margin-bottom: 10px;
	  }
	  .close-btn {
	    background-color: #28a745;
	    color: white;
	    padding: 10px 20px;
	    border: none;
	    border-radius: 5px;
	    cursor: pointer;
	    text-decoration: none;
	    margin-top: 20px;
	  }
	</style>
</head>
<body>

<div class="success-message">
  	<span class="success-icon">&#10004;</span>
  	<h1>绑定成功!</h1>
  	<p>您的账号已经成功与 {{ isset($display_name) ? $display_name : '' }} 绑定</p>
  	<button class="close-btn" onclick="window.close()">手动关闭</button>
</div>

<script>
// 如果是通过window.open打开的当前页面，通知它消息并且自行关闭
function tellBabab() {
	if( window.opener == null ){
		// 部分情况(比如twitter回来)读取不到window.opener 原因不明
	    var toWindow = window;
	}else{
		var toWindow = window.opener;
	}

    toWindow.postMessage({
        message_type : 'provider_bind',
        provider_name : '{{ isset($provider_name) ? $provider_name : '' }}',
        display_name : '{{ isset($display_name) ? $display_name : '' }}',
        bind_status : true,
    }, '*');
    
    setTimeout(function(){
		window.close();
	}, 100);
}

window.onload = function() {
	tellBabab();
};
</script>
</body>
</html>