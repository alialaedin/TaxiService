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
        <a href="{{ route('admin.schools.index') }}">لیست مدرسه ها</a>
      </li>
      <li class="breadcrumb-item active">ویرایش مدرسه</li>
    </ol>
  </div>
  <div class="card">
    <div class="card-header">
      <p class="card-title">ویرایش مدرسه - کد {{ $school->id }}</p>
      <x-core::card-options/>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.schools.update', $school) }}" method="post" class="save">
        @csrf
        @method('PATCH')
        <div class="row">

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="title" class="control-label"> عنوان مدرسه: <span class="text-danger">&starf;</span></label>
              <input type="text" id="title" class="form-control" name="title" placeholder="عنوان مدرسه را وارد کنید"
                     value="{{ old('title', $school->title) }}" required autofocus>
              <x-core::show-validation-error name="title"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="manager_name" class="control-label"> نام و نام خانوادگی مدیر: <span
                  class="text-danger">&starf;</span></label>
              <input type="text" id="manager_name" class="form-control" name="manager_name"
                     placeholder="نام و نام خانوادگی را وارد کنید"
                     value="{{ old('manager_name', $school->manager_name) }}" required autofocus>
              <x-core::show-validation-error name="manager_name"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="manager_mobile" class="control-label"> شماره موبایل مدیر: <span
                  class="text-danger">&starf;</span></label>
              <input type="text" id="manager_mobile" class="form-control" name="manager_mobile"
                     placeholder="شماره موبایل را وارد کنید"
                     value="{{ old('manager_mobile', $school->manager_mobile) }}" required>
              <x-core::show-validation-error name="manager_mobile"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="telephone" class="control-label"> تلفن ثابت:<span class="text-danger">&starf;</span></label>
              <input
                type="text"
                id="telephone"
                class="form-control"
                name="telephone"
                placeholder="تلفن ثابت را وارد کنید"
                value="{{ old('telephone', $school->telephone) }}"
              />
              <x-core::show-validation-error name="telephone"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="education_level_id" class="control-label">مقطع تحصیلی :<span
                  class="text-danger">&starf;</span></label>
              <select name="education_level_id" id="education_level_id" class="form-control">
                @foreach($educationLevels as $educationLevel)
                  <option
                    value="{{ $educationLevel->id }}"
                    @selected(old('education_level_id', $school->education_level_id) == $educationLevel->id)>
                    {{ $educationLevel->title  . ' ' . '(' . $educationLevel->getGender() .')'}}
                  </option>
                @endforeach
              </select>
              <x-core::show-validation-error name="education_level_id"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="shift_id" class="control-label">شیفت :<span class="text-danger">&starf;</span></label>
              <select name="shift_id" id="shift_id" class="form-control">
                @foreach($shifts as $shift)
                  <option
                    value="{{ $shift->id }}"
                    @selected(old('shift_id', $school->shift_id) == $shift->id)>
                    {{ $shift->title }}
                  </option>
                @endforeach
              </select>
              <x-core::show-validation-error name="shift_id"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="school_type_id" class="control-label">نوع مدرسه :<span
                  class="text-danger">&starf;</span></label>
              <select name="school_type_id" id="school_type_id" class="form-control">
                @foreach($schoolTypes as $schoolType)
                  <option
                    value="{{ $schoolType->id }}"
                    @selected(old('school_type_id', $school->school_type_id) == $schoolType->id)>
                    {{ $schoolType->title }}
                  </option>
                @endforeach
              </select>
              <x-core::show-validation-error name="school_type_id"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="status" class="control-label">وضعیت :<span class="text-danger">&starf;</span></label>
              <select name="status" id="status" class="form-control">
                @foreach(config('core.bool_statuses') as $value => $label)
                  <option value="{{ $value }}" @selected(old('status', $school->status) == "$value")>{{ $label }}</option>
                @endforeach
              </select>
              <x-core::show-validation-error name="status"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="is_traffic" class="control-label">ترافیکی :<span class="text-danger">&starf;</span></label>
              <select name="is_traffic" id="is_traffic" class="form-control">
                <option value="1" @selected(old('is_traffic', $school->is_traffic) == '1')>هست</option>
                <option value="0" @selected(old('is_traffic', $school->is_traffic) == '0')>نیست</option>
              </select>
              <x-core::show-validation-error name="is_traffic"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="city_id" class="control-label">شهر و استان :<span class="text-danger">&starf;</span></label>
              <select name="city_id" id="city_id" class="form-control">
                @foreach($provinces as $province)
                  <optgroup label="{{ $province->name }}" class="text-muted">
                    @foreach ($province->cities as $city)
                      <option
                        value="{{ $city->id }}"
                        class="text-dark"
                        @selected(old('city_id', $school->city_id) == $city->id)>
                        {{ $city->name }}
                      </option>
                    @endforeach
                  </optgroup>
                @endforeach
              </select>
              <x-core::show-validation-error name="city_id"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="latitude" class="control-label"> عرض جغرافیایی (x): <span class="text-danger">&starf;</span></label>
              <input type="text" id="latitude" class="form-control" name="latitude"
                     placeholder="عرض جغرافیایی را وارد کنید" value="{{ old('latitude', $school->latitude) }}">
              <x-core::show-validation-error name="latitude"/>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-12">
            <div class="form-group">
              <label for="longitude" class="control-label"> طول جغرافیایی (y): <span class="text-danger">&starf;</span></label>
              <input type="text" id="longitude" class="form-control" name="longitude"
                     placeholder="طول جغرافیایی را وارد کنید" value="{{ old('longitude', $school->longitude) }}">
              <x-core::show-validation-error name="longitude"/>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <label for="address" class="control-label">آدرس:<span class="text-danger">&starf;</span></label>
              <textarea
                name="address"
                id="address"
                class="form-control"
                rows="3"
                placeholder="آدرس را وارد کنید"
                required>
                {{ old('address', $school->address) }}
              </textarea>
              <x-core::show-validation-error name="address"/>
            </div>
          </div>

        </div>

        <x-core::update-button/>

      </form>
    </div>
  </div>
@endsection
