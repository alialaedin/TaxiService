<?php

namespace Modules\Sms\Exceptions;

class ApiException extends BaseRuntimeException
{
  public function getName(): string
  {
    return 'ApiException';
  }
}

