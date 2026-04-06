<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->get('admin_authenticated')) {
            return redirect()->route('admin.login')
                ->with('error', 'يرجى تسجيل الدخول أولاً.');
        }

        return $next($request);
    }
}
