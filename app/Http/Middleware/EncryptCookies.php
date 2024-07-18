<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [

    ];

    public function __construct(EncrypterContract $encrypter)
    {
        // 动态追加两个sso cookie
        $this->except += [
            config('sso.ssid_cookie_name'),
            config('sso.suid_cookie_name'),
        ];

        parent::__construct($encrypter);
    }
}
