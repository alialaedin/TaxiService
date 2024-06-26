@extends('core::layouts.company.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item active"><i class="fa fa-car ml-1"></i> لیست راننده ها</li>
    </ol>
    <x-core::register-button route="company.drivers.create" title="ثبت راننده جدید"/>
  </div>
  @include('driver::company.filter-form')
  <div class="card">
    <div class="card-header border-0">
      <p class="card-title">لیست همه راننده ها ({{ $totalDrivers }})</p>
      <x-core::card-options/>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <div class="dataTables_wrapper dt-bootstrap4 no-footer">
          <div class="row">
            <table class="table table-vcenter table-striped text-nowrap table-bordered border-bottom">
              <thead class="thead-light">
              <tr>
                <th class="text-center">ردیف</th>
                <th class="text-center">نام راننده</th>
                <th class="text-center">تصویر راننده</th>
                <th class="text-center">شماره موبایل</th>
                <th class="text-center">جنسیت</th>
                <th class="text-center">نام ماشین</th>
                <th class="text-center">وضعیت</th>
                <th class="text-center">تاریخ ثبت</th>
                <th class="text-center">عملیات</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($drivers as $driver)
                <tr>
                  <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $driver->name }}</td>
                  <td class="text-center">
                    <a href target="_blanck">
                      <div class="w-100 bg-light">
                        <img src="{{ Storage::url($driver->driver_image) }}" style="height: 60px;" alt="{{ $driver->name }}">
                      </div>
                    </a>
                  </td>
                  <td class="text-center">{{ $driver->mobile }}</td>
                  <td class="text-center">{{ $driver->getGender() }}</td>
                  <td class="text-center">{{ $driver->car_name }}</td>
                  <td class="text-center">
                    <x-core::badge
                      type="{{ $driver->getStatusBadgeType() }}"
                      text="{{ $driver->getStatus() }}"
                    />
                  </td>
                  <td class="text-center"> @jalaliDate($driver->created_at)</td>
                  <td class="text-center">
                    <x-core::show-button route="company.drivers.show" :model="$driver"/>
                    <x-core::edit-button route="company.drivers.edit" :model="$driver"/>
                    <x-core::delete-button route="company.drivers.destroy" :model="$driver"/>
                  </td>
                </tr>
              @empty
                <x-core::data-not-found-alert :colspan="9"/>
              @endforelse
              </tbody>
            </table>
            {{ $drivers->onEachSide(0)->links("vendor.pagination.bootstrap-4") }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
