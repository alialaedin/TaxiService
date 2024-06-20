<?php

namespace Modules\Shift\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\Models\BaseModel;
use Modules\School\Models\School;

class Shift extends BaseModel
{
	protected $fillable = ['title', 'status'];

	protected const BADGE_TYPE = [
		'1' => 'success',
		'0' => 'danger'
	];

	protected static function booted(): void
	{
		static::created(fn () => toastr()->success('شیفت جدید با موفقیت ساخته شد.'));
		static::updated(fn () => toastr()->success('شیفت با موفقیت بروزرسانی شد.'));
		static::deleted(fn () => toastr()->success('شیفت با موفقیت حذف شد.'));
	}

	// Functions
	public function getShiftStatus(): string
	{
		return $this->attributes['status'] ? 'فعال' : 'غیر فعال';
	}

	public function getStatusBadgeType(): string
	{
		return static::BADGE_TYPE[$this->attributes['status']];
	}

  public static function getAllShifts(): Collection|array
  {
    return Shift::query()
      ->where('status', '=', 1)
      ->select('id', 'title')
      ->get();
  }

  // Relations
  public function schools(): HasMany
  {
    return $this->hasMany(School::class);
  }
}
