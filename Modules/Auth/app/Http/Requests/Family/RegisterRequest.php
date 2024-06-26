<?php

namespace Modules\Auth\Http\Requests\Family;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Rules\IranMobile;

class RegisterRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    return [
      'mobile' => [
        'required',
        'numeric',
        'digits:11',
        new IranMobile(),
        Rule::exists('sms_tokens', 'mobile')
      ],
      'name' => [
        'required',
        'string',
        'min:3',
        'max:100'
      ],
      'email' => [
        'nullable',
        'email'
      ]
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
