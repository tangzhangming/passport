<?php

return [

	// 账户中心 session_id 在各个顶级域下的cookie名
	'ssid_cookie_name' => 'SSID',

	// 账户中心 当前uid 在各个顶级域下的cookie名
	'suid_cookie_name' => 'SUID',

	// 顶级域SID设置点
	'crossdomain' => [
		[
			'id'     => 1,
			'key'    => 'base64:ySJ4EX0DCOUZ/tiRKG5kKQ==',
			'cipher' => 'aes-128-cbc',
			'login'  => 'https://passport.520.com/sso-cookie/set-sid',
			'logout' => 'https://passport.520.com/sso-cookie/clear-sid',
		],
		[
			'id'     => 2,
			'key'    => 'base64:Tx/R8ydWzAaqKiWhAtvoLA==',
			'cipher' => 'aes-128-cbc',
			'login'  => 'https://passport.usoppsoft.com/sso-cookie/set-sid',
			'logout' => 'https://passport.usoppsoft.com/sso-cookie/clear-sid',
		],
	],
];
