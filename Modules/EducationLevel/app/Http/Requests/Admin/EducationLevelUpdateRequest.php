<?php

namespace Modules\EducationLevel\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\EducationLevel\Models\EducationLevel;

class EducationLevelUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    return [
      'title' => ['required', 'string', 'min:3', 'max:90'],
      'status' => ['required', Rule::in(0, 1)],
      'gender' => ['required', Rule::in(EducationLevel::GENDERS)],
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
