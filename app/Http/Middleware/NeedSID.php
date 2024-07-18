<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class NeedSID
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $sid = $request->input('sid');

            if( is_null($sid) ){
                throw new \Exception("请携带 SID", 10001);
            }

            if( !Session::isValidId($sid) ){
                throw new \Exception("SID格式错误", 10003);
            }

            Session::setId($sid);
            Session::start();

            if( Auth::guest() ){
                throw new \Exception("无效的 SID 或者 SID 已被销毁、过期", 10401);
            }

            return $next($request);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
