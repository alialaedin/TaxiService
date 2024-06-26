<?php

namespace Modules\Auth\Http\Requests\Family;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Modules\Core\Helpers\Helpers;
use Modules\Core\Rules\IranMobile;
use Modules\Family\Models\Family;
use Modules\Family\Models\SmsToken;

class VerifyRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    return [
      'mobile' => ['required', 'digits:11', new IranMobile()],
      'sms_token' => ['required', 'numeric', 'digits:' . Family::TOKEN_DIGITS],
    ];
  }


  protected function passedValidation(): void
  {
    $smsToken = SmsToken::query()->where('mobile', $this->input('mobile'))->first();

    if (!$smsToken) {
      throw Helpers::makeWebValidationException('کاربری با این شماره موبایل پیدا نشد!', 'sms_token');
    } elseif ($smsToken->token !== $this->input('sms_token')) {
      throw Helpers::makeWebValidationException('کد وارد شده نادرست است!', 'sms_token');
    } elseif (Carbon::now()->gt($smsToken->expired_at)) {
      throw Helpers::makeWebValidationException('کد وارد شده منقضی شده است!', 'sms_token');
    }

    $this->merge([
      'smsToken' => $smsToken,
    ]);
  }

  public function authorize(): bool
  {
    return true;
  }
}
