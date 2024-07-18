<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Http\Requests\Auth\LoginRequest;

class SsoController extends Controller
{

    const ENDPOINT = [
        'https://passport.520.com/api/sso/crossdomain',
        'https://passport.usoppsoft.com/api/sso/crossdomain',
    ];

    // 追加参数
    private function append($query)
    {
        return array_map(function($url) use($query) {
            return $url . "?" . http_build_query($query);
        }, static::ENDPOINT);
    }

    public function status(Request $request)
    {
        if( Auth::guest() ){
            return response()->json([
                'guest'     => true,
            ]);
        }


        return response()->json([
            'guest'     => false,
            'userinfo'  => Auth::user()
        ]);
    }

    /**
     * sso弹窗登录
     * @link https://passport.520.com/login_popup
     */
    public function create(Request $request)
    {
        $referer = $request->header('Referer');

        if( !is_null($referer) && str_starts_with($referer, 'http://') ){
            return '
            <style>
                html, body{
                    margin:0px;
                    padding:0px;
                }
            </style>
            <div style="width:350px;height:450px;margin:0px;background-color: #FFF;">
                弹窗模式仅支持SSL
            </div>
            ';
        }
        
        return Auth::guest() ? view('sso.popup_login') : view('sso.popup_check') ;
    }

    public function store(LoginRequest $request){
        try {
            $request->authenticate();
            $request->session()->regenerate();


            $ticket = 'ST-'.Str::random(40);
            Cache::put($ticket, Auth::id());

            $t = time();
            $endpoint = $this->append([
                'action'  => 'login',
                'ticket'  => encrypt(json_encode([
                    'ticket' => $ticket,
                    'user_id' => Auth::id(),
                    't' => $t,
                ])),
                't' => $t,
            ]);

            return response()
                ->json([
                    'code' => 200,
                    'data' => [
                        'redirect' => $request->input('redirect_url'),
                        'endpoint' => $endpoint,
                    ],
                ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $validator = $e->validator;
            return response()->json([
                'code'    => 419,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ]);
        }
    }


    /**
     * sso退出
     * @link https://passport.520.com/sso/logout
     */
    public function logout(Request $request)
    {
        $auth = Auth::guard('web');
        $endpoints = [];

        if( $auth->check() ){
            $auth->logout();
            $request->session()->invalidate();
            $endpoints = $this->append(['action'=>'logout']);
        }

        return response()->json([
            'errcode'   => 0,
            'guest'     => $auth->guest(),
            'endpoints' => $endpoints
        ]);
    }



}
