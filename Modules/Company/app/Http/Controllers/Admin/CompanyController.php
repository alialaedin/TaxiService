<?php

namespace Modules\Company\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Company\Models\Company;

class CompanyController extends Controller
{
  public function index(): View
  {
    $title = request('title');
    $name = request('name');
    $mobile = request('mobile');
    $status = request('status');

    $companies = Company::query()
      ->select('id', 'title', 'name', 'mobile', 'city_id', 'status', 'created_at')
      ->when($title, fn(Builder $query) => $query->where('title', 'like', "%$title%"))
      ->when($name, fn(Builder $query) => $query->where('name', 'like', "%$name%"))
      ->when($mobile, fn(Builder $query) => $query->where('mobile', '=', $mobile))
      ->when(isset($title), fn(Builder $query) => $query->where('status', '=', $status))
      ->with([
        'city' => fn($query) => $query->select('id', 'name', 'province_id'),
        'city.province' => fn($query) => $query->select('id', 'name')
      ])
      ->latest('id')
      ->paginate()
      ->withQueryString();

    $totalCompanies = $companies->total();

    return view('company::index', compact(['companies', 'totalCompanies']));
  }
}
