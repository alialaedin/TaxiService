<?php

namespace Modules\School\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Modules\Area\Models\City;
use Modules\Area\Models\Province;
use Modules\School\Models\EducationLevel;
use Modules\School\Http\Requests\Admin\School\SchoolStoreRequest;
use Modules\School\Http\Requests\Admin\School\SchoolUpdateRequest;
use Modules\School\Models\School;
use Modules\School\Models\SchoolType;
use Modules\School\Models\Shift;

class SchoolController extends Controller
{
  public function index(): View
  {
    $shiftId = request('shift_id');
    $cityId = request('city_id');
    $educationLevelId = request('education_level_id');
    $schoolTypeId = request('school_type_id');
    $telephone = request('telephone');
    $title= request('title');
    $status = request('status');
    $isTraffic = request('is_traffic');

    $schools = School::query()
      ->select(['id', 'shift_id', 'education_level_id', 'school_type_id', 'city_id', 'title', 'telephone', 'status', 'is_traffic'])
      ->when($shiftId, fn(Builder $query) => $query->where('shift_id', '=', $shiftId))
      ->when($cityId, fn(Builder $query) => $query->where('city_id', '=', $cityId))
      ->when($educationLevelId, fn(Builder $query) => $query->where('education_level_id', '=', $educationLevelId))
      ->when($schoolTypeId, fn(Builder $query) => $query->where('school_type_id', '=', $schoolTypeId))
      ->when($telephone, fn(Builder $query) => $query->where('telephone', '=', $telephone))
      ->when($title, fn(Builder $query) => $query->where('title', 'like', "%$title%"))
      ->when(isset($status), fn(Builder $query) => $query->where('status', '=', $status))
      ->when(isset($isTraffic), fn(Builder $query) => $query->where('is_traffic', '=', $isTraffic))
      ->with([
        'shift:id,title',
        'schoolType:id,title',
        'educationLevel:id,title,gender',
        'city:id,name'
      ])
      ->latest('id')
      ->paginate()
      ->withQueryString();

    $totalSchools = $schools->total();

    $shifts = Shift::getAllShifts();
    $schoolTypes = SchoolType::getAllSchoolTypes();
    $educationLevels = EducationLevel::getActiveEducationLevels();

    return view('school::school.index', compact([
      'schools',
      'totalSchools',
      'shifts',
      'schoolTypes',
      'educationLevels',
    ]));
  }

  public function show(School $school): View
  {
    $school->load([
      'shift:id,title',
      'schoolType:id,title',
      'educationLevel:id,title,gender',
      'city:id,name,province_id',
      'city.province:id,name'
    ]);

    return view('school::school.show', compact('school'));
  }

  public function create(): View
  {
    $provinces = Province::getAllProvincesWithCities();
    $educationLevels = EducationLevel::getActiveEducationLevels();
    $shifts = Shift::getAllShifts();
    $schoolTypes = SchoolType::getAllSchoolTypes();

    return view('school::school.create', compact(['provinces', 'educationLevels', 'shifts', 'schoolTypes']));
  }

  public function store(SchoolStoreRequest $request): RedirectResponse
  {
    School::query()->create($request->validated());

    return to_route('admin.schools.index');
  }

  public function edit(School $school): View
  {
    $provinces = Province::getAllProvincesWithCities();
    $educationLevels = EducationLevel::getActiveEducationLevels();
    $shifts = Shift::getAllShifts();
    $schoolTypes = SchoolType::getAllSchoolTypes();

    return view('school::school.edit', compact(['school', 'provinces', 'educationLevels', 'shifts', 'schoolTypes']));
  }

  public function update(SchoolUpdateRequest $request, School $school): RedirectResponse
  {
    $school->update($request->validated());

    return to_route('admin.schools.index');
  }

  public function destroy(School $school): RedirectResponse
  {
    $school->delete();

    return to_route('admin.schools.index');
  }

}
