<?php

namespace Modules\Auth\Http\Requests\Family;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Rules\IranMobile;

class RegisterLoginRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    return [
      'mobile' => ['required', 'digits:11', new IranMobile()],
    ];
  }

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }
}
