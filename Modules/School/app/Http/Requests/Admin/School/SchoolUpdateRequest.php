<?php

namespace Modules\School\Http\Requests\Admin\School;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Rules\IranMobile;

class SchoolUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    $schoolId = $this->route('school');

    return [
      'title' => ['required', 'min:3', 'max:90', Rule::unique('schools', 'title')->ignore($schoolId)],
      'manager_name' => ['required', 'min:3', 'max:90'],
      'manager_mobile' => ['required', 'numeric', Rule::unique('schools', 'manager_mobile')->ignore($schoolId), new IranMobile()],
      'telephone' => ['required', 'numeric', Rule::unique('schools', 'telephone')->ignore($schoolId)],
      'city_id' => ['required', 'integer', Rule::exists('cities', 'id')],
      'education_level_id' => ['required', 'integer', Rule::exists('education_levels', 'id')],
      'shift_id' => ['required', 'integer', Rule::exists('shifts', 'id')],
      'school_type_id' => ['required', 'integer', Rule::exists('school_types', 'id')],
      'status' => ['required', Rule::in(0, 1)],
      'is_traffic' => ['required', Rule::in(0, 1)],
      'latitude' => ['required'],
      'longitude' => ['required'],
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
