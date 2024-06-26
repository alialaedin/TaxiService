<?php

namespace Modules\Dashboard\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
  public function index(): View
  {
    return view('dashboard::family.index');
  }
}
