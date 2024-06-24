<?php

namespace Modules\Auth\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Modules\Auth\Http\Requests\Admin\LogoutRequest;
use Modules\Auth\Http\Requests\Family\RegisterLoginRequest;
use Modules\Auth\Http\Requests\Family\RegisterRequest;
use Modules\Auth\Http\Requests\Family\SendTokenRequest;
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

  public function showLoginForm(): View
  {
    return view('auth::family.login');
  }

  public function sendToken(SendTokenRequest $request): JsonResponse
  {
    try {
      $mobile = $request->input('mobile');
//      $result = event(new SmsVerify($mobile));
//
//      if ($result[0]['status'] != 200) {
//        return response()->json($result[0]['message'], 500);
//      }

      return response()->json($mobile);
    } catch (Exception $exception) {
      Log::error($exception->getTraceAsString());

      return response()->json('مشکلی در برنامه بوجود آمده است. لطفا با پشتیبانی تماس بگیرید', 500);
    }
  }

  public function registerLogin(RegisterLoginRequest $request): JsonResponse
  {
    try {
      $mobile = $request->input('mobile');
      $family = Family::query()->where('mobile', $mobile)->exists();
      $status = $family ? 'login' : 'register';

      //send SMS
      $this->sendSms($mobile);

      return response()->json(compact(['status', 'mobile']), 200);

    } catch (Exception $exception) {
      Log::error($exception->getTraceAsString());

      return response()->json(
        'مشکلی در برنامه بوجود آمده است. لطفا با پشتیبانی تماس بگیرید: ' . $exception->getMessage(),
        500
      );
    }
  }

  public function register(RegisterRequest $request): \Illuminate\Http\RedirectResponse
  {
    $family = Family::query()->create($request->all());
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
