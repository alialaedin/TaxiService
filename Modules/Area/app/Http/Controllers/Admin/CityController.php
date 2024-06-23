<?php

namespace Modules\Area\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Area\Models\City;

class CityController extends Controller
{
  public function getCities(Request $request): JsonResponse
  {
    $provinceId = $request->input('province_id');
    $modelCityId = $request->input('model_city_id') ?? 0;

    $cities = City::query()->where('province_id', $provinceId)->get();

    $options = '';
    foreach ($cities as $city) {
      if ($city->id == $modelCityId) {
        $options .= '<option selected value="' . $city->id . '">' . $city->name . '</option>';
      } else {
        $options .= '<option value="' . $city->id . '">' . $city->name . '</option>';
      }
    }

    return response()->json($options);
  }
}
