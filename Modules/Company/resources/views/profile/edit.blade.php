@extends('core::layouts.company.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item active">
        <a href="{{ route('admin.dashboard') }}">
          <i class="fe fe-user ml-1"></i> پروفایل
        </a>
      </li>
    </ol>
  </div>
  <div class="card">
    <div class="card-header border-0">
      <p class="card-title">ویرایش اطلاعات پروفایل </p>
      <x-core::card-options/>
    </div>
    <div class="card-body">
      <form action="{{ route('company.profile.update') }}" method="post" class="save">
        @csrf
        @method('PATCH')
        <div class="row">

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="form-group">
              <label for="username" class="control-label">نام کاربری :<span class="text-danger">&starf;</span></label>
              <input type="text" id="username" class="form-control" name="username"
                     placeholder="نام کاربری را وارد کنید" value="{{ old('username', auth()->user()->username) }}">
              <x-core::show-validation-error name="username"/>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="form-group">
              <label for="telephone" class="control-label"> تلفن ثابت:<span class="text-danger">&starf;</span></label>
              <input type="text" id="telephone" class="form-control" name="telephone"
                     placeholder="تلفن ثابت را وارد کنید" value="{{ old('telephone', auth()->user()->telephone) }}">
              <x-core::show-validation-error name="telephone"/>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="form-group">
              <label for="address" class="control-label"> آدرس:<span class="text-danger">&starf;</span></label>
              <input type="text" id="address" class="form-control" name="address"
                     placeholder="تلفن ثابت را وارد کنید" value="{{ old('address', auth()->user()->address) }}">
              <x-core::show-validation-error name="address"/>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="form-group">
              <label for="old_password" class="control-label"> کلمه عبور فعلی: </label>
              <input type="password" id="old_password" class="form-control" name="old_password"
                     placeholder="کلمه عبور را وارد کنید">
              <x-core::show-validation-error name="old_password"/>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="form-group">
              <label for="password" class="control-label"> کلمه عبور جدید: </label>
              <input type="password" id="password" class="form-control" name="password"
                     placeholder="کلمه عبور را وارد کنید">
              <x-core::show-validation-error name="password"/>
            </div>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
            <div class="form-group">
              <label for="password_confirmation" class="control-label">تکرار کلمه عبور</label>
              <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                     placeholder="تکرار کلمه عبور را وارد کنید">
              <x-core::show-validation-error name="password_confirmation"/>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="resume" class="control-label">رزومه:<span class="text-danger">&starf;</span></label>
              <textarea name="resume" id="resume" class="form-control" rows="7" placeholder="رزومه را وارد کنید"
                        required>{{ old('resume', auth()->user()->resume) }}</textarea>
              <x-core::show-validation-error name="resume"/>
            </div>
          </div>

        </div>

        <x-core::update-button/>

      </form>
    </div>
  </div>
@endsection

