<?php

namespace Modules\Setting\Models;

use Illuminate\Support\Facades\Cache;
use Modules\Core\Models\BaseModel;

class Setting extends BaseModel
{
  protected $fillable = [
    'label', 'name', 'group', 'type', 'value'
  ];

  const GROUP_DISTANCE_RATE = 'نرخ مسافت';
  const GROUP_ORGANIZATION_ACCOUNT = 'حساب سازمان';
  const GROUP_SHETAB_ACCOUNT = 'حساب شتاب';
  const GROUP_COST_ADJUSTMENT = 'تنظیم هزینه';
  const GROUP_TERMS_AND_CONDITIONS = 'قوانین و مقررات';
  const TYPE_TEXT = 'text';
  const TYPE_NUMBER = 'number';
  const TYPE_TEXTAREA = 'textarea';


  public static function booted(): void
  {
    static::clearAllCaches();
  }

  protected static function clearAllCaches(): void
  {
    if(Cache::has('settings')){
      Cache::forget('setting');
    }
  }
}
