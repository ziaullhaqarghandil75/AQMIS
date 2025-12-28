<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function index()
    {
        return view('auth.change_password')->with('message', 'ورد شما موفقانه انجام شد.');
    }

    public function passwordExpired()
    {
        return view('auth.change_password_expired')->with('message', 'ورد شما موفقانه انجام شد.');
    }

    public function storeExpiredPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
                'confirmed',
            ],
            'new_password_confirmation' => 'required'
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'رمز عبور قبلی نادرست است.']);
        }

        if ($this->hasInvalidPatterns($request->new_password)) {
            return redirect()->back()->withErrors(['new_password' => 'رمز عبور نمی‌تواند شامل "user@" باشد.']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return redirect()->back()->withErrors(['new_password' => 'رمز عبور جدید نمی‌تواند با رمز عبور قبلی یکسان باشد.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->password_changed_at = now();
        $user->save();

        return redirect()->route('dashboard')->with('success', 'رمز عبور شما موفقانه تغییر داده شد!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
                'confirmed'
            ],
        ]);

        $user = auth()->user();

        if ($this->hasInvalidPatterns($request->password)) {
            return redirect()->back()->withErrors(['password' => 'رمز عبور نمی‌تواند شامل "user@" باشد.']);
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'رمز عبور جدید نمی‌تواند با رمز عبور قبلی یکسان باشد.']);
        }

        $user->password = Hash::make($request->password);
        $user->first_login = '1';
        $user->save();

        return redirect()->route('dashboard')->with('success', 'رمز عبور شما موفقانه تغیر داده شد!');
    }

    private function hasInvalidPatterns($password)
    {
        $invalidPatterns = ['user@', 'User@', 'USER@'];
        foreach ($invalidPatterns as $pattern) {
            if (preg_match('/' . preg_quote($pattern, '/') . '/', $password)) {
                return true;
            }
        }
        return false;
    }
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function reset_password($user_id)
    {
        if (!(Auth::user()->can('reset_password_user'))) {
            return view('layouts.403');
        }
        $user = User::findOrFail($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'کاربر یافت نشد.');
        }
        $user->password     = Hash::make('user@123');
        $user->first_login  = '0';
        // $user->password_changed_at = null;

        $user->save();

        return redirect()->back()->with('success', 'پسورد کاربر رسیت شد.');
    }

    public function logOUt(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function profile_change_password(Request $request)
    {
        $request->validate([
            'current_password'          => 'required',
            'new_password_confirmation' => 'required',
            'new_password'              => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
                'confirmed',
            ],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'رمز عبور فعلی اشتباه است.']);
        }

        if ($this->hasInvalidPatterns($request->new_password)) {
            return back()->withErrors(['new_password' => 'رمز عبور نمی‌تواند شامل "user@" باشد.']);
        }

        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'رمز عبور جدید نمی‌تواند با رمز قبلی یکسان باشد.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
            'first_login' => '1',
            'password_changed_at' => now(),
        ]);

        return back()->with('success', 'رمز عبور شما موفقانه تغییر داده شد!');
    }
}
