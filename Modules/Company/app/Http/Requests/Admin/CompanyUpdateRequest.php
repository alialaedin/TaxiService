<?php

namespace Modules\Company\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Core\Rules\IranMobile;

class CompanyUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    $companyId = $this->route('company')->id;

    return [
      'title' => ['required', 'min:3', 'max:90', Rule::unique('companies', 'title')->ignore($companyId)],
      'name' => ['required', 'min:3', 'max:90'],
      'mobile' => ['required', 'numeric', Rule::unique('companies', 'mobile')->ignore($companyId), new IranMobile()],
      'telephone' => ['required', 'numeric', Rule::unique('companies', 'telephone')->ignore($companyId)],
      'city_id' => ['required', 'integer', Rule::exists('cities', 'id')],
      'status' => ['required', Rule::in(0, 1)],
      'username' => ['required', 'min:3', 'max:90', Rule::unique('companies', 'username')->ignore($companyId)],
      'password' => ['nullable', 'string', Password::min(6), 'confirmed'],
      'card_number' => ['required', 'digits:16', 'numeric'],
      'sheba_number' => ['nullable', 'digits:22', 'numeric'],
      'account_number' => ['required', 'digits:18', 'numeric'],
      'logo' => ['nullable', 'image', 'mimes:png,jpg'],
      'resume' => ['nullable', 'image', 'mimes:png,jpg,pdf'],
      'address' => ['required']
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
