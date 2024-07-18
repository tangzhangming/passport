<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserEventPush implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    private $events;

    public function __construct($user, $events)
    {
        $this->user = $user;
        $this->events = $events;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info('------------------------------------------------------------');
        Log::info('用户数据更新同步');
        Log::info('用户信息 : ' . $this->user);
        Log::info('User ID : ' . $this->user->id);
        Log::info('Name : ' . $this->user->name);
        Log::info('Email : ' . $this->user->email);
        foreach ([
            'http://www.usoppsoft.com/api/sso/event',
            'http://quora.usoppsoft.com/?/help',
        ] as $key => $url) {
            $this->send($key+1, $url);
        }
        Log::info('------------------------------------------------------------');
    }


    public function send(int $ordinal, $url)
    {
        Log::info("------------ No {$ordinal}. ------------");
        Log::info('同步至地址 : ' . $url);
        $response = Http::asForm()->post($url, [
            'event'  => 'user.update',
            'ssouid' => $this->user->id,
            'data'   => [
                'name' => $this->user->name,
                'avatar' => $this->user->avatar,
            ],
        ]);
        Log::info('客户端状态码 : ' . $response->status() );
        Log::info('客户端响应体 : ' . $response->body() );

        if( !$response->successful() ){
            // echo "修改事件请求错误";
            // exit; 
            return true;
        }
        

        return true;
    }
}
