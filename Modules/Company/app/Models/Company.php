<?php

namespace Modules\Company\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

  protected function casts(): array
  {
    return [
      'password' => 'hashed',
    ];
  }

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logAll()
      ->setDescriptionForEvent(function (string $eventName) {
        return "شرکت با شناسه عددی $this->id با نام $this->name را " . config('core.events.' . $eventName);
      });
  }


  // Relations
  public function city(): BelongsTo
  {
    return $this->belongsTo(City::class);
  }

}
