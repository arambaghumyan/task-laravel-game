<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Symfony\Component\HttpFoundation\Response;

class TokenValidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $tokenParam = $request->route()->token;
        $token = Token::where('token', $tokenParam)->first();

        if (!$token) abort(404);
        if (!Carbon::parse($token->expired_at)->isFuture()) {

            return redirect()->route('tokens.expired', ['token' => $token->token]);
        }

        return $next($request);
    }
}
