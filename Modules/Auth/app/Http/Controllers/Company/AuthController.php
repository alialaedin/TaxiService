<?php

namespace Modules\Auth\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Requests\Admin\LoginRequest;
use Modules\Auth\Http\Requests\Admin\LogoutRequest;

class AuthController extends Controller
{
  public function showLoginForm(): View
  {
    return view("auth::company.login");
  }

  public function login(LoginRequest $request): RedirectResponse
  {
    if (Auth::guard('company-web')->attempt($request->except("_token"))) {
      $request->session()->regenerate();
      return redirect()->intended(route('company.profile.edit'));
    }
    return back()->withErrors([
      'username' => 'چنین نام کاربری در پایگاه داده ثبت نشده است.',
    ])->onlyInput('username');
  }

  public function logout(LogoutRequest $request): RedirectResponse
  {
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route("company.login.form");
  }
}
