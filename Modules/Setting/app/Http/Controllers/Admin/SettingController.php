<?php

namespace Modules\Setting\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Modules\Setting\Models\Setting;

class SettingController extends Controller
{
  public function edit(): View
  {
    $groups = Cache::rememberForever('settings', fn() => Setting::all()->groupBy('group_label'));

    return view('setting::index', compact('groups'));
  }
}
