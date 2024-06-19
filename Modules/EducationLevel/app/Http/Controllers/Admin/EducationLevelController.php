<?php

namespace Modules\EducationLevel\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\EducationLevel\Http\Requests\Admin\EducationLevelStoreRequest;
use Modules\EducationLevel\Http\Requests\Admin\EducationLevelUpdateRequest;
use Modules\EducationLevel\Models\EducationLevel;

class EducationLevelController extends Controller
{
  public function index(): View
  {
    $educationLevels = EducationLevel::query()
      ->select(['id', 'title', 'status', 'gender', 'created_at'])
      ->latest('id')
      ->get();

    $educationLevelsCount = $educationLevels->count();

    return view('educationlevel::index', compact('educationLevels', 'educationLevelsCount'));
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
