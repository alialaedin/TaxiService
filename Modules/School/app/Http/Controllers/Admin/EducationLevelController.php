<?php

namespace Modules\School\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\School\Http\Requests\Admin\EducationLevel\EducationLevelStoreRequest;
use Modules\School\Http\Requests\Admin\EducationLevel\EducationLevelUpdateRequest;
use Modules\School\Models\EducationLevel;

class EducationLevelController extends Controller
{
  public function index(): View
  {
    $educationLevels = EducationLevel::query()
      ->select(['id', 'title', 'status', 'gender', 'created_at'])
      ->latest('id')
      ->get();

    $educationLevelsCount = $educationLevels->count();

    return view('school::education-level.index', compact('educationLevels', 'educationLevelsCount'));
  }

  public function store(EducationLevelStoreRequest $request): RedirectResponse
  {
    EducationLevel::query()->create($request->validated());

    return redirect()->back();
  }

  public function update(EducationLevelUpdateRequest $request, EducationLevel $educationLevel): RedirectResponse
  {
    $educationLevel->update($request->validated());

    return redirect()->back();
  }

  public function destroy(EducationLevel $educationLevel): RedirectResponse
  {
    $educationLevel->delete();

    return redirect()->back();
  }
}
