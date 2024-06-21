<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Models\Setting;

class SettingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $settings = [
        [
          'group_label' => 'نرخ مسافت',
          'name' => '10_km_round_trip',
          'label' => '10 کیلومتر رفت و امد',
          'type' => 'number',
          'unit_type' => 'number',
          'value' => 1000000,
        ],
        [
          'group_label' => 'نرخ مسافت',
          'name' => '10_km_and_above_for_each_additional_km',
          'label' => '10 کیلومتر به بالا به ازای هر کیلومتر اضافه',
          'type' => 'number',
          'unit_type' => 'percent',
          'value' => 5,
        ],
        [
          'group_label' => 'نرخ مسافت',
          'name' => 'traffic_rate',
          'label' => 'نرخ ترافیکی',
          'type' => 'number',
          'unit_type' => 'percent',
          'value' => 5,
        ],
        [
          'group_label' => 'حساب سازمان',
          'name' => 'organization_account_number',
          'label' => 'شماره حساب',
          'type' => 'text',
          'unit_type' => null,
          'value' => '123649563587963154',
        ],
        [
          'group_label' => 'حساب سازمان',
          'name' => 'organization_card_number',
          'label' => 'شماره کارت',
          'type' => 'text',
          'unit_type' => null,
          'value' => '6104335654986535',
        ],
        [
          'group_label' => 'حساب سازمان',
          'name' => 'organization_sheba_number',
          'label' => 'شماره شبا',
          'type' => 'text',
          'unit_type' => null,
          'value' => '0000003465975601023501',
        ],
        [
          'group_label' => 'حساب شتاب',
          'name' => 'shetab_account_number',
          'label' => 'شماره حساب',
          'type' => 'text',
          'unit_type' => null,
          'value' => '123649563587963154',
        ],
        [
          'group_label' => 'حساب شتاب',
          'name' => 'shetab_card_number',
          'label' => 'شماره کارت',
          'type' => 'text',
          'unit_type' => null,
          'value' => '6104335654986535',
        ],
        [
          'group_label' => 'حساب شتاب',
          'name' => 'shetab_sheba_number',
          'label' => 'شماره شبا',
          'type' => 'text',
          'unit_type' => null,
          'value' => '0000003465975601023501',
        ],
        [
          'group_label' => 'تنظیم هزینه',
          'name' => 'share_of_the_organization',
          'label' => 'سازمان',
          'type' => 'number',
          'unit_type' => 'percent',
          'value' => 1,
        ],
        [
          'group_label' => 'تنظیم هزینه',
          'name' => 'share_of_the_shetab',
          'label' => 'شتاب',
          'type' => 'number',
          'unit_type' => 'percent',
          'value' => 1,
        ],
        [
          'group_label' => 'تنظیم هزینه',
          'name' => 'share_of_the_taxi_company',
          'label' => 'شرکت تاکسیرانی',
          'type' => 'number',
          'unit_type' => 'percent',
          'value' => 1,
        ],
        [
          'group_label' => 'تنظیم هزینه',
          'name' => 'share_of_the_driver',
          'label' => 'راننده',
          'type' => 'number',
          'unit_type' => 'percent',
          'value' => 97,
        ],
        [
          'group_label' => 'قوانین و مقررات',
          'name' => 'rules',
          'label' => 'قوانین',
          'type' => 'textarea',
          'unit_type' => null,
          'value' => 'سلام',
        ],
      ];

      foreach ($settings as $setting) {
        Setting::query()->firstOrCreate(
          ['name' => $setting['name']],
          [
            'group_label' => $setting['group_label'],
            'label' => $setting['label'],
            'type' => $setting['type'],
            'unit_type' => $setting['unit_type'],
            'value' => $setting['value'],
          ]
        );
      }
    }
}
