<?php

use Modules\Contract\Models\Contract;

$genderMale = Contract::GENDER_MALE;
$genderFemale = Contract::GENDER_FEMALE;

return [
  'name' => 'Contract',

  'genders' => [
    $genderMale => 'پسر',
    $genderFemale => 'دختر'
  ]
];
