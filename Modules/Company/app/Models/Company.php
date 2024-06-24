<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Modules\Area\Models\City;
use Modules\Core\Models\BaseAuthModel;
use Modules\Core\Models\BaseModelTrait;
use Modules\School\Models\School;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends BaseAuthModel
{
  use LogsActivity, BaseModelTrait;

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
    static::created(fn() => toastr()->success('شرکت جدید با موفقیت ساخته شد.'));
    static::updated(fn() => toastr()->success('شرکت با موفقیت بروزرسانی شد.'));
    static::deleted(fn() => toastr()->success('شرکت جدید با موفقیت حذف شد.'));
    static::deleting(function(Company $company) {
      $company->deleteFile();
    });
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
      'resume' => $request->input('resume'),
    ];
  }

  public function deleteFile(): void
  {
    Storage::delete($this->attributes['logo']);
  }

  public static function getActiveCompanies(): Collection
  {
    return Company::query()
      ->active()
      ->select('id', 'title')
      ->get();
  }

  // Relations
  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class);
  }

  public function schools(): BelongsToMany
  {
    return $this->belongsToMany(School::class);
  }
}
