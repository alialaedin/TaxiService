<?php

namespace Modules\School\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Modules\Core\Rules\IranMobile;

class SchoolStoreRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    return [
      'title' => ['required', 'min:3', 'max:90', Rule::unique('schools', 'title')],
      'manager_name' => ['required', 'min:3', 'max:90'],
      'manager_mobile' => ['required', 'numeric', Rule::unique('schools', 'manager_mobile'), new IranMobile()],
      'telephone' => ['required', 'numeric', Rule::unique('schools', 'telephone')],
      'city_id' => ['required', 'integer', Rule::exists('cities', 'id')],
      'education_level_id' => ['required', 'integer', Rule::exists('education_levels', 'id')],
      'shift_id' => ['required', 'integer', Rule::exists('shifts', 'id')],
      'school_type_id' => ['required', 'integer', Rule::exists('school_types', 'id')],
      'status' => ['required', Rule::in(0, 1)],
      'is_traffic' => ['required', Rule::in(0, 1)],
      'map' => ['required', 'min:3'],
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
