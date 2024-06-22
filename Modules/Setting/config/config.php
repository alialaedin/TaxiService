<?php

use Modules\Setting\Models\Setting;

// Groups
$groupDistanceRate = Setting::GROUP_DISTANCE_RATE;
$groupOrganizationAccount = Setting::GROUP_ORGANIZATION_ACCOUNT;
$groupShetabAccount = Setting::GROUP_SHETAB_ACCOUNT;
$groupCostAdjustment = Setting::GROUP_COST_ADJUSTMENT;
$groupTermsAndConditions = Setting::GROUP_TERMS_AND_CONDITIONS;

// Types
$typeNumber = Setting::TYPE_NUMBER;
$typeText = Setting::TYPE_TEXT;
$typeTextarea = Setting::TYPE_TEXTAREA;


return [
  'name' => 'Setting',

  'rows' => [
    [
      'group' => $groupDistanceRate,
      'name' => 'price_base',
      'label' => 'نرخ 10 کیلومتر رفت و برگشت (تومان)',
      'type' => $typeNumber,
      'value' => '1000000',
      'rules' => 'nullable|integer|min:1000'
    ],
    [
      'group' => $groupDistanceRate,
      'name' => 'price_extra',
      'label' => 'نرخ 10 کیلومتر به بالا به ازای هر کیلومتر اضافه (درصد)',
      'type' => $typeNumber,
      'value' => '5',
      'rules' => 'nullable|integer|between:1,100'
    ],
    [
      'group' => $groupDistanceRate,
      'name' => 'price_traffic',
      'label' => 'نرخ ترافیکی (درصد)',
      'type' => $typeNumber,
      'value' => '5',
      'rules' => 'nullable|integer|between:1,100'
    ],
    //bank info
    [
      'group' => $groupOrganizationAccount,
      'name' => 'account_number_organization',
      'label' => 'شماره حساب سازمان',
      'type' => $typeText,
      'value' => '',
      'rules' => 'nullable|numeric|max:50'
    ],
    [
      'group' => $groupOrganizationAccount,
      'name' => 'card_number_organization',
      'label' => 'شماره کارت سازمان',
      'type' => $typeText,
      'value' => '',
      'rules' => 'nullable|numeric|max:50'
    ],
    [
      'group' => $groupOrganizationAccount,
      'name' => 'sheba_number_organization',
      'label' => 'شماره شبا سازمان',
      'type' => $typeText,
      'value' => '',
      'rules' => 'nullable|string|max:100'
    ],
    [
      'group' => $groupShetabAccount,
      'name' => 'account_number_shetab',
      'label' => 'شماره حساب شتاب',
      'type' => $typeText,
      'value' => '',
      'rules' => 'nullable|numeric|max:50'
    ],
    [
      'group' => $groupShetabAccount,
      'name' => 'card_number_shetab',
      'label' => 'شماره کارت شتاب',
      'type' => $typeText,
      'value' => '',
      'rules' => 'nullable|numeric|max:50'
    ],
    [
      'group' => $groupShetabAccount,
      'name' => 'sheba_number_shetab',
      'label' => 'شماره شبا شتاب',
      'type' => $typeText,
      'value' => '',
      'rules' => 'nullable|string|max:50'
    ],
    //quota
    [
      'group' => $groupCostAdjustment,
      'name' => 'organization_quota',
      'label' => 'سهم سازمان (درصد)',
      'type' => $typeNumber,
      'value' => '2',
      'rules' => 'nullable|integer|between:1,100'
    ],
    [
      'group' => $groupCostAdjustment,
      'name' => 'shetab_quota',
      'label' => 'سهم شتاب (درصد)',
      'type' => $typeNumber,
      'value' => '1',
      'rules' => 'nullable|integer|between:1,100'
    ],
    [
      'group' => $groupCostAdjustment,
      'name' => 'agency_quota',
      'label' => 'سهم شرکت سرویس مدارس (درصد)',
      'type' => $typeNumber,
      'value' => '50',
      'rules' => 'nullable|integer|between:1,100'
    ],
    [
      'group' => $groupCostAdjustment,
      'name' => 'driver_quota',
      'label' => 'سهم راننده (درصد)',
      'type' => $typeNumber,
      'value' => '47', //remaining: 100 - (agency_quota + shetab_quota + organization_quota)
      'rules' => 'nullable|integer|between:1,100'
    ],
    [
      'group' => $groupTermsAndConditions,
      'name' => 'rules_text',
      'label' => 'متن قوانین و مقررات',
      'type' => $typeTextarea,
      'value' => '',
      'rules' => 'nullable|string|max:65000000'
    ],

  ]
];
