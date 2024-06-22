<?php

namespace Modules\Setting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Modules\Setting\Http\Requests\Admin\SettingUpdateRequest;
use Modules\Setting\Models\Setting;

class SettingController extends Controller
{
  public function edit(): View
  {
    $groups = Setting::all()->groupBy('group');

    return view('setting::edit', compact('groups'));
  }

  public function update(SettingUpdateRequest $request): \Illuminate\Http\RedirectResponse
  {
    $inputs = $request->except(['_token', '_method']);

    foreach ($inputs as $name => $value) {
      if ($setting = Setting::query()->where('name', $name)->first()) {
        $setting->update(['value' => $value]);
      }
    }

    return redirect()->back();
  }

}
