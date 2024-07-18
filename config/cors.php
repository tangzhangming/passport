<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'web-api/*', 'sanctum/csrf-cookie', 'sso/*'],

    /**
     * 允许跨域请求本系统的域名
     * Access-Control-Allow-Methods
     */
    'allowed_methods' => ['*'],

    /**
     * 允许跨域请求本系统的域名
     * Access-Control-Allow-Origin
     */
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    /**
     * 允许携带的header头
     * Access-Control-Allow-Headers
     */
    'allowed_headers' => ['*'],

    /**
     * https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Headers/Access-Control-Expose-Headers
     * Access-Control-Expose-Headers
     */
    'exposed_headers' => [],

    /**
     * https://developer.mozilla.org/zh-CN/docs/Web/HTTP/Headers/Access-Control-Max-Age
     * Access-Control-Max-Age
     * 响应标头指示了预检请求（即包含在 Access-Control-Allow-Methods 和 Access-Control-Allow-Headers 标头中的信息）的结果能够被缓存多久
     */
    'max_age' => 0,

    /**
     * 是否允许客户端跨域请求携带Credentials(即cookie)
     * Access-Control-Allow-Credentials
     */
    'supports_credentials' => true,

];
