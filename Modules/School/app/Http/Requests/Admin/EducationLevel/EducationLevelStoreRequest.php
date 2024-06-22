<?php

namespace Modules\School\Http\Requests\Admin\EducationLevel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\School\Models\EducationLevel;

class EducationLevelStoreRequest extends FormRequest
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
