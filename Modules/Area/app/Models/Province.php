<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use Modules\Core\Exceptions\ModelCannotBeDeletedException;
use Modules\Core\Models\BaseModel;

class Province extends BaseModel
{
  protected $fillable = ['name', 'status'];

  public function clearAllCaches(): void
  {
    if (Cache::has('provinces')) {
      Cache::forget('provinces');
    }

    if (Cache::has('all_provinces')) {
      Cache::forget('all_provinces');
    }
    if (Cache::has('all_provinces_with_cities')) {
      Cache::forget('all_provinces_with_cities');
    }
  }

  public static function booted(): void
  {
    static::deleting(function (Province $province) {
      if ($province->cities()->exists()) {
        throw new ModelCannotBeDeletedException('این استان دارای شهر است و قابل حذف نمی باشد.');
      }
    });

    static::saved(fn(Province $province) => $province->clearAllCaches());
    static::deleted(fn(Province $province) => $province->clearAllCaches());

  }

  public static function getAllProvinces(): Collection
  {
    return Cache::rememberForever('provinces', function () {
      return Province::query()
        ->where('status', 1)
        ->pluck('name', 'id');
    });
  }

  public static function getAllProvincesWithCities(): Collection|array
  {
    return Province::query()
      ->where('status', 1)
      ->select('id', 'name')
      ->with('cities')
      ->get();
  }

  public function cities(): HasMany
  {
    return $this->hasMany(City::class);
  }

}
