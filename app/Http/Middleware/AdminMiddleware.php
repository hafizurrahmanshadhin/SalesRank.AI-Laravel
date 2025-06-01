<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        return Helper::jsonResponse(false, 'Unauthorized Access.', 403);
    }
}
