<?php

namespace Modules\SchoolType\Models;


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
  }

  // Functions
  public function getSchoolTypeStatus(): string
  {
    return $this->attributes['status'] ? 'فعال' : 'غیر فعال';
  }

  public function getStatusBadgeType(): string
  {
    return static::BADGE_TYPE[$this->attributes['status']];
  }
}
