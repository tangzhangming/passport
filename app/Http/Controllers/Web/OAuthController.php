<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{


    // https://passport.520.com/web-api/oauth/connects
    public function index(Request $request)
    {
        $user_oauths = DB::table('user_oauth')->where('user_id', Auth::id())->get();

        $authItem = function($provider_name) use($user_oauths) {
            return $user_oauths->first(function($value, int $key) use($provider_name) {
                return $value->provider_name == $provider_name;
            });
        };

        $github = $authItem('github');
        $google = $authItem('google');
        $twitter = $authItem('twitter');
        $weixin = $authItem('weixin');

        $connects = [
            'google' => [
                'name' => 'Google',
                'bind_status' => !($google==null),
                'bind_link' => action([static::class, 'redirectToProvider'], ['provider_name'=>'google']),
                'display_name' => $google ? $google->display_name : '未绑定' ,
            ],
            'twitter' => [
                'name' => '推特X',
                'bind_status' => !($twitter==null),
                'bind_link' => action([static::class, 'redirectToProvider'], ['provider_name'=>'twitter']),
                'display_name' => $twitter ? $twitter->display_name : '未绑定' ,
            ],
            'github' => [
                'name' => 'Github',
                'bind_link' => action([static::class, 'redirectToProvider'], ['provider_name'=>'github']),
                'display_name' => $github ? $github->display_name : '未绑定' ,
                'bind_status' => !($github==null),
            ],
            'weixin' => [
                'name' => '微信',
                'bind_status' => !($weixin==null),
                'bind_link' => action([static::class, 'handleProviderCallback'], ['provider_name'=>'weixin']),
                'display_name' => $weixin ? $weixin->display_name : '未绑定' ,
            ],
        ];

        return response()->json([
            'code' => 0,
            'data' => [
                'count' => count($connects),
                'connects' => $connects,
            ],
        ]);
    }


    public function redirectToProvider(Request $request, $provider_name)
    {
        // 应当检查是否已经存在绑定

        return socialite($provider_name)->stateless()->redirect();
    }


    /**
     * https://passport.520.com/web-api/oauth/github/callback
     * \Laravel\Socialite\Two\GithubProvider
     * \Laravel\Socialite\Two\TwitterProvider
     */
    public function handleProviderCallback(Request $request, $provider_name)
    {
        $oauthUser = socialite($provider_name)->stateless()->user();
            
        // 要检查用户不能已经绑定这个provider


        // 这个provider用户不能已经被其他账户绑定

        $oauthUid = $oauthUser->getId(); 
        $displayName = $oauthUser->getNickname(); 

        DB::table('user_oauth')->insert([
            'provider_name' => $provider_name,
            'user_id' => Auth::id(),
            'oauth_id' => $oauthUid,
            'display_name' => $displayName,
        ]);

        return view('web-api.oauth-callback', [
            'provider_name' => $provider_name,
            'display_name' => $displayName,
        ]);
    }

    public function unbind(Request $request, $provider_name)
    {
        DB::table('user_oauth')
            ->where('user_id', $request->user()->id)
            ->where('provider_name', $provider_name)
            ->delete();

        return response()->json([
            'code' => 0,
            'data' => null,
        ]);
    }

}
