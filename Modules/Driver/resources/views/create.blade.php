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
        <a href="{{ route('admin.drivers.index') }}">لیست راننده ها</a>
      </li>
      <li class="breadcrumb-item active">ثبت راننده جدید</li>
    </ol>
  </div>


  <div class="card">
    <div class="card-body">
      <form action="{{ route('admin.drivers.store') }}" method="post" class="save" enctype="multipart/form-data">
        @csrf

        <div class="row">

          <p class="header p-1 fs-20 col-12">مشخصات راننده</p>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="company_id" class="control-label"> شرکت: <span class="text-danger">&starf;</span></label>
              <select name="company_id" id="company_id" class="form-control">
                <option value="" class="text-muted">شرکت را انتخاب کنید</option>
                @foreach($companies as $company)
                  <option
                    value="{{ $company->id }}"@selected(old('company_id') == $company->id)>{{ $company->title }}</option>
                @endforeach
              </select>
              <x-core::show-validation-error name="company_id"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="name" class="control-label"> نام و نام خانوادگی راننده: <span
                  class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="name"
                class="form-control"
                name="name"
                placeholder="نام و نام خانوادگی را وارد کنید"
                value="{{ old('name') }}"
                required autofocus
              />
              <x-core::show-validation-error name="name"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="mobile" class="control-label"> شماره موبایل راننده: <span
                  class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="mobile"
                class="form-control"
                name="mobile"
                placeholder="شماره موبایل را وارد کنید"
                value="{{ old('mobile') }}"
                required
              />
              <x-core::show-validation-error name="mobile"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="gender" class="control-label"> جنسیت:<span class="text-danger">&starf;</span></label>
              <select name="gender" id="gender" class="form-control">
                <option value="" class="text-muted">جنسیت را انتخاب کنید</option>
                @foreach($genders as $name => $label)
                  <option value="{{ $name }}"@selected(old('gender') == $name)>{{ $label }}</option>
                @endforeach
              </select>
              <x-core::show-validation-error name="gender"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="national_code" class="control-label"> کد ملی: <span class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="national_code"
                class="form-control"
                name="national_code"
                placeholder="کد ملی را وارد کنید"
                value="{{ old('national_code') }}"
                required autofocus
              />
              <x-core::show-validation-error name="national_code"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="driver_image" class="control-label">تصویر راننده :<span
                  class="text-danger">&starf;</span></label>
              <input type="file" id="driver_image" class="form-control" name="driver_image"
                     value="{{ old('driver_image') }}">
              <span class="d-block fs-10 mt-1 mr-1 text-muted-dark">تایپ فایل های قابل قبول : {{ $acceptedDriverImageMimes }}</span>
              <x-core::show-validation-error name="driver_image"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="license_image" class="control-label">تصویر مجوز :<span
                  class="text-danger">&starf;</span></label>
              <input type="file" id="license_image" class="form-control" name="license_image"
                     value="{{ old('license_image') }}">
              <span class="d-block fs-10 mt-1 mr-1 text-muted-dark">تایپ فایل های قابل قبول : {{ $acceptedLicenseImageMimes }}</span>
              <x-core::show-validation-error name="license_image"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="address" class="control-label">آدرس:<span class="text-danger">&starf;</span></label>
              <input
                id="address"
                name="address"
                class="form-control"
                placeholder="آدرس را وارد کنید"
                value="{{ old('address') }}"
              />
              <x-core::show-validation-error name="address"/>
            </div>
          </div>

        </div>
        <div class="row">

          <p class="header p-1 fs-20 col-12">مشخصات ماشین</p>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="car_type" class="control-label"> نوع ماشین: <span class="text-danger">&starf;</span></label>
              <select name="car_type" id="car_type" class="form-control">
                <option value="" class="text-muted">نوع ماشین را انتخاب کنید</option>
                @foreach($carTypes as $name => $label)
                  <option value="{{ $name }}" @selected(old('car_type') == $name)>{{ $label }}</option>
                @endforeach
              </select>
              <x-core::show-validation-error name="car_type"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="car_model" class="control-label"> مدل ماشین: <span class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="car_model"
                class="form-control"
                name="car_model"
                placeholder="مدل ماشین را وارد کنید"
                value="{{ old('car_model') }}"
                required autofocus
              />
              <x-core::show-validation-error name="car_model"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="car_name" class="control-label"> نام ماشین: <span class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="car_name"
                class="form-control"
                name="car_name"
                placeholder="نام ماشین را وارد کنید"
                value="{{ old('car_name') }}"
                required autofocus
              />
              <x-core::show-validation-error name="car_name"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="car_color" class="control-label"> رنگ ماشین: <span class="text-danger">&starf;</span></label>
              <input
                type="color"
                id="car_color"
                class="form-control"
                name="car_color"
                placeholder="رنگ ماشین را وارد کنید"
                value="{{ old('car_color') }}"
                required autofocus
              />
              <x-core::show-validation-error name="car_color"/>
            </div>
          </div>

        </div>
        <div class="row">

          <p class="header p-1 fs-20 col-12">اطلاعات بانکی</p>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="bank_name" class="control-label"> نام بانک: <span class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="bank_name"
                class="form-control"
                name="bank_name"
                placeholder="مدل ماشین را وارد کنید"
                value="{{ old('bank_name') }}"
                required autofocus
              />
              <x-core::show-validation-error name="bank_name"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="account_number" class="control-label"> شماره حساب: <span
                  class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="account_number"
                class="form-control"
                name="account_number"
                placeholder="شماره حساب را وارد کنید"
                value="{{ old('account_number') }}"
                required autofocus
              />
              <x-core::show-validation-error name="account_number"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="card_number" class="control-label"> شماره کارت: <span
                  class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="card_number"
                class="form-control"
                name="card_number"
                placeholder="شماره کارت را وارد کنید"
                value="{{ old('card_number') }}"
                required autofocus
              />
              <x-core::show-validation-error name="card_number"/>
            </div>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="sheba_number" class="control-label"> شماره شبا: <span
                  class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="sheba_number"
                class="form-control"
                name="sheba_number"
                placeholder="شماره شبا را وارد کنید"
                value="{{ old('sheba_number') }}"
                required autofocus
              />
              <x-core::show-validation-error name="sheba_number"/>
            </div>
          </div>

        </div>
        <div class="row">

          <p class="header p-1 fs-20 col-12">سایر اطلاعات</p>

          <div class="col-md-3 col-12">
            <div class="form-group">
              <label for="status" class="control-label">وضعیت :<span class="text-danger">&starf;</span></label>
              <select name="status" id="status" class="form-control">
                <option value="" class="text-muted">وضعیت را انتخاب کنید</option>
                @foreach(config('core.bool_statuses') as $value => $label)
                  <option value="{{ $value }}" @selected(old('status') == "$value")>{{ $label }}</option>
                @endforeach
              </select>
              <x-core::show-validation-error name="status"/>
            </div>
          </div>

          <div class="col-md-3 col-12">
            <div class="form-group">
              <label for="license_expiration_date_show" class="control-label">تاریخ انقضای مجوز:<span class="text-danger">&starf;</span></label>
              <input
                class="form-control fc-datepicker"
                id="license_expiration_date_show"
                type="text"
                autocomplete="off"
                placeholder="تاریخ انقضای مجوز را وارد کنید"
              />
              <input
                name="license_expiration_date"
                id="license_expiration_date_hidden"
                type="hidden"
                required
                value="{{	old('license_expiration_date') }}"
              />
              <x-core::show-validation-error name="license_expiration_date" />
            </div>
          </div>

          <div class="col-md-3 col-12">
            <div class="d-flex col-md-12" style="background-image: url('https://classfix.ir/no-images/pelaque.png');background-size: 100% 100%;padding: 14px 3px 0 30px;">

              <div class="form-group col-md-3">
                <input type="text" name="plaque_1" id="plaque_1" class="form-control" maxlength="2">
                <x-core::show-validation-error name="plaque_1" />
              </div>

              <div class="form-group col-md-3">
                <input type="text" name="plaque_2" id="plaque_2" class="form-control" maxlength="3">
                <x-core::show-validation-error name="plaque_2" />
              </div>

              <div class="form-group col-md-3">
                <input type="text" name="plaque_3" id="plaque_3" class="form-control" placeholder="الف" maxlength="1">
                <x-core::show-validation-error name="plaque_3" />
              </div>

              <div class="form-group col-md-3">
                <input type="text" name="plaque_4" id="plaque_4" class="form-control" maxlength="2">
                <x-core::show-validation-error name="plaque_4" />
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="description" class="control-label">توضیحات:</label>
              <textarea
                name="description"
                id="description"
                class="form-control"
                rows="6"
                placeholder="توضیحات وارد کنید"
                required>{{ old('description') }}
              </textarea>
              <x-core::show-validation-error name="description"/>
            </div>
          </div>

        </div>

        <x-core::store-button/>
      </form>
    </div>
  </div>
@endsection
@section('scripts')
  <x-core::date-input-script textInputId="license_expiration_date_show" dateInputId="license_expiration_date_hidden"/>
@endsection
