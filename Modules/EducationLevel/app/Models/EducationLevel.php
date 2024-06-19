<?php

namespace Modules\EducationLevel\Models;

use Modules\Core\Models\BaseModel;

class EducationLevel extends BaseModel
{
  protected $fillable = [
    'title',
    'gender',
    'status'
  ];
  protected const BADGE_TYPES = [
    '1' => 'success',
    '0' => 'danger'
  ];
  public const GENDERS = [
    'male' => 'مرد',
    'female' => 'زن'
  ];

  protected static function booted(): void
  {
    static::created(fn () => toastr()->success('مقطع تحصیلی جدید با موفقیت ساخته شد.'));
    static::updated(fn () => toastr()->success('مقطع تحصیلی با موفقیت بروزرسانی شد.'));
    static::deleted(fn () => toastr()->success('مقطع تحصیلی با موفقیت حذف شد.'));
  }

  // Functions
  public function getStatus(): string
  {
    return $this->attributes['status'] ? 'فعال' : 'غیر فعال';
  }

  public function getStatusBadgeType(): string
  {
    return static::BADGE_TYPES[$this->attributes['status']];
  }

  public function getGender(): string
  {
    return static::GENDERS[$this->attributes['gender']];
  }
}
