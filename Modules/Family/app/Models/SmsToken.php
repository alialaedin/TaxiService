<?php

namespace Modules\Family\Models;

use Modules\Core\Models\BaseModel;

class SmsToken extends BaseModel
{
  protected $fillable = [
    'mobile', 'token', 'expired_at', 'verified_at'
  ];

}
