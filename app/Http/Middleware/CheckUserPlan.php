<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserPlan
{
    public function handle($request, Closure $next, ...$plans)
    {
        $user = Auth::user();

        if ($user && in_array($user->plan, $plans)) {
            return $next($request);
        }

        return redirect('/pricing');
        abort(403, 'Unauthorized action');
    }
}
