<?php

namespace Modules\Driver\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Modules\Core\Rules\IranMobile;
use Modules\Driver\Models\Driver;

class DriverUpdateRequest extends FormRequest
{
  public function rules(): array
  {
    $driverId = $this->route('driver')->id;

    return [
      'company_id' => ['required', 'integer', Rule::exists('companies', 'id')],
      'car_type' => ['required', Rule::in(Driver::getAllCarTypes())],
      'gender' => ['required', Rule::in(Driver::getAllGenders())],
      'name' => ['required', 'string', 'max:191'],
      'mobile' => ['required', new IranMobile(), Rule::unique('drivers', 'mobile')->ignore($driverId)],
      'national_code' => ['required', 'digits:10', Rule::unique('drivers', 'national_code')->ignore($driverId)],
      'address' => ['required', 'string', 'max:1000'],
      'car_model' => ['required', 'string', 'max:50'],
      'car_color' => ['required', 'string', 'max:50'],
      'car_name' => ['required', 'string', 'max:100'],
      'plaque_1' => ['required', 'integer', 'digits:2'],
      'plaque_2' => ['required', 'integer', 'digits:3'],
      'plaque_3' => ['required', 'string', 'alpha', 'size:1'],
      'plaque_4' => ['required', 'integer', 'digits:2'],
      'plaque' => 'nullable',
      'license_expiration_date' => ['nullable', 'date'],
      'bank_name' => ['required', 'string', 'max:100'],
      'account_number' => ['required', 'string', 'max:50'],
      'sheba_number' => ['required', 'string', 'max:50'],
      'card_number' => ['required', 'string', 'max:20'],
      'license_image' => ['nullable', File::types(Driver::ACCEPTED_LICENSE_MIME_TYPES)->max(2048)],
      'driver_image' => ['nullable', File::types(Driver::ACCEPTED_IMAGE_MIME_TYPES)->max(2048)],
    ];
  }

  protected function prepareForValidation(): void
  {
    $this->merge([
      'plaque' => $this->input('plaque_1') . '|' .
        $this->input('plaque_2') . '|' .
        $this->input('plaque_3') . '|' .
        $this->input('plaque_4')
    ]);
  }

  public function authorize(): bool
  {
    return true;
  }
}
