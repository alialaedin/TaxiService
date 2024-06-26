<?php

namespace Modules\Auth\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Modules\Auth\Http\Requests\Admin\LogoutRequest;
use Modules\Auth\Http\Requests\Family\RegisterRequest;
use Modules\Auth\Http\Requests\Family\SendTokenRequest;
use Modules\Auth\Http\Requests\Family\VerifyRequest;
use Modules\Family\Events\SmsVerify;
use Modules\Family\Models\Family;

class AuthController extends Controller
{
  private function updateLastLoggedIn(Family|Builder $family): void
  {
    $family->last_login = now();
    $family->save();
  }

  private function sendSms(string $mobile): void
  {
    $result = event(new SmsVerify($mobile));
    if ($result[0]['status'] != 200) {
      response()->json('ارسال کدفعال سازی ناموفق بود.لطفا دوباره تلاش کنید.', 500);
    }
  }

  public function showMobileForm(): View
  {
    return view('auth::family.mobile-form');
  }

  public function sendToken(SendTokenRequest $request): RedirectResponse
  {
    try {

      $mobile = $request->input('mobile');
      $result = event(new SmsVerify($mobile));

      Session::put('mobile', $mobile);

      if ($result[0]['status'] != 200) {
        return redirect()->back()->with([
          'error' => $result[0]['message']
        ]);
      }

      return to_route('family.verify-form');

    } catch (Exception $exception) {

      Log::error($exception->getTraceAsString());

      return redirect()->back()->with([
        'error' => 'مشکلی در برنامه بوجود آمده است. لطفا با پشتیبانی تماس بگیرید'
      ]);

    }
  }

  public function showTokenForm(): View|RedirectResponse
  {
    if (!Session::has('mobile')) {
      return to_route('family.mobile-form');
    }

    $mobile = Session::get('mobile');

    return view('auth::family.token-form', compact('mobile'));
  }

  public function verify(VerifyRequest $request): RedirectResponse
  {
    try {
      $mobile = $request->input('mobile');
      $smsToken = $request->input('smsToken');

      $smsToken->verified_at = now();
      $smsToken->save();

      $family = Family::query()->where('mobile', $mobile)->first();

      // Login
      if ($family) {

        if (!$family->active) {
          return redirect()->back()->with([
            'error' => 'شما غیر فعال شده اید و امکان ورود به پنل را ندارید!'
          ]);
        }

        Auth::guard('family-web')->login($family);

        $request->session()->regenerate();

        $this->sendSms($mobile);

        $this->updateLastLoggedIn($family);

        return redirect()->intended(route('family.dashboard'));
      }

      // Register
      return to_route('family.register-form');

    } catch (Exception $exception) {

      Log::error($exception->getTraceAsString());

      return redirect()->back()->with([
        'error' => $exception->getMessage()
      ]);

    }
  }

  public function resendSmsToken(string $mobile)
  {
    $result = event(new SmsVerify($mobile));

    if ($result[0]['status'] != 200) {
      return redirect()->back()->with([
        'error' => $result[0]['message']
      ]);
    }

    return redirect()->back();
  }

  public function showRegisterForm(): View|RedirectResponse
  {
    if (!Session::has('mobile')) {
      return to_route('family.mobile-form');
    }

    $mobile = Session::get('mobile');

    return view('auth::family.register-form', compact('mobile'));
  }

  public function register(RegisterRequest $request): RedirectResponse
  {
    $family = Family::query()->create($request->all());

    Auth::guard('family-web')->login($family);
    $request->session()->regenerate();

    $this->updateLastLoggedIn($family);

    return redirect()->intended(route('family.dashboard'));
  }

  public function logout(LogoutRequest $request): RedirectResponse
  {
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route("family.login.form");
  }

}
