<?php

namespace Modules\Setting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Modules\Setting\Models\Setting;

class SettingDatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $rows = Config::get('setting.rows');

    foreach ($rows as $row) {
      Setting::query()->firstOrCreate(
        [
          'name' => $row['name']
        ],
        [
          'label' => $row['label'],
          'type' => $row['type'],
          'value' => $row['value'],
          'group' => $row['group']
        ]
      );
    }

  }
}
