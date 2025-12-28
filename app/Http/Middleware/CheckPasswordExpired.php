<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckPasswordExpired
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($request->is('changePasswordExpired') || $request->is('changePasswordExpired/*')) {
            return $next($request);
        }

        if ($user->password_change_status == '0' && $user->password_changed_at) {
            $expireDays = config('auth.password_expire_days');
            $daysSinceChange = Carbon::parse($user->password_changed_at)->diffInDays(Carbon::now());

            if ($daysSinceChange >= $expireDays) {
                return redirect()->route('passwordChangeExpired')->with('warning', 'لطفاً رمز عبور خود را تغییر دهید.');
            }
        }

        return $next($request);
    }
}
