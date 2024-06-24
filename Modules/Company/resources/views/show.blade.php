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
        <a href="{{ route('admin.companies.index') }}">لیست شرکت ها</a>
      </li>
      <li class="breadcrumb-item active">نمایش شرکت</li>
    </ol>

    <div class="d-flex align-items-center flex-wrap text-nowrap">
      <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-warning mx-1">
        ویرایش شرکت
        <i class="fa fa-pencil mr-1"></i>
      </a>
      <button
        onclick="confirmDelete('delete-{{ $company->id }}')"
        class="btn btn-danger mx-1">
        حذف شرکت
        <i class="fa fa-trash-o mr-1"></i>
      </button>
      <form
        action="{{ route('admin.companies.destroy', $company) }}"
        method="POST"
        id="delete-{{ $company->id }}"
        style="display: none">
        @csrf
        @method('DELETE')
      </form>
    </div>

  </div>
  <div class="card overflow-hidden">
    <div class="card-header border-0">
      <p class="card-title">اطلاعات شرکت</p>
      <x-core::card-options/>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6 col-12">
          <ul class="list-group">
            <li class="list-group-item"><strong>کد : </strong> {{ $company->id }} </li>
            <li class="list-group-item"><strong>عنوان شرکت : </strong> {{ $company->title }} </li>
            <li class="list-group-item"><strong>نام و نام خانوادگی : </strong> {{ $company->name }} </li>
            <li class="list-group-item"><strong>نام کاربری : </strong> {{ $company->username }} </li>
            <li class="list-group-item"><strong>شماره موبایل : </strong> {{ $company->mobile }} </li>
            <li class="list-group-item"><strong>شماره تلفن : </strong> {{ $company->telephone }} </li>
            <li class="list-group-item"><strong>آدرس : </strong> {{ $company->address }} </li>
          </ul>
        </div>
        <div class="col-lg-6 col-12">
          <ul class="list-group">
            <li class="list-group-item"><strong>استان : </strong> {{ $company->city->province->name }} </li>
            <li class="list-group-item"><strong>شهر : </strong> {{ $company->city->name }} </li>
            <li class="list-group-item"><strong>شماره حساب : </strong> {{ $company->account_number }} </li>
            <li class="list-group-item"><strong>شماره کارت : </strong> {{ $company->card_number }} </li>
            <li class="list-group-item"><strong>شماره شبا : </strong> {{ $company->sheba_number }} </li>
            <li class="list-group-item">
              <strong>وضعیت : </strong>
              <span @class([
                  'text-success' => $company->status,
                  'text-danger' => !$company->status])
                > {{ $company->getStatus() }}
                </span>
            </li>
            <li class="list-group-item"><strong>تاریخ ثبت : </strong> @jalaliDate($company->created_at)</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="card overflow-hidden">
    <div class="card-header border-0">
      <p class="card-title">رزومه</p>
      <x-core::card-options/>
    </div>
    <div class="card-body">
      <p> {{ $company->resume }} </p>
    </div>
  </div>
  <div class="card overflow-hidden">
    <div class="card-header border-0">
      <p class="card-title">لیست مدرسه ها</p>
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
              </tr>
              </thead>
              <tbody>
              @forelse ($company->schools as $school)
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
                </tr>
              @empty
                <x-core::data-not-found-alert :colspan="10"/>
              @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
