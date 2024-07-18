<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookieController;


// 跳转式写SSO cookie
Route::get('/sso-cookie/set-sid', [CookieController::class, 'setCookie'])->name('sso.cookie.set');

// 清除登录cookie
Route::get('/sso-cookie/clear-sid', [CookieController::class, 'clearCookie'])->name('sso.cookie.clear');




