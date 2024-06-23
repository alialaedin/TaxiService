@extends('core::layouts.admin.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">
          <i class="fe fe-home ml-1"></i> داشبورد
        </a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{ route('admin.companies.index') }}">لیست شرکت ها</a>
      </li>
      <li class="breadcrumb-item active">ویرایش شرکت</li>
    </ol>
  </div>
  <div class="card">
    <div class="card-header">
      <p class="card-title">ویرایش شرکت - کد {{ $company->id }}</p>
      <x-core::card-options/>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.companies.update', $company) }}" method="post" class="save" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">

          <input type="hidden" id="model_city_id" value="{{ $company->city_id }}">

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="title" class="control-label"> عنوان شرکت: <span class="text-danger">&starf;</span></label>
              <input type="text" id="title" class="form-control" name="title" placeholder="عنوان شرکت را وارد کنید"
                     value="{{ old('title', $company->title) }}" required autofocus>
              <x-core::show-validation-error name="title"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="name" class="control-label"> نام و نام خانوادگی: <span
                  class="text-danger">&starf;</span></label>
              <input type="text" id="name" class="form-control" name="name"
                     placeholder="نام و نام خانوادگی را وارد کنید" value="{{ old('name', $company->name) }}" required autofocus>
              <x-core::show-validation-error name="name"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="mobile" class="control-label"> شماره موبایل: <span class="text-danger">&starf;</span></label>
              <input type="text" id="mobile" class="form-control" name="mobile" placeholder="شماره موبایل را وارد کنید"
                     value="{{ old('mobile', $company->mobile) }}" required>
              <x-core::show-validation-error name="mobile"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="telephone" class="control-label"> تلفن ثابت:</label>
              <input type="text" id="telephone" class="form-control" name="telephone"
                     placeholder="تلفن ثابت را وارد کنید" value="{{ old('telephone', $company->telephone) }}">
              <x-core::show-validation-error name="telephone"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="province_id" class="control-label">استان :<span class="text-danger">&starf;</span></label>
              <select name="province_id" id="province_id" class="form-control" onchange="loadCitiesByProvinceId()">
                @foreach($provinces as $province)
                  <option
                    value="{{ $province->id }}"
                    class="text-dark"
                    @selected(old('province_id', $company->city->province->id) == $province->id)>
                    {{ $province->name }}
                  </option>
                @endforeach
              </select>
              <x-core::show-validation-error name="province_id"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="city_id" class="control-label">شهر :<span class="text-danger">&starf;</span></label>
              <select name="city_id" id="city_id" class="form-control"></select>
              <x-core::show-validation-error name="city_id"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="status" class="control-label">وضعیت :<span class="text-danger">&starf;</span></label>
              <select name="status" id="status" class="form-control">
                <option value="" class="text-muted">وضعیت را انتخاب کنید</option>
                @foreach(config('core.bool_statuses') as $value => $label)
                  <option value="{{ $value }}" @selected(old('status', $company->status) == "$value")>{{ $label }}</option>
                @endforeach
              </select>
              <x-core::show-validation-error name="status"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="username" class="control-label">نام کاربری :<span class="text-danger">&starf;</span></label>
              <input type="text" id="username" class="form-control" name="username"
                     placeholder="نام کاربری را وارد کنید" value="{{ old('username', $company->username) }}">
              <x-core::show-validation-error name="username"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="password" class="control-label"> کلمه عبور: </label>
              <input type="password" id="password" class="form-control" name="password"
                     placeholder="کلمه عبور را وارد کنید">
              <x-core::show-validation-error name="password"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="password_confirmation" class="control-label"></label>
              <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                     placeholder="تکرار کلمه عبور را وارد کنید">
              <x-core::show-validation-error name="password_confirmation"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="account_number" class="control-label">شماره حساب :<span
                  class="text-danger">&starf;</span></label>
              <input type="text" id="account_number" class="form-control" name="account_number"
                     placeholder="شماره حساب را وارد کنید" value="{{ old('account_number', $company->account_number) }}">
              <x-core::show-validation-error name="account_number"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="card_number" class="control-label">شماره کارت :<span
                  class="text-danger">&starf;</span></label>
              <input type="text" id="card_number" class="form-control" name="card_number"
                     placeholder="شماره کارت را وارد کنید" value="{{ old('card_number', $company->card_number) }}">
              <x-core::show-validation-error name="card_number"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="sheba_number" class="control-label">شماره شبا :<span
                  class="text-danger">&starf;</span></label>
              <input type="text" id="sheba_number" class="form-control" name="sheba_number"
                     placeholder="شماره شبا را وارد کنید" value="{{ old('sheba_number', $company->sheba_number) }}">
              <x-core::show-validation-error name="sheba_number"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="logo" class="control-label">لوگو :</label>
              <input type="file" id="logo" class="form-control" name="logo" value="{{ old('logo') }}">
              <x-core::show-validation-error name="logo"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="address" class="control-label">آدرس :<span
                  class="text-danger">&starf;</span></label>
              <input type="text" id="address" class="form-control" name="address"
                     placeholder="آدرس را وارد کنید" value="{{ old('address', $company->address) }}">
              <x-core::show-validation-error name="address"/>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="resume" class="control-label">رزومه:<span class="text-danger">&starf;</span></label>
              <textarea name="resume" id="resume" class="form-control" rows="7" placeholder="رزومه را وارد کنید"
                        required>{{ old('resume', $company->resume) }}</textarea>
              <x-core::show-validation-error name="resume"/>
            </div>
          </div>

        </div>

        <x-core::update-button/>

      </form>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    function loadCitiesByProvinceId() {
      let provinceId = $('#province_id').val();
      let modelCityId = $('#model_city_id').val();

      let token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url: '{{ route("admin.get-cities-by-province-id") }}',
        type: 'POST',
        data: {
          province_id: provinceId,
          model_city_id: modelCityId
        },
        headers: {'X-CSRF-TOKEN': token},
        success: function (response) {
          $('#city_id').html(response);
        }
      });
    }
  </script>
@endsection
