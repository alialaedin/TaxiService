@extends('core::layouts.admin.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home ml-1"></i> داشبورد</a>
      </li>
      <li class="breadcrumb-item active">لیست مدرسه ها</li>
    </ol>
    <x-core::register-button route="admin.schools.create" title="ثبت مدرسه جدید"/>
  </div>
  @include('school::school.filter-form')
  <div class="card">
    <div class="card-header border-0">
      <p class="card-title">لیست همه مدرسه ها ({{ $totalSchools }})</p>
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
                <th class="text-center">عنوان مدرسه</th>
                <th class="text-center">شیفت</th>
                <th class="text-center">نوع مدرسه</th>
                <th class="text-center">مقطع تحصیلی</th>
                <th class="text-center">شهر</th>
                <th class="text-center">ترافیکی</th>
                <th class="text-center">وضعیت</th>
                <th class="text-center">تاریخ ثبت</th>
                <th class="text-center">عملیات</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($schools as $school)
                <tr>
                  <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $school->title }}</td>
                  <td class="text-center">{{ $school->shift->title }}</td>
                  <td class="text-center">{{ $school->schoolType->title }}</td>
                  <td class="text-center">{{ $school->educationLevel->title.' '.'('.$school->educationLevel->getGender().')' }}</td>
                  <td class="text-center">{{ $school->city->name }}</td>
                  <td class="text-center">
                    <x-core::badge
                      type="{{ $school->getTrafficBadgeType() }}"
                      text="{{ $school->getTrafficTitle() }}"
                    />
                  </td>
                  <td class="text-center">
                    <x-core::badge
                      type="{{ $school->getStatusBadgeType() }}"
                      text="{{ $school->getStatus() }}"
                    />
                  </td>
                  <td class="text-center"> @jalaliDate($school->created_at)</td>
                  <td class="text-center">
                    <x-core::show-button route="admin.schools.show" :model="$school"/>
                    <x-core::edit-button route="admin.schools.edit" :model="$school"/>
                    <x-core::delete-button route="admin.schools.destroy" :model="$school"/>
                  </td>
                </tr>
              @empty
                <x-core::data-not-found-alert :colspan="10"/>
              @endforelse
              </tbody>
            </table>
            {{ $schools->onEachSide(0)->links("vendor.pagination.bootstrap-4") }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
