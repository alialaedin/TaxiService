<?php

namespace Modules\SchoolType\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SchoolTypeUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
      return [
        'title' => [
          'required',
          'min:3',
          'max:90',
          Rule::unique('school_types', 'title')
            ->ignore($this->route('school_type')->id)
        ],
        'status' => [
          'required',
          Rule::in(0, 1)
        ],
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
