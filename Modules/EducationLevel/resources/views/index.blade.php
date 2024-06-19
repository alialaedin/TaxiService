@extends('core::layouts.admin.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home ml-1"></i> داشبورد </a>
      </li>
      <li class="breadcrumb-item active">لیست مقاطع تخصیلی</li>
    </ol>
    <button class="btn btn-indigo" data-target="#createEducationLevelModal" data-toggle="modal">
      ثبت مقطع تحصیلی جدید
      <i class="fa fa-plus mr-1"></i>
    </button>
  </div>
  <div class="card">
    <div class="card-header border-0">
      <p class="card-title"> لیست همه مقاطع تخصیلی ({{ $educationLevelsCount }}) </p>
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
                <th class="text-center">جنسیت</th>
                <th class="text-center">وضعیت</th>
                <th class="text-center">تاریخ ثبت</th>
                <th class="text-center">عملیات</th>
              </tr>
              </thead>
              <tbody>
              @forelse ($educationLevels as $educationLevel)
                <tr>
                  <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $educationLevel->title }}</td>
                  <td class="text-center">{{ $educationLevel->getGender() }}</td>
                  <td class="text-center">
                    <x-core::badge
                      type="{{ $educationLevel->getStatusBadgeType() }}"
                      text="{{ $educationLevel->getStatus() }}"
                    />
                  </td>
                  <td class="text-center"> @jalaliDate($educationLevel->created_at)</td>
                  <td class="text-center">
                    <button
                      class="btn btn-sm btn-icon btn-warning text-white"
                      data-target="#editEducationLevelModal-{{ $educationLevel->id }}"
                      data-toggle="modal"
                      data-original-title="ویرایش">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <x-core::delete-button route="admin.education-levels.destroy" :model="$educationLevel"/>
                  </td>
                </tr>
              @empty
                <x-core::data-not-found-alert :colspan="6"/>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  @include('educationlevel::create-education-level-modal')
  @include('educationlevel::edit-education-level-modal')

@endsection
