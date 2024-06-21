<?php

namespace Modules\EducationLevel\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\BaseModel;
use Modules\School\Models\School;

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

  public static function getAllEducationLevels(): Collection|array
  {
    return EducationLevel::query()
      ->where('status', '=', 1)
      ->select('id', 'title', 'gender')
      ->get();
  }

  // Relations
  public function schools(): HasMany
  {
    return $this->hasMany(School::class);
  }
}
