<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;

class CrossDomainController extends Controller
{

    public function __invoke(Request $request)
    {
        $action = $request->query('action');
        $timestamp = $request->query('t');

        $rootDomain = '.' . $this->getRootDomain($request);

        if( $action == 'logout' ){
            return response('is logout')
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->cookie('SSOUID', '', -1, '/', $rootDomain, true, true, false, 'None')
                ->cookie('UST', '', -1, '/', $rootDomain, true, true, false, 'None');
        }


        $ciphertext = $request->query('ticket');
        try {
            $info = decrypt($ciphertext);
            $info = json_decode($info, true);

            if( Arr::get($info, 't') != $timestamp ){
                return '过期请求';
            }

            $ticket = Arr::get($info, 'ticket');
            $user_id = Arr::get($info, 'user_id');

            $lifetime = config('session.lifetime', 120);
            return response($rootDomain)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->cookie('SSOUID', $user_id, $lifetime*60, '/', $rootDomain, true, true, false, 'None')
                ->cookie('UST', $ticket, $lifetime*60, '/', $rootDomain, true, true, false, 'None');


        } catch (DecryptException $e) {
            return abort(400, "ticket错误: {$e->getMessage()}");
        }
    }

 
    function getRootDomain(Request $request) {
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
     
        return $rootDomain;
    }

}
