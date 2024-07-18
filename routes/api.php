<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\ValidateController;




Route::get('/', function () {
    return 'This is passport api';
});


// 验证接口
Route::get('/validate', [ValidateController::class, 'ticket']);


// 





/**
 * 这部分接口基于SID
 */
Route::middleware([
    App\Http\Middleware\NeedSID::class,
])->group(function () {

    Route::get('/sid/profile', [SessionController::class, 'profile']);

    Route::put('/sid/profile', [SessionController::class, 'updateProfile']);

    Route::get('/sid/picture', [SessionController::class, 'setPicture']);

});








Route::any('/{everything}', function () {
    return response()->json(['code'=>404]);
})->where('everything', '.*');;