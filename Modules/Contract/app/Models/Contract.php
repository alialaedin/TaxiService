<?php

namespace Modules\Contract\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Company\Models\Company;
use Modules\Core\Models\BaseModel;
use Modules\Family\Models\Family;
use Modules\School\Models\EducationLevel;
use Modules\School\Models\School;
use Modules\School\Models\SchoolType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Contract extends BaseModel
{
  use LogsActivity;

  const GENDER_FEMALE = 'female';
  const GENDER_MALE = 'male';

  const SERVICE_PRIVATE = 'private';
  const SERVICE_PUBLIC = 'public';


  const STATUS_PENDING = 'pending';
  const STATUS_NEW = 'new';
  const STATUS_WITHDRAWN = 'withdrawn';
  const STATUS_TRANSFERRED = 'transferred';
  const STATUS_ACCEPTED = 'accepted';
  const STATUS_CANCELED = 'canceled';
  const STATUS_REJECTED = 'rejected';


  protected $fillable = [
    'company_id',
    'family_id',
    'school_type_id',
    'education_level_id',
    'school_id',
    'rules',
    'gender',
    'service_type',
    'address',
    'latitude',
    'longitude',
    'start_date',
    'end_date',
    'status'
  ];

  // Log Activity
  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logAll()
      ->setDescriptionForEvent(function (string $eventName) {
        return "قرارداد " . config('core.events.' . $eventName);
      });
  }

  // Static Functions
  public static function getAllGenders(): array
  {
    return [
      self::GENDER_MALE,
      self::GENDER_FEMALE
    ];
  }

  public static function getAllServices(): array
  {
    return [
      self::SERVICE_PRIVATE,
      self::SERVICE_PUBLIC
    ];
  }

  public static function getAllStatuses(): array
  {
    return [
      self::STATUS_NEW,
      self::STATUS_TRANSFERRED,
      self::STATUS_WITHDRAWN,
      self::STATUS_ACCEPTED,
      self::STATUS_PENDING,
      self::STATUS_REJECTED,
      self::STATUS_CANCELED
    ];
  }


  // Relations
  public function family(): BelongsTo
  {
    return $this->belongsTo(Family::class);
  }

  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }

  public function educationLevel(): BelongsTo
  {
    return $this->belongsTo(EducationLevel::class);
  }

  public function schoolType(): BelongsTo
  {
    return $this->belongsTo(SchoolType::class);
  }

  public function school(): BelongsTo
  {
    return $this->belongsTo(School::class);
  }

}
