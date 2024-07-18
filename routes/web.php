<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Encryption\Encrypter;


use App\Http\Controllers\SsoController;
use App\Http\Controllers\ProfileController;
use App\Models\Crossdomain;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login', [
        'continue' => 'https://passport.520.com',
    ]);
});


Route::get('/sso/status', [SsoController::class, 'status']);
Route::get('/sso/logout', [SsoController::class, 'logout']);
Route::post('/sso/login', [SsoController::class, 'store']);
Route::get('/login/popup', [SsoController::class, 'create']);



Route::get('/u/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/web-api/profile', [ProfileController::class, 'show']);

    Route::get('/u/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/u/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/u/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


require_once(__DIR__.'/group/cookie/cookie.php');

