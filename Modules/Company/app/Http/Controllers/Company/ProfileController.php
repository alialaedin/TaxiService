<?php

namespace Modules\Company\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Modules\Company\Http\Requests\Company\ProfileUpdateRequest;

class ProfileController extends Controller
{
  public function edit(): View
  {
    $company = auth('company-web')->user();

    return view('company::profile.edit', compact('company'));
  }

  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $company = auth('company-web')->user();

    $inputs = [
      'telephone' => $request->input('telephone'),
      'username' => $request->input('username'),
      'resume' => $request->input('resume')
    ];

    if ($request->filled('password')) {
      if (Hash::check($request->input('old_password'), $company->password)) {
        $inputs['password'] = bcrypt($request->input('password'));
      } else {
        toastr()->error('کلمه عبور قبلی شما به درستی وارد نشده است.');
        return redirect()->back();
      }
    }

    $company->update($inputs);

    toastr()->success('پروفایل شما با موفقیت ویرایش شد.');

    return redirect()->back();
  }
}
