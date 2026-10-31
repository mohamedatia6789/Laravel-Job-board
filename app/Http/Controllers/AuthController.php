<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpValidate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view("auth.login",["title"=>"Login"]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($request->has('remember')) {
            Cookie::queue('remember_email', $request->email, 60 * 24 * 30); // Store for 30 days
        } else {
            Cookie::queue(Cookie::forget('remember_email'));
        }

        if (Auth::attempt($credentials, $request->has('remember'))) {
            
            $request->session()->regenerate();
            return redirect()->intended('/about');

        }

        return back()->withErrors([
            'password' => 'The provided credentials do not match our records.',
        ]);
    }
    public function showSignupForm()
    {
        return view("auth.signup",["title"=>"Sign Up"]);
    }
    public function signup(SignUpValidate $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        Auth::login($user);
        return redirect("/");
    }
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect("/");
    }
    public function deleteAccount(Request $request)
{
    // 1. جلب المستخدم الحالي
    $user = auth()->user();

    // 2. تسجيل خروج المستخدم وتدمير الـ Session أولاً
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // 3. حذف الحساب من قاعدة البيانات
    $user->delete();

    // 4. التوجيه لصفحة تسجيل الدخول مع رسالة
    return redirect()->route('login')->with('success', 'تم حذف حسابك بنجاح.');
}
}

