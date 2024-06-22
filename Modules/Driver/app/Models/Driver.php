<?php

namespace Modules\Driver\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Company\Models\Company;
use Modules\Core\Exceptions\ModelCannotBeDeletedException;
use Modules\Core\Models\BaseModel;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends BaseModel
{
  use LogsActivity;

  const ACCEPTED_LICENSE_MIME_TYPES = 'jpg,jpeg,png,webp';
  const ACCEPTED_IMAGE_MIME_TYPES = 'jpg,jpeg,png,webp';

  const CAR_TYPE_PRIVATE = 'private';
  const CAR_TYPE_PUBLIC = 'public';

  const GENDER_MALE = 'male';
  const GENDER_FEMALE = 'female';


  const STATUS_PENDING = 'pending';
  const STATUS_CONFIRMED = 'confirmed';
  const STATUS_REJECTED = 'rejected';

  protected $fillable = [
    'company_id',
    'car_type',
    'gender',
    'name',
    'mobile',
    'national_code',
    'address',
    'car_model',
    'car_color',
    'car_name',
    'plaque',
    'license_expiration_date',
    'bank_name',
    'account_number',
    'sheba_number',
    'card_number',
    'status',
    'license_image',
    'driver_image'
  ];

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logAll()
      ->setDescriptionForEvent(function (string $eventName) {
        return "راننده با شناسه عددی $this->id با نام $this->name " . config('core.events.' . $eventName);
      });
  }

  protected static function booted(): void
  {
    static::created(fn() => toastr()->success('راننده جدید با موفقیت ساخته شد.'));
    static::updated(fn() => toastr()->success('راننده با موفقیت بروزرسانی شد.'));
    static::deleted(fn() => toastr()->success('راننده با موفقیت حذف شد.'));
    static::deleting(function (Driver $driver) {
      if (!$driver->isDeletable()) {
        throw new ModelCannotBeDeletedException('راننده قابل حذف نمی باشد.');
      }
      $driver->deleteFiles();
    });
  }

  public static function getAllCarTypes(): array
  {
    return [
      static::CAR_TYPE_PRIVATE,
      static::CAR_TYPE_PUBLIC
    ];
  }

  public static function getAllGenders(): array
  {
    return [
      static::GENDER_MALE,
      static::GENDER_FEMALE
    ];
  }

  public static function getAllStatuses(): array
  {
    return [
      static::STATUS_PENDING,
      static::STATUS_CONFIRMED,
      static::STATUS_REJECTED
    ];
  }

  public function isDeletable(): bool
  {
    // TODO check delete
    return true;
  }
  public function getGender(): string
  {
    return __('custom.genders.' . $this->attributes['gender']);
  }

  public function getCarType(): string
  {
    return __('custom.car_types.' . $this->attributes['car_type']);
  }

  public function getStatus()
  {
    return config('driver.statuses.' . $this->attributes['status']);
  }

  public function getStatusBadgeType()
  {
    return config('driver.status_badge_colors.' . $this->attributes['status']);
  }

  public function deleteFiles(): void
  {
    Storage::delete($this->attributes['license_image']);
    Storage::delete($this->attributes['driver_image']);
  }

  public static function getFormInputs(Request $request): array
  {
    return [
      'company_id' => $request->input('company_id'),
      'car_type' => $request->input('car_type'),
      'gender' => $request->input('gender'),
      'name' => $request->input('name'),
      'mobile' => $request->input('mobile'),
      'national_code' => $request->input('national_code'),
      'address' => $request->input('address'),
      'car_model' => $request->input('car_model'),
      'car_color' => $request->input('car_color'),
      'car_name' => $request->input('car_name'),
      'plaque' => $request->input('plaque'),
      'license_expiration_date' => $request->input('license_expiration_date'),
      'bank_name' => $request->input('bank_name'),
      'account_number' => $request->input('account_number'),
      'sheba_number' => $request->input('sheba_number'),
      'card_number' => $request->input('card_number')
    ];
  }

  // Relations
  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
