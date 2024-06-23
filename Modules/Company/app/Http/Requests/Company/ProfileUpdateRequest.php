<?php

namespace Modules\Company\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Core\Rules\IranMobile;

class ProfileUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    $companyId = auth('company-web')->user()->id;

    return [
      'telephone' => ['required', 'numeric', Rule::unique('companies', 'telephone')->ignore($companyId)],
      'username' => ['required', 'min:3', 'max:90', Rule::unique('companies', 'username')->ignore($companyId)],
      'old_password' => ['nullable'],
      'password' => ['nullable', 'string', Password::min(6), 'confirmed'],
      'resume' => ['required', 'string', 'min:3'],
      'address' => ['required', 'string', 'min:3'],
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
