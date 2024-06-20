<?php

namespace Modules\SchoolType\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\BaseModel;
use Modules\School\Models\School;

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
  }

  // Functions
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
