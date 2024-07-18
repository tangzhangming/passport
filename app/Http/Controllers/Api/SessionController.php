<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class SessionController extends Controller
{
    /**
     * 获取用户信息
     * http://idapi.usoppsoft.com/sid/profile
     */
    public function profile(Request $request)
    {
        $user_model = Auth::user();
        return response()->json([
            'errcode' => 0,
            'data' => [
                'sub' => $user_model->id,
                'name' => $user_model->name,
                'email' => $user_model->email,
                'email_verified_at' => $user_model->email_verified_at,
            ]
        ]);
    }

    /**
     * 修改用户信息
     * http://idapi.usoppsoft.com/sid/profile
     */
    public function updateProfile(Request $request)
    {
        return [
            'code' => 0,
            'data' => Auth::user(),
            // 'sessions' => Session::all()
        ];
    }

    /**
     * 设置头像 profile picture
     * http://idapi.usoppsoft.com/sid/picture
     */
    public function setPicture(Request $request)
    {
        return [
            'code' => 0,
            'data' => Auth::user(),
            // 'sessions' => Session::all()
        ];
    }



}
