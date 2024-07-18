<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\Models\Crossdomain;

class AuthenticatedSessionController extends Controller
{

    const ENDPOINT = [
        'https://passport.520.com/api/sso/crossdomain',
        'https://passport.usoppsoft.com/api/sso/crossdomain',
    ];

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $next = Crossdomain::next(0, url(RouteServiceProvider::HOME), [
            'suid' => Auth::id(),
            'ssid' => $request->session()->getId(),
        ]);

        return redirect()->away($next);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        $redirect_url = $request->input('redirect_url', '/login');

        return view('auth.logout', [
            'redirect_url' => $redirect_url,
            'endpoints' => $this->logoutUrls(),
        ]);
    }

    // 追加参数
    private function append($query)
    {
        return array_map(function($url) use($query) {
            return $url . "?" . http_build_query($query);
        }, static::ENDPOINT);
    }


    private function logoutUrls()
    {
        return array_map(function($url){
            return 'https://' . $url . route('sso.cookie.clear', [], false);
        }, \App\Http\Controllers\CookieController::ENDPOINT_URLS);
    }
}
