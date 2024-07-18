个人信息
安全
	密码修改
	手机
	邮箱
社交账号 
授权管理  oauth client
设备管理
冻结账号
注销账号



location ~* ^/(api|sso|u|login|logout) {
	try_files $uri $uri/ /index.php$is_args$query_string;  
}  

location / {
    try_files $uri $uri/ /index.html;
    index index.html;
}