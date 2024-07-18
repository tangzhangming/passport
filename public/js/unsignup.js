// 统一登录组件
// @author tangzhangming@live.com


/*
 * 这是登录弹窗的html部分
 */
let loginModalTpl = `
    <div>
        <div class="overlay" style="position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,0.5);z-index:1000;"></div>
        <div class="popup"  style="position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);padding:0px;border-radius:15px;z-index:1001;">
            <iframe src="https://passport.520.com/login/popup" frameborder="0" style="width:350px;min-height:450px;border:none;"></iframe>
        </div>
    </div>
`;


var Unlogin = (function(){

	var config = {
        onClose: null, // 登录框关闭时的回调
        onSuccess: null, // 登录成功后的回调
        onLogout: null, // 退出成功后的回调
	}



	function openPopup() {
	    if( document.getElementById('login-modal')!=null ){
	        alert("已经存在弹窗");
	        return;
	    }

	    // 追加登录modal到页面
	    var loginModalDIV = document.createElement('div');
	    loginModalDIV.id = 'login-modal';
	    loginModalDIV.innerHTML = loginModalTpl;
	    document.body.appendChild(loginModalDIV);

	    // 监听登录iframe事件
	    window.addEventListener('message', onMessage);
	}

	function closePopup(callEve) {
	    var modal = document.getElementById('login-modal');
	    if( modal != null ){
	        window.removeEventListener('message', onMessage);
	        modal.remove();
	        if ( callEve && (typeof config.onClose === 'function') ) {
	            config.onClose();
	        }
	    }
	}

	function onMessage(event){
	    if (event.origin !== 'https://passport.520.com') {
	        return;
	    }

	    // 关闭登录窗口
	    if( event.data == 'closeLoginPage' ){
	        return closePopup(true);
	    }


	    // 登录成功事件
	    if( event.data == 'loginSuccess' ){
	    	closePopup(false);
            if (typeof config.onSuccess === 'function') {
                config.onSuccess();
            }
	        return;
	    }
	}



	// 退出SSO
	function logoutSso() {
        if (typeof config.onLogout !== 'function') {
            return console.error("必须设置onLogout");
        }
        
		ajax({
			method: 'GET',
			url: 'https://passport.520.com/sso/logout',
			data: {},
			success: function(responseJson) {
			    var response = JSON.parse(responseJson);
			    console.log(response.endpoints)
			    setCrossDomain(response.endpoints, config.onLogout);
			},
			error: function(error) {
			    var response = JSON.parse(error);
			    console.error("退出时发生错误，响应内容:")
			    console.error(response);
			}
		});
	}

	// 封装原生post ajax
	function ajax(options) {
	    // 创建 XMLHttpRequest 对象
	    var xhr = new XMLHttpRequest();

	    // 设置请求方法和 URL
	    xhr.open(options.method, options.url);

	    // 设置请求头，如果是 POST 且发送 JSON 数据，设置 Content-Type 为 application/json
	    if (options.method === 'POST' && options.data instanceof Object) {
	        xhr.setRequestHeader('Content-Type', 'application/json');
	    }

	    // 设置 withCredentials 为 true 以支持携带 cookie
	    xhr.withCredentials = true;

	    // 发送请求
	    xhr.send(options.data ? JSON.stringify(options.data) : null);

	    // 处理响应
	    xhr.onreadystatechange = function () {
	        if (xhr.readyState === 4) {
	            if (xhr.status === 200) {
	                if (options.success) {
	                    options.success(xhr.responseText);
	                }
	            } else if (options.error) {
	                // 如果状态码不是 200，也认为是错误，调用错误回调
	                options.error(xhr.statusText, xhr.status);
	            }
	        }
	    };

	    // 处理网络错误
	    xhr.onerror = function () {
	        if (options.error) {
	            options.error(xhr.statusText);
	        }
	    };
	}

	// 写域名
	function setCrossDomain(logoutList, callback){
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
		      // location.href=callback;
		      callback();
		  }else{
		    if((new Date()).getTime()-time > 5000){
		      // location.href=callback;
		      callback();
		    }else{
		      setTimeout(check,200);
		    }
		  }
		}
		check();
	}



    // 公共API
    return {
        init: function (options) {
            // 初始化配置
            if (options.onClose) {
                config.onClose = options.onClose;
            }
            if (options.onSuccess) {
                config.onSuccess = options.onSuccess;
            }
            if (options.onLogout) {
                config.onLogout = options.onLogout;
            }
            // window.addEventListener('message', onMessage, false);
        },
        open: function () {
            // 打开登录弹窗
            openPopup();
        },
        close: function () {
            // 关闭登录弹窗
            closePopup(true);
        },
        logout: function () {
            logoutSso();
        }
    };
})();