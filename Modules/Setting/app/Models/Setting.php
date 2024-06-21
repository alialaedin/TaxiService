<?php

namespace Modules\Setting\Models;

use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\BaseModel;

class Setting extends BaseModel
{
  protected $fillable = [
    'label',
    'name',
    'group_label',
    'type',
    'unit_type',
    'value'
  ];

  protected const UNIT_TYPE = [
    'number' => 'تومان',
    'percent' => 'درصد'
  ];

  protected static function booted(): void
  {
    static::updated(fn (Setting $setting) => $setting->clearAllCaches());
    static::deleted(fn (Setting $setting) => $setting->clearAllCaches());
  }

  protected function clearAllCaches(): void
  {
    if(Cache::has('settings')){
      Cache::forget('setting');
    }
  }

  public function getUnitType(): string
  {
    return static::UNIT_TYPE[$this->attributes['unit_type']];
  }

}
