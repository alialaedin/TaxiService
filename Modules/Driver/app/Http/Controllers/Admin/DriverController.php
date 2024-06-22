<?php

namespace Modules\Driver\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Modules\Company\Models\Company;
use Modules\Driver\Http\Requests\Admin\DriverStoreRequest;
use Modules\Driver\Http\Requests\Admin\DriverUpdateRequest;
use Modules\Driver\Models\Driver;

class DriverController extends Controller
{
  public function index(): View
  {
    $drivers = Driver::query()
      ->select(['id', 'company_id', 'gender', 'name', 'mobile', 'driver_image', 'status', 'car_name'])
      ->with('company:id,title')
      ->latest('id')
      ->paginate()
      ->withQueryString();

    $totalDrivers = $drivers->total();

    return view('driver::index', compact(['totalDrivers', 'drivers']));
  }

  public function show(Driver $driver): View
  {
    return view('driver::show', compact('driver'));
  }

  public function create(): View
  {
    $carTypes = $this->getAllCarTypes();
    $genders = $this->getAllGenders();
    $companies = Company::getActiveCompanies();

    $acceptedLicenseImageMimes = Driver::ACCEPTED_LICENSE_MIME_TYPES;
    $acceptedDriverImageMimes = Driver::ACCEPTED_IMAGE_MIME_TYPES;

    return view('driver::create', compact([
      'carTypes',
      'genders',
      'companies',
      'acceptedDriverImageMimes',
      'acceptedLicenseImageMimes'
    ]));
  }

  public function store(DriverStoreRequest $request): RedirectResponse
  {
    $inputs = Driver::getFormInputs($request);

    if ($request->hasFile('driver_image') && $request->file('driver_image')->isValid()) {
      $inputs['driver_image'] = $request->file('driver_image')->store('driver/images', 'public');
    }
    if ($request->hasFile('license_image') && $request->file('license_image')->isValid()) {
      $inputs['license_image'] = $request->file('license_image')->store('driver/licenses', 'public');
    }

    Driver::query()->create($inputs);

    return to_route('admin.drivers.index');
  }

  public function edit(Driver $driver): View
  {
    $carTypes = $this->getAllCarTypes();
    $genders = $this->getAllGenders();
    $companies = Company::getActiveCompanies();

    $acceptedLicenseImageMimes = Driver::ACCEPTED_LICENSE_MIME_TYPES;
    $acceptedDriverImageMimes = Driver::ACCEPTED_IMAGE_MIME_TYPES;

    return view('driver::edit', compact([
      'driver',
      'carTypes',
      'genders',
      'companies',
      'acceptedDriverImageMimes',
      'acceptedLicenseImageMimes']));
  }

  public function update(DriverUpdateRequest $request, Driver $driver): RedirectResponse
  {
    $inputs = Driver::getFormInputs($request);

    if ($request->hasFile('driver_image') && $request->file('driver_image')->isValid()) {
      Storage::delete($driver->driver_image);
      $inputs['driver_image'] = $request->file('driver_image')->store('driver/images', 'public');
    }
    if ($request->hasFile('license_image') && $request->file('license_image')->isValid()) {
      Storage::delete($driver->license_image);
      $inputs['license_image'] = $request->file('license_image')->store('driver/licenses', 'public');
    }

    $driver->update($inputs);

    return to_route('admin.drivers.index');
  }

  public function destroy(Driver $driver): RedirectResponse
  {
    $driver->delete();

    return to_route('admin.drivers.index');
  }

  private function getAllGenders(): array
  {
    $genderKeys = Driver::getAllGenders();
    $genders = [];
    foreach ($genderKeys as $genderKey) {
      $genders[$genderKey] = __('custom.genders.' . $genderKey);
    }

    return $genders;
  }

  private function getAllCarTypes(): array
  {
    $carTypeKeys = Driver::getAllCarTypes();
    $carTypes = [];
    foreach ($carTypeKeys as $carTypeKey) {
      $carTypes[$carTypeKey] = __('custom.car_types.' . $carTypeKey);
    }

    return $carTypes;
  }

}
