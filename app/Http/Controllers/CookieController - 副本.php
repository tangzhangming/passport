<?php
namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use App\Models\Crossdomain;

class CookieController extends Controller
{

    const ENDPOINT_URLS = [
        'passport.520.com', 
        'passport.usoppsoft.com', 
    ];

    const SSID_COOKIE_NAME = 'SSID';
    const SUID_COOKIE_NAME = 'SUID';


    /**
     * 设置 SSO COOKIE
     * https://passport.520.com/set-sid
     * https://passport.usoppsoft.com/set-sid
     */
    public function setCookie(Request $request)
    {
        $validator = Validator::make($request->query(), [
            'continue' => 'required|url',
            'ticket'   => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }


        $continue = $request->query('continue');
        $ciphertext = $request->query('ticket');


        // 为当前站点设置SID
        $info = decrypt($ciphertext);
        $info = json_decode($info, true);
        // if( Arr::get($info, 't') != $timestamp ){
        //     return '过期请求';
        // }
        $ticket = Arr::get($info, 'sid');
        $user_id = Arr::get($info, 'uid');

        // 设置COOKIE
        $rootDomain = $this->getRootDomain($request);



        /**
         * config/session 中的配置会影响cookie默认行为，所以这里强制关闭secure并且使用lax，http下也可以用
         */
        Cookie::queue(config('sso.ssid_cookie_name'), $ticket, 3600, '/', $rootDomain, false, true, false, 'lax');
        Cookie::queue(config('sso.suid_cookie_name'), $user_id, 3600, '/', $rootDomain, false, true, false, 'lax');



        // return 'abcd'.$rootDomain;

        // 跳转至下一站
        $getKey = function($host){
            foreach (static::ENDPOINT_URLS as $key => $value) {
                if( $host == $value ){
                    return $key;
                }
            }
            return null;
        };
        $currentKey = $getKey($request->host());
        $next = Arr::get(static::ENDPOINT_URLS, $currentKey+1);


        if( $next === null ){
            // 去终点站
            return redirect()->away($continue);
        }

        
        // return redirect()->away('https://' . $next . '/set-sid?' . http_build_query($request->query()));
        return redirect()->away(
            'https://' . $next . route('sso.cookie.set', $request->query(), false)
        );
    }

    /**
     * 删除 SSO COOKIE
     * https://passport.520.com/clear-sid
     * https://passport.usoppsoft.com/clear-sid
     */
    public function clearCookie(Request $request)
    {
        if( !in_array('image/*', $request->getAcceptableContentTypes()) ){
            // 本页面仅限当作图片请求 防止用户直接打开造成个别页面cookie失效
            return 'Little bad guy, What did you want to do?';
        }


        $rootDomain = $this->getRootDomain($request);

        $image = 'iVBORw0KGgoAAAANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAACcAAAAnASoJkU8AAABSSURBVBhXHYxBDgARAMS6hHiQVzs6SjzCazhgFnOctP167+LMOcfem7UWRhIhBGqtpJTw3mMuUUp5R4yRCzHnVGtNOWcdXTf3mpe21jLGOHX4AQKlMlb96zJbAAAAAElFTkSuQmCC';
        return response(base64_decode($image))
            ->header('Content-Type', 'image/png')
            ->cookie(config('sso.ssid_cookie_name'), '', -1, '/', $rootDomain)
            ->cookie(config('sso.suid_cookie_name'), '', -1, '/', $rootDomain);
    }


    private function getRootDomain(Request $request) {
        $host = $request->getHost();
        $parts = explode('.', $host);
        $count = count($parts);
     
        if ($count <= 2) {
            // 没有子域名，返回根域名
            return $host;
        }
     
        // 获取顶级域名（com, org, net 等）
        $tld = end($parts);
        $secondLevel = $parts[$count - 2];
        $topLevelDomain = "$secondLevel.$tld";
     
        // 判断是否为国际化顶级域名（cn, uk 等）
        if (in_array($tld, ['com', 'org', 'net', 'edu', 'gov', 'int'])) {
            $rootDomain = implode('.', array_slice($parts, -2));
        } else {
            $rootDomain = implode('.', array_slice($parts, -3));
        }
     
        return '.'.$rootDomain;
    }
}
