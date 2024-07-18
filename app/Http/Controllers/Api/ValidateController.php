<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class ValidateController extends Controller
{

    // http://idapi.usoppsoft.com/validate
    public function ticket(Request $request)
    {
        try {
            $ticket = $request->query('ticket');
            if( !$request->has('ticket') ){
                throw new \Exception("缺少参数: ticket", 1);
            }

            $user_id = Cache::get($ticket);
            if( !$user_id ){
                throw new \Exception("无效的 ticket", 2);
            }

            $user_model = User::where('id', $user_id)->first();

            return response()->json([
                'errcode' => 0,
                'data' => [
                    'sub' => $user_model->id,
                    'name' => $user_model->name,
                    'email' => $user_model->email,
                    'email_verified_at' => $user_model->email_verified_at,
                ]
            ]);


        } catch (\Exception $e) {
            return response()->json([
                'errcode' => $e->getCode(),
                'message' => $e->getMessage()
            ]);  
        }
    }

    /**
     * http://idapi.usoppsoft.com/sid/userinfo
     */
    public function userinfo(Request $request)
    {
        return [
            'code' => 0,
            'data' => Auth::user()
        ];
    }
}
