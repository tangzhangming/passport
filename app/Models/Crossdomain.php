<?php
namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Encryption\Encrypter;

class Crossdomain
{


    public static function all()
    {
        return config('sso.crossdomain');
    }

    public static function next($ckey=0, string $continue='null', $data=null)
    {
        $next = Arr::get(static::all(), $ckey);

        if( !$next ){
            return $continue . '#bysso';
        }

        $url = Arr::get($next, 'login');
        $key = Arr::get($next, 'key');
        $cipher = Arr::get($next, 'cipher');

 

        $encrypter = new Encrypter(static::getKey($key), $cipher);

        $ticket = $encrypter->encrypt($data);

        $vars['key'] = (string) $ckey;
        $vars['continue'] = $continue;
        $vars['ticket'] = $ticket;

        return $url .'?'. http_build_query($vars);
    }

    public static function decrypt($ckey, $data)
    {
        $item = Arr::get(static::all(), $ckey);

        if( !$item ){
            throw new \Exception("ERROR");
        }

        $base64key = Arr::get($item, 'key');
        $key = static::getKey($base64key);
        $cipher = Arr::get($item, 'cipher');

        if( !Encrypter::supported($key, $cipher) ){
            throw new \Exception("配置有误: 检查key、cipher");
        }

        return (new Encrypter($key, $cipher))->decrypt($data);
    }

    public static function getKey($key)
    {
        if( str_starts_with($key, 'base64:') ){
            list($x, $k) = explode(':', $key);
            return base64_decode($k);
        }

        throw new \Exception("key解析失败");
    }
}
