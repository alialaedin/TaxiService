<?php

namespace Modules\Company\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Modules\Area\Models\City;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Authenticatable
{
  use LogsActivity;

  protected $fillable = [
    'title',
    'name',
    'mobile',
    'telephone',
    'address',
    'logo',
    'status',
    'username',
    'password',
    'account_number',
    'card_number',
    'sheba_number',
    'resume',
    'city_id'
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logAll()
      ->setDescriptionForEvent(function (string $eventName) {
        return "شرکت با شناسه عددی $this->id با نام $this->name را " . config('core.events.' . $eventName);
      });
  }

  protected static function booted(): void
  {
    static::created(fn() => flash()->success('شرکت جدید با موفقیت ساخته شد.'));
    static::updated(fn() => flash()->success('شرکت با موفقیت بروزرسانی شد.'));
    static::deleting(fn(Company $company) => $company->deleteFiles());
    static::deleted(fn() => flash()->success('شرکت با موفقیت حذف شد.'));
  }

  // Functions
  public function getStatusBadgeType()
  {
    return config('core.badge_types.' . $this->attributes['status']);
  }

  public function getStatus()
  {
    return config('core.bool_statuses.' . $this->attributes['status']);
  }

  public static function getFormInputs(Request $request): array
  {
    return [
      'title' => $request->input('title'),
      'name' => $request->input('name'),
      'mobile' => $request->input('mobile'),
      'telephone' => $request->input('telephone'),
      'city_id' => $request->input('city_id'),
      'status' => $request->input('status'),
      'username' => $request->input('username'),
      'account_number' => $request->input('account_number'),
      'card_number' => $request->input('card_number'),
      'sheba_number' => $request->input('sheba_number'),
      'address' => $request->input('address'),
    ];
  }

  public function deleteFiles(): void
  {
    Storage::delete($this->attributes['logo']);
    Storage::delete($this->attributes['resume']);
  }

  // Relations
  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class);
  }
}
