<?php

namespace Modules\Company\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Area\Models\Province;
use Modules\Company\Http\Requests\Admin\CompanyStoreRequest;
use Modules\Company\Http\Requests\Admin\CompanyUpdateRequest;
use Modules\Company\Models\Company;

class CompanyController extends Controller
{
  public function index(): View
  {
    $title = request('title');
    $name = request('name');
    $mobile = request('mobile');
    $status = request('status');

    $companies = Company::query()
      ->select('id', 'title', 'name', 'mobile', 'city_id', 'status', 'logo', 'created_at')
      ->when($title, fn(Builder $query) => $query->where('title', 'like', "%$title%"))
      ->when($name, fn(Builder $query) => $query->where('name', 'like', "%$name%"))
      ->when($mobile, fn(Builder $query) => $query->where('mobile', '=', $mobile))
      ->when(isset($title), fn(Builder $query) => $query->where('status', '=', $status))
      ->with([
        'city' => fn($query) => $query->select('id', 'name', 'province_id'),
        'city.province' => fn($query) => $query->select('id', 'name')
      ])
      ->latest('id')
      ->paginate()
      ->withQueryString();

    $totalCompanies = $companies->total();

    return view('company::index', compact(['companies', 'totalCompanies']));
  }

  public function show(Company $company): View
  {
    $company->load([
      'city' => fn($query) => $query->select('id', 'name', 'province_id'),
      'city.province' => fn($query) => $query->select('id', 'name')
    ]);

    return view('company::show', compact('company'));
  }

  public function create(): View
  {
    $provinces = Province::getAllProvincesWithCities();

    return view('company::create', compact('provinces'));
  }

  public function store(CompanyStoreRequest $request): RedirectResponse
  {
    $inputs = Company::getFormInputs($request);

    $inputs['password'] = bcrypt($request->input('password'));

    if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
      $inputs['logo'] = $request->file('logo')->store('company/logos', 'public');
    }

    Company::query()->create($inputs);

    return to_route('admin.companies.index');
  }

  public function edit(Company $company): View
  {
    $provinces = Province::getAllProvincesWithCities();

    return view('company::edit', compact(['company', 'provinces']));
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

    Company::query()->update($inputs);

    return to_route('admin.companies.index');
  }

  public function destroy(Company $company): RedirectResponse
  {
    $company->deleteFile();
    $company->delete();

    return to_route('admin.companies.index');
  }
}
