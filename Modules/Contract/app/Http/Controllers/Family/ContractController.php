<?php

namespace Modules\Contract\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Company\Models\Company;
use Modules\Contract\Models\Contract;
use Modules\School\Models\EducationLevel;
use Modules\School\Models\School;
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

  public function loadEducationLevels(Request $request): JsonResponse
  {
    $educationLevels = EducationLevel::query()
      ->select('id', 'title', 'gender')
      ->where('status', 1)
      ->where('gender', $request->input('gender'))
      ->get();

    return response()->json($educationLevels);
  }

  public function loadSchools(Request $request): JsonResponse
  {
    $schools = School::query()
      ->select('id', 'title', 'school_type_id', 'education_level_id', 'shift_id')
      ->where('status', 1)
      ->where('school_type_id', '=', $request->input('school_type'))
      ->where('education_level_id', '=', $request->input('education_level'))
      ->get();

    return response()->json($schools);
  }

  public function loadCompanies(Request $request): JsonResponse
  {
    $companies = Company::query()
      ->select()
      ->where('status', 1)
      ->whereHas('schools', fn ($query) => $query->where('schools.id', '=', $request->input('school_id')))
      ->get();

    return response()->json($companies);
  }

}
