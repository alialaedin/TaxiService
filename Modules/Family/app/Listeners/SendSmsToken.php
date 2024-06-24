<?php

namespace Modules\Family\Listeners;

use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Modules\Core\Helpers\Helpers;
use Modules\Family\Events\SmsVerify;
use Modules\Family\Models\Family;
use Modules\Sms\Sms;

class SendSmsToken
{
  /**
   * Create the event listener.
   */
  public function __construct()
  {
    //
  }

  public function handle(SmsVerify $event): Sms|array
  {
    $pattern = config('services.sms.patterns.verification_code');
    $token = Helpers::randomNumbersCode(Family::TOKEN_DIGITS);
    $mobile = $event->mobile;

    if (App::isProduction()) {
      $output = Sms::pattern($pattern)
        ->data([
          'code' => $token
        ])
        ->to([$mobile])
        ->send();
    } else {
      $output['status'] = 200;
      $token = '1234';
    }


    if ($output['status'] == 200) { //success
      //store into database
      $smsToken = DB::table('sms_tokens')->where('mobile', $mobile)->first();
      if ($smsToken) {
        if (Carbon::now()->gt($smsToken->expired_at)) {
          DB::table('sms_tokens')
            ->where('mobile', $mobile)
            ->update([
              'token' => $token,
              'expired_at' => Carbon::now()->addMinutes(2),
              'updated_at' => now()
            ]);
        }
      } else {
        DB::table('sms_tokens')
          ->insert([
            'mobile' => $event->mobile,
            'token' => $token,
            'expired_at' => Carbon::now()->addMinutes(2),
            'created_at' => now(),
            'updated_at' => now()
          ]);
      }
    }

    return $output;
  }

}
