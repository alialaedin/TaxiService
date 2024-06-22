<?php

namespace Modules\School\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\School\Http\Requests\Admin\SchoolType\SchoolTypeStoreRequest;
use Modules\School\Http\Requests\Admin\SchoolType\SchoolTypeUpdateRequest;
use Modules\School\Models\SchoolType;

class SchoolTypeController extends Controller
{
  public function index(): View
  {
    $schoolTypes = SchoolType::query()
      ->select(['id', 'title', 'status', 'created_at'])
      ->latest('id')
      ->get();

    $schoolTypesCount = $schoolTypes->count();

    return view('school::school-type.index', compact(['schoolTypes', 'schoolTypesCount']));
  }

  public function store(SchoolTypeStoreRequest $request): RedirectResponse
  {
    SchoolType::query()->create($request->validated());

    return redirect()->back();
  }

  public function update(SchoolTypeUpdateRequest $request, SchoolType $schoolType): RedirectResponse
  {
    $schoolType->update($request->validated());

    return redirect()->back();
  }

  public function destroy(SchoolType $schoolType): RedirectResponse
  {
    $schoolType->delete();

    return redirect()->back();
  }
}
