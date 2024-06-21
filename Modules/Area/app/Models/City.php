<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Company\Models\Company;
use Modules\Core\Models\BaseModel;
use Modules\School\Models\School;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class City extends BaseModel
{
  use LogsActivity;

  protected $fillable = ['province_id', 'name', 'status'];

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logOnly($this->fillable)
      ->setDescriptionForEvent(fn (string $eventName) => 'شهر ' . __('logs.events' . $eventName));
  }

  public static function clearAllCaches(): void
  {
    if (Cache::has('all_cities')) {
      Cache::forget('all_cities');
    }
  }

  public static function clearCitiesCacheByProvince(int $provinceId): void
  {
    if (Cache::has('cities_' . $provinceId)) {
      Cache::forget('cities_' . $provinceId);
    }
  }

  protected static function booted(): void
  {
    static::saved(fn(City $city) => $city->clearAllCaches());
    static::deleted(fn(City $city) => $city->clearAllCaches());
  }

  public static function getAllCities(): Collection
  {
    return Cache::rememberForever('all_cities', function () {
      return City::query()
        ->where('status', 1)
        ->get(['id', 'name', 'province_id']);
    });
  }

  // Relation
  public function company(): HasMany
  {
    return $this->hasMany(Company::class);
  }

  public function province(): BelongsTo
  {
    return $this->belongsTo(Province::class);
  }

  public function schools(): HasMany
  {
    return $this->hasMany(School::class);
  }
}
