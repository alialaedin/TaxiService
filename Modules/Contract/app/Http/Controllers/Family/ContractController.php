<?php

namespace Modules\Contract\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Contract\Models\Contract;
use Modules\School\Models\EducationLevel;
use Modules\School\Models\SchoolType;
use Modules\Setting\Models\Setting;

class ContractController extends Controller
{
  public function create(): View
  {
    $setting = Setting::query()->where('name', 'rules_text')->first();

    $rulesAndConditions = $setting->value;
    $genders = Contract::getAllGenders();
    $schoolTypes = SchoolType::getAllSchoolTypes();
    $educationLevels = EducationLevel::getActiveEducationLevels();

    return view('contract::family.create', compact([
      'rulesAndConditions',
      'genders',
      'schoolTypes',
      'educationLevels'
    ]));
  }

}
