<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\OAuthController;
use App\Http\Controllers\Api\CrossDomainController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// require_once(__DIR__.'/group/external.php');

Route::get('/sso/crossdomain', CrossDomainController::class);





Route::middleware(\App\Http\Middleware\WebApiAuth::class)->group(function(){

	// 读取个人资料
	Route::get('/profile', [ProfileController::class, 'show']);
	Route::put('/profile', [ProfileController::class, 'update']);
	
	// 社交账号绑定
	Route::get('/oauth/connects', [OAuthController::class, 'index']);
	Route::get('/oauth/{provider_name}/redirect', [OAuthController::class, 'redirectToProvider']);
	Route::get('/oauth/{provider_name}/callback', [OAuthController::class, 'handleProviderCallback']);

});