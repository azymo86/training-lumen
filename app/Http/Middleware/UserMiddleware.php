<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
        // cek token request
        $token = $request->header('token');
        if (!$token)
        {
            $out = array(
              'success' => false,
              'token' => 'Token has been required'
            );
            return response()->json($out,400);
        }


        // cek token on database
        $check =  User::where('token', $token)->first();
        if (!$check) {
          $out = array(
            'success' => false,
            'token' => "Token isn't valid"
          );
          return response()->json($out,406);
        }


        // cek token time
        $diff   = date_diff($check->updated_at, date_create());
        if ($diff->h >= 2)
        {
          $out = array(
            'success' => false,
            'token' => "Your token is expired"
          );
          return response()->json($out,406);
        }


         return $next($request);

     }
}
