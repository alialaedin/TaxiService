<?php

namespace Modules\School\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Exceptions\ModelCannotBeDeletedException;
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
    static::deleting(function (EducationLevel $educationLevel) {
      if (!$educationLevel->isDeletable()) {
        throw new ModelCannotBeDeletedException('نوع مدرسه دارای مدرسه ای است و قابل حذف نمی باشد.');
      }
    });
  }

  // Functions
  public function isDeletable(): bool
  {
    return $this->schools->isEmpty();
  }

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

  public static function getActiveEducationLevels(): Collection|array
  {
    return EducationLevel::query()
      ->active()
      ->select('id', 'title', 'gender')
      ->get();
  }

  // Relations
  public function schools(): HasMany
  {
    return $this->hasMany(School::class);
  }
}
