<?php

return [
  'name' => 'Core',

  'super_admin_role' => [
    'name' => 'super_admin',
    'label' => 'مدیر ارشد',
  ],

  'events' => [
    'created' => 'ایجاد شد',
    'updated' => 'ویرایش شد',
    'deleted' => 'حذف شد'
  ],

  'payment_types' => [
    'cash' => 'نقد',
    'installment' => 'قسط',
    'cheque' => 'چک',
  ],

  'headline_types' => [
    'revenue' => 'درامد',
    'expense' => 'هزینه'
  ],

  'accept_image_mimes' => [
    'png',
    'jpg'
  ],

  'category_unit_types' => [
    'meter' => 'متر',
    'number' => 'عدد'
  ],

  'bool_statuses' => [
    '1' => 'فعال',
    '0' => 'غیر فعال'
  ],

  'genders' => [
    'male' => 'مرد',
    'female' => 'زن'
  ],

  'badge_types' => [
    '0' => 'danger',
    '1' => 'success'
  ]
];
