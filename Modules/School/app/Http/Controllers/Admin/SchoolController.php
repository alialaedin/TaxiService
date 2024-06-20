<?php

namespace Modules\School\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Modules\Area\Models\Province;
use Modules\EducationLevel\Models\EducationLevel;
use Modules\School\Http\Requests\Admin\SchoolStoreRequest;
use Modules\School\Models\School;
use Modules\SchoolType\Models\SchoolType;
use Modules\Shift\Models\Shift;

class SchoolController extends Controller
{
  public function index(): View
  {
    $shiftId = request('shift_id');
    $title= request('title');
    $status = request('status');
    $isTraffic = request('is_traffic');

    $schools = School::query()
      ->select(['id', 'shift_id', 'school_type_id', 'title', 'telephone', 'status', 'is_traffic', 'created_at'])
      ->when($shiftId, fn(Builder $query) => $query->where('shift_id', '=', $shiftId))
      ->when($title, fn(Builder $query) => $query->where('title', 'like', "%$title%"))
      ->when(isset($status), fn(Builder $query) => $query->where('status', '=', $status))
      ->when(isset($isTraffic), fn(Builder $query) => $query->where('is_traffic', '=', $isTraffic))
      ->with([
        'shift' => fn($query) => $query->select('id', 'title'),
        'schoolType' => fn($query) => $query->select('id', 'title'),
        'city' => fn($query) => $query->select('id', 'name'),
      ])
      ->latest('id')
      ->paginate()
      ->withQueryString();

    $totalSchools = $schools->total();

    return view('school::index', compact(['schools', 'totalSchools']));
  }

  public function show(School $company): View
  {
    $company->load([
      'city' => fn($query) => $query->select('id', 'name', 'province_id'),
      'city.province' => fn($query) => $query->select('id', 'name')
    ]);

    return view('school::show', compact('company'));
  }

  public function create(): View
  {
    $provinces = Province::getAllProvincesWithCities();
    $educationLevels = EducationLevel::getAllEducationLevels();
    $shifts = Shift::getAllShifts();
    $schoolTypes = SchoolType::getAllSchoolTypes();

    return view('school::create', compact(['provinces', 'educationLevels', 'shifts', 'schoolTypes']));
  }

  public function store(SchoolStoreRequest $request): RedirectResponse
  {
    $inputs = Company::getFormInputs($request);

    $inputs['password'] = bcrypt($request->input('password'));

    if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
      $inputs['logo'] = $request->file('logo')->store('company/logos', 'public');
    }
    if ($request->hasFile('resume') && $request->file('resume')->isValid()) {
      $inputs['resume'] = $request->file('resume')->store('company/resumes', 'public');
    }

    Company::query()->create($inputs);

    return to_route('admin.companies.index');
  }

  public function edit(Company $company): View
  {
    $provinces = Province::getAllProvincesWithCities();

    return view('school::edit', compact(['company', 'provinces']));
  }

  public function update(CompanyUpdateRequest $request, Company $company): RedirectResponse
  {
    $inputs = Company::getFormInputs($request);

    if ($request->filled("password") && Hash::check($request->input('password'), $company->password)) {
      $inputs['password'] = Hash::make($request->input('password'));
    }
    if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
      Storage::delete($company->logo);
      $inputs['logo'] = $request->file('logo')->store('company/logos', 'public');
    }
    if ($request->hasFile('resume') && $request->file('resume')->isValid()) {
      Storage::delete($company->resume);
      $inputs['resume'] = $request->file('resume')->store('company/resumes', 'public');
    }

    Company::query()->update($inputs);

    return to_route('admin.companies.index');
  }

  public function destroy(Company $company): RedirectResponse
  {
    $company->deleteFiles();
    $company->delete();

    return to_route('admin.companies.index');
  }

}
