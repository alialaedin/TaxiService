<?php

namespace Modules\Shift\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Shift\Http\Requests\Admin\ShiftStoreRequest;
use Modules\Shift\Http\Requests\Admin\ShiftUpdateRequest;
use Modules\Shift\Models\Shift;

class ShiftController extends Controller
{
	public function index(): View
	{
		$shifts = Shift::query()
			->select(['id', 'title', 'status', 'created_at'])
			->latest('id')
			->get();

		$shiftsCount = $shifts->count();

		return view('shift::index', compact('shifts', 'shiftsCount'));
	}

	public function store(ShiftStoreRequest $request): RedirectResponse
  {
    Shift::query()->create($request->validated());

    return redirect()->back();
	}

  public function update(ShiftUpdateRequest $request, Shift $shift): RedirectResponse
  {
    $shift->update($request->validated());

    return redirect()->back();
  }

  public function destroy(Shift $shift): RedirectResponse
  {
    $shift->delete();

    return redirect()->back();
  }
}
