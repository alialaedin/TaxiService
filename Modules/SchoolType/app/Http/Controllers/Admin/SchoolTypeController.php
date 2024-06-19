<?php

namespace Modules\SchoolType\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\SchoolType\Http\Requests\Admin\SchoolTypeStoreRequest;
use Modules\SchoolType\Http\Requests\Admin\SchoolTypeUpdateRequest;
use Modules\SchoolType\Models\SchoolType;

class SchoolTypeController extends Controller
{
  public function index(): View
  {
    $schoolTypes = SchoolType::query()
      ->select(['id', 'title', 'status', 'created_at'])
      ->latest('id')
      ->get();

    $schoolTypesCount = $schoolTypes->count();

    return view('schooltype::index', compact(['schoolTypes', 'schoolTypesCount']));
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
