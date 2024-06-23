<?php

namespace Modules\Family\Models;

use Modules\Core\Exceptions\ModelCannotBeDeletedException;
use Modules\Core\Models\BaseAuthModel;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Family extends BaseAuthModel
{
  use LogsActivity;

  const TOKEN_DIGITS = 4;

  /**
   * The attributes that are mass assignable.
   */
  protected $fillable = [
    'name',
    'mobile',
    'email'
  ];

  public function getActivitylogOptions(): LogOptions
  {
    return LogOptions::defaults()
      ->logAll()
      ->setDescriptionForEvent(function (string $eventName) {
        return "خانواده با شناسه عددی $this->id با نام $this->name " . config('core.events.' . $eventName);
      });
  }

  protected static function booted(): void
  {
    static::deleting(function(Family $family) {
      if (!$family->isDeletable()) {
        throw new ModelCannotBeDeletedException('خانواده قابل حذف نمی باشد!');
      }
    });
  }

  public function isDeletable(): bool
  {
    return true;
  }
}
