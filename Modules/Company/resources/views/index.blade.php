@extends('core::layouts.admin.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home ml-1"></i> داشبورد</a>
      </li>
      <li class="breadcrumb-item active">لیست شرکت ها</li>
    </ol>
    <x-core::register-button route="admin.companies.create" title="ثبت شرکت جدید"/>
  </div>
  @include('company::filter-form')
  <div class="card">
    <div class="card-header border-0">
      <p class="card-title">لیست همه شرکت ها ({{ $totalCompanies }})</p>
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
                <th class="text-center">عنوان شرکت</th>
                <th class="text-center">لوگو</th>
                <th class="text-center">نام و نام خانوادگی</th>
                <th class="text-center">شماره موبایل</th>
                <th class="text-center">شهر</th>
                <th class="text-center">وضعیت</th>
                <th class="text-center">تاریخ ثبت</th>
                <th class="text-center">عملیات</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($companies as $company)
                <tr>
                  <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $company->title }}</td>
                  <td class="text-center">
                    <figure class="figure m-0">
                      <a target="_blank" href="{{ Storage::url($company->logo) }}">
                        <img src="{{ Storage::url($company->logo) }}" class="img-thumbnail" alt="{{ $company->title }}"
                             width="50" style="max-height: 32px;"/>
                      </a>
                    </figure>
                  </td>
                  <td class="text-center">{{ $company->name }}</td>
                  <td class="text-center">{{ $company->mobile }}</td>
                  <td class="text-center">{{ $company->city->name }}</td>
                  <td class="text-center">
                    <x-core::badge
                      type="{{ $company->getStatusBadgeType() }}"
                      text="{{ $company->getStatus() }}"
                    />
                  </td>
                  <td class="text-center"> @jalaliDate($company->created_at)</td>
                  <td class="text-center">
                    <x-core::show-button route="admin.companies.show" :model="$company"/>
                    <x-core::edit-button route="admin.companies.edit" :model="$company"/>
                    <x-core::delete-button route="admin.companies.destroy" :model="$company"/>
                  </td>
                </tr>
              @empty
                <x-core::data-not-found-alert :colspan="8"/>
              @endforelse
              </tbody>
            </table>
            {{ $companies->onEachSide(0)->links("vendor.pagination.bootstrap-4") }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
