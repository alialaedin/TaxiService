@extends('core::layouts.admin.master')
@section('content')
  <div class="col-12">

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
        <li class="breadcrumb-item active">نمایش راننده</li>
      </ol>

      <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{ route('admin.drivers.edit', $driver) }}" class="btn btn-warning mx-1">
          ویرایش راننده
          <i class="fa fa-pencil mr-1"></i>
        </a>
        <button
          onclick="confirmDelete('delete-{{ $driver->id }}')"
          class="btn btn-danger mx-1">
          حذف راننده
          <i class="fa fa-trash-o mr-1"></i>
        </button>
        <form
          action="{{ route('admin.drivers.destroy', $driver) }}"
          method="POST"
          id="delete-{{ $driver->id }}"
          style="display: none">
          @csrf
          @method('DELETE')
        </form>
      </div>

    </div>

    <div class="row">

      <div class=" col-xl-4 col-lg-6 col-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <p class="header text-xl-center p-3 fs-20 col-12">مشخصات راننده</p>
            <ul class="list-group">
              <li class="list-group-item"><strong>نام و نام خانوادگی : </strong> {{ $driver->name }} </li>
              <li class="list-group-item"><strong>شماره موبایل : </strong> {{ $driver->mobile }} </li>
              <li class="list-group-item"><strong>جنسیت : </strong> {{ $driver->getGender() }} </li>
              <li class="list-group-item"><strong>کد ملی : </strong> {{ $driver->national_code }} </li>
              <li class="list-group-item"><strong>آدرس : </strong> {{ $driver->address }} </li>
            </ul>
          </div>
        </div>
      </div>

      <div class=" col-xl-4 col-lg-6 col-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <p class="header text-xl-center p-3 fs-20 col-12">مشخصات شرکت</p>
            <ul class="list-group">
              <li class="list-group-item"><strong>عنوان شرکت : </strong> {{ $driver->company->title }} </li>
              <li class="list-group-item"><strong>نام و نام خانوادگی : </strong> {{ $driver->company->name }} </li>
              <li class="list-group-item"><strong>شماره موبایل : </strong> {{ $driver->company->mobile }} </li>
              <li class="list-group-item"><strong>شماره تلفن : </strong> {{ $driver->company->telephone }} </li>
              <li class="list-group-item"><strong>آدرس : </strong> {{ $driver->company->address }} </li>
            </ul>
          </div>
        </div>
      </div>

      <div class=" col-xl-4 col-lg-6 col-12">
        <div class="card overflow-hidden">
          <div class="card-body">
            <p class="header text-xl-center p-3 fs-20 col-12">مشخصات ماشین</p>
            <ul class="list-group">
              <li class="list-group-item"><strong>نام : </strong> {{ $driver->car_name }} </li>
              <li class="list-group-item"><strong>مدل : </strong> {{ $driver->car_model }} </li>
              <li class="list-group-item">
                <strong>رنگ : </strong>
                <span style="
                  padding: 2px 8px;
                  color: #FFFFFF;
                  background-color: {{ $driver->car_color }};
                ">{{$driver->car_color}}</span>
              </li>
              <li class="list-group-item"><strong>نوع : </strong> {{ $driver->getCarType() }} </li>
              <li class="list-group-item"><strong>پلاک : </strong> {{ $driver->plaque }} </li>
            </ul>
          </div>
        </div>
      </div>

    </div>

  </div>
@endsection
