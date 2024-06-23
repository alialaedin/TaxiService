<?php

namespace Modules\Auth\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Family\Models\Family;

class AuthController extends Controller
{
  private function updateLastLoggedIn(Family $family): void
  {
    $family->last_login = now();
    $family->save();
  }

  public function showNumberInputForm(): View
  {
    return view('auth::family.mobile-input-form');
  }


}
