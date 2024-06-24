<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Core\Rules\IranMobile;

class CompanyStoreRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    return [
      'title' => ['required', 'min:3', 'max:90', Rule::unique('companies', 'title')],
      'name' => ['required', 'min:3', 'max:90'],
      'mobile' => ['required', 'numeric', Rule::unique('companies', 'mobile'), new IranMobile()],
      'telephone' => ['required', 'numeric', Rule::unique('companies', 'telephone')],
      'city_id' => ['required', 'integer', Rule::exists('cities', 'id')],
      'status' => ['required', Rule::in(0, 1)],
      'username' => ['required', 'min:3', 'max:90', Rule::unique('companies', 'username')],
      'password' => ['required', 'string', Password::min(6), 'confirmed'],
      'card_number' => ['required', 'digits:16', 'numeric'],
      'sheba_number' => ['nullable', 'digits:22', 'numeric'],
      'account_number' => ['required', 'digits:18', 'numeric'],
      'logo' => ['required', 'image', 'mimes:png,jpg'],
      'resume' => ['required', 'string', 'min:3'],
      'address' => ['required', 'string', 'min:3'],
      'schools' => ['required', 'array'],
      'schools.*' => ['required', 'integer', Rule::exists('schools', 'id')],
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
