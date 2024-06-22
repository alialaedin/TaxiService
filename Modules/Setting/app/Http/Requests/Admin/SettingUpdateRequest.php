<?php

namespace Modules\Setting\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class SettingUpdateRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   */
  public function rules(): array
  {
    $rules = [];
    $rows = Config::get('setting.rows');
    foreach ($rows as $row) {
      if ($this->has($row['name'])) {
        $rules[$row['name']] = $row['rules'];
      }
    }

    return $rules;
  }

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }
}
