<?php

namespace Modules\School\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Area\Models\City;
use Modules\Core\Models\BaseModel;
use Modules\EducationLevel\Models\EducationLevel;
use Modules\SchoolType\Models\SchoolType;
use Modules\Shift\Models\Shift;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class School extends BaseModel
{
  use LogsActivity;

  protected $fillable = [
    'shift_id',
    'education_level_id',
    'school_type_id',
    'city_id',
    'title',
    'telephone',
    'manager_name',
    'manager_mobile',
    'status',
    'address',
    'map',
    'is_traffic'
  ];

  public const TRAFFIC_BADGE_TYPES = [
    '0' => 'danger',
    '1' => 'success'
  ];

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logAll()
      ->setDescriptionForEvent(function (string $eventName) {
        return "مدرسه با شناسه عددی $this->id با عنوان $this->title را " . config('core.events.' . $eventName);
      });
  }

  protected static function booted(): void
  {
    static::created(fn() => flash()->success('مدرسه جدید با موفقیت ساخته شد.'));
    static::updated(fn() => flash()->success('مدرسه با موفقیت بروزرسانی شد.'));
    static::deleted(fn() => flash()->success('مدرسه با موفقیت حذف شد.'));
  }

  // Functions
  public function getStatusBadgeType(): string
  {
    return config('core.badge_types.' . $this->attributes['status']);
  }

  public function getStatus(): string
  {
    return config('core.bool_statuses.' . $this->attributes['status']);
  }

  public function getTrafficTitle(): string
  {
    return $this->attributes['is_traffic'] ? 'هست' : 'نیست';
  }

  public function getTrafficBadgeType(): string
  {
    return static::TRAFFIC_BADGE_TYPES[$this->attributes['is_traffic']];
  }

  // Relations
  public function shift(): BelongsTo
  {
    return $this->belongsTo(Shift::class);
  }

  public function schoolType(): BelongsTo
  {
    return $this->belongsTo(SchoolType::class);
  }

  public function educationLevel(): BelongsTo
  {
    return $this->belongsTo(EducationLevel::class);
  }

  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class, 'city_id');
  }
}
