<?php

namespace Modules\Area\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Area\Database\Factories\ProvinceFactory;
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

  public function cities(): HasMany
  {
    return $this->hasMany(City::class);
  }

}
