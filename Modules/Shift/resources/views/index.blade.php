@extends('core::layouts.admin.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home ml-1"></i> داشبورد </a>
      </li>
      <li class="breadcrumb-item active">لیست شیفت ها</li>
    </ol>
    <button class="btn btn-indigo" data-target="#createShiftModal" data-toggle="modal">
      ثبت شیفت جدید
      <i class="fa fa-plus mr-1"></i>
    </button>
  </div>
  <div class="card">
    <div class="card-header border-0">
      <p class="card-title"> لیست همه شیفت ها ({{ $shiftsCount }}) </p>
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
              @forelse ($shifts as $shift)
                <tr>
                  <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $shift->title }}</td>
                  <td class="text-center">
                    <x-core::badge
                      type="{{ $shift->getStatusBadgeType() }}"
                      text="{{ $shift->getShiftStatus() }}"
                    />
                  </td>
                  <td class="text-center"> @jalaliDate($shift->created_at)</td>
                  <td class="text-center">
                    <button
                      class="btn btn-sm btn-icon btn-warning text-white"
                      data-target="#editShiftModal-{{ $shift->id }}"
                      data-toggle="modal"
                      data-original-title="ویرایش">
                      <i class="fa fa-pencil"></i>
                    </button>
                    <x-core::delete-button route="admin.shifts.destroy" :model="$shift"/>
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

  @include('shift::create-shift-modal')
  @include('shift::edit-shift-modal')

@endsection