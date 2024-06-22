<?php

namespace Modules\School\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Exceptions\ModelCannotBeDeletedException;
use Modules\Core\Models\BaseModel;

class SchoolType extends BaseModel
{
  protected $fillable = ['title', 'status'];

  protected const BADGE_TYPE = [
    '1' => 'success',
    '0' => 'danger'
  ];

  protected static function booted(): void
  {
    static::created(fn () => toastr()->success('نوع مدرسه جدید با موفقیت ساخته شد.'));
    static::updated(fn () => toastr()->success('نوع مدرسه با موفقیت بروزرسانی شد.'));
    static::deleted(fn () => toastr()->success('نوع مدرسه با موفقیت حذف شد.'));
    static::deleting(function (SchoolType $schoolType) {
      if (!$schoolType->isDeletable()) {
        throw new ModelCannotBeDeletedException('نوع مدرسه دارای مدرسه ای است و قابل حذف نمی باشد.');
      }
    });
  }

  // Functions
  public function isDeletable(): bool
  {
    return $this->schools->isEmpty();
  }

  public function getSchoolTypeStatus(): string
  {
    return $this->attributes['status'] ? 'فعال' : 'غیر فعال';
  }

  public static function getAllSchoolTypes(): Collection|array
  {
    return SchoolType::query()
      ->where('status', '=', 1)
      ->select('id', 'title')
      ->get();
  }

  public function getStatusBadgeType(): string
  {
    return static::BADGE_TYPE[$this->attributes['status']];
  }
  // Relations
  public function schools(): HasMany
  {
    return $this->hasMany(School::class);
  }

}
