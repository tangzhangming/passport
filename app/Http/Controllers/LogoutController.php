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

class LogoutController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * sso退出点
     * @link https://passport.520.com/logout
     */
    public function __invoke(Request $request)
    {
        $redirect_url = $this->getRedirectUrl();


        // 退出点
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        // 清楚cookie点


        return view('logout', [
            'redirect_url' => $redirect_url,
            'endpoints' => $this->logoutUrls(),
        ]);
    }

    public function logoutUrls()
    {
        return [
            'https://passport.520.com/sso-cookie/clear-sid',
            'https://passport.usoppsoft.com/sso-cookie/clear-sid',
        ];
    }

    /**
     * 获得推出后的重定向地址
     */
    public function getRedirectUrl()
    {
        if( !$this->request->has('redirect_url') ){
            return route('login', ['from'=>'logout']);
        }

        // 应当检测合法性
        return $this->request->input('redirect_url');
    }
}
