<?php

use Modules\Driver\Models\Driver;

$statusPending = Driver::STATUS_PENDING;
$statusConfirmed = Driver::STATUS_CONFIRMED;
$statusRejected = Driver::STATUS_REJECTED;

$genderMale = Driver::GENDER_MALE;
$genderFemale = Driver::GENDER_FEMALE;

return [
  'name' => 'Driver',

  'statuses' => [
    $statusPending => 'در حال بررسی',
    $statusConfirmed => 'تایید شده',
    $statusRejected => 'رد شده',
  ],

  'status_badge_colors' => [
    $statusPending => 'warning',
    $statusConfirmed => 'success',
    $statusRejected => 'danger',
  ],

  'genders' => [
    $genderMale => 'مرد',
    $genderFemale => 'زن',
  ]
];
