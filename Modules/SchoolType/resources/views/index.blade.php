@extends('core::layouts.admin.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home ml-1"></i> داشبورد </a>
      </li>
      <li class="breadcrumb-item active">لیست انواع مدسه</li>
    </ol>
    <button class="btn btn-indigo" data-target="#createSchoolTypeModal" data-toggle="modal">
      ثبت نوع مدرسه جدید
      <i class="fa fa-plus mr-1"></i>
    </button>
  </div>
  <div class="card">
    <div class="card-header border-0">
      <p class="card-title"> لیست انواع مدسه ({{ $schoolTypesCount }}) </p>
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
                <th class="text-center">عنوان</th>
                <th class="text-center">وضعیت</th>
                <th class="text-center">تاریخ ثبت</th>
                <th class="text-center">عملیات</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($schoolTypes as $schoolType)
                <tr>
                  <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $schoolType->title }}</td>
                  <td class="text-center">
                    <x-core::badge
                      type="{{ $schoolType->getStatusBadgeType() }}"
                      text="{{ $schoolType->getSchoolTypeStatus() }}"
                    />
                  </td>
                  <td class="text-center"> @jalaliDate($schoolType->created_at)</td>
                  <td class="text-center">
                    <button
                      class="btn btn-sm btn-icon btn-warning text-white"
                      data-target="#editSchoolTypeModal-{{ $schoolType->id }}"
                      data-toggle="modal"
                      data-original-title="ویرایش">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <x-core::delete-button route="admin.school-types.destroy" :model="$schoolType"/>
                  </td>
                </tr>
              @empty
                <x-core::data-not-found-alert :colspan="5"/>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('schooltype::create-school-type-modal')
  @include('schooltype::edit-school-type-modal')

@endsection
