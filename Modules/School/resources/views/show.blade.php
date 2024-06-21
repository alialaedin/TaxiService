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
          <a href="{{ route('admin.schools.index') }}">لیست مدرسه ها</a>
        </li>
        <li class="breadcrumb-item active">نمایش مدرسه</li>
      </ol>

      <div class="d-flex align-items-center flex-wrap text-nowrap">
        <a href="{{ route('admin.schools.edit', $school) }}" class="btn btn-warning mx-1">
          ویرایش مدرسه
          <i class="fa fa-pencil mr-1"></i>
        </a>
        <button
          onclick="confirmDelete('delete-{{ $school->id }}')"
          class="btn btn-danger mx-1">
          حذف مدرسه
          <i class="fa fa-trash-o mr-1"></i>
        </button>
        <form
          action="{{ route('admin.schools.destroy', $school) }}"
          method="POST"
          id="delete-{{ $school->id }}"
          style="display: none">
          @csrf
          @method('DELETE')
        </form>
      </div>

    </div>

    <div class="card overflow-hidden">
      <div class="card-header border-0">
        <p class="card-title">اطلاعات مدرسه</p>
        <x-core::card-options/>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6 col-12">
            <ul class="list-group">
              <li class="list-group-item"><strong>کد : </strong> {{ $school->id }} </li>
              <li class="list-group-item"><strong>نام مدرسه : </strong> {{ $school->title }} </li>
              <li class="list-group-item"><strong>شماره تلفن مدرسه : </strong> {{ $school->telephone }} </li>
              <li class="list-group-item"><strong>نام و نام خانوادگی مدیر : </strong> {{ $school->manager_name }} </li>
              <li class="list-group-item"><strong>شماره موبایل مدیر : </strong> {{ $school->manager_mobile }} </li>
              <li class="list-group-item">
                <strong>وضعیت : </strong>
                <span @class([
                  'text-success' => $school->status,
                  'text-danger' => !$school->status])
                > {{ $school->getStatus() }}
                </span>
              </li>
              <li class="list-group-item"><strong>آدرس : </strong> {{ $school->address }} </li>
            </ul>
          </div>
          <div class="col-lg-6 col-12">
            <ul class="list-group">
              <li class="list-group-item"><strong>استان : </strong> {{ $school->city->province->name }} </li>
              <li class="list-group-item"><strong>شهر : </strong> {{ $school->city->name }} </li>
              <li class="list-group-item"><strong>نوع مدرسه : </strong> {{ $school->schoolType->title }} </li>
              <li class="list-group-item"><strong>شیفت کاری : </strong> {{ $school->shift->title }} </li>
              <li class="list-group-item"><strong>مقطع تحصیلی : </strong> {{ $school->educationLevel->title.' '.'('.$school->educationLevel->getGender().')' }} </li>
              <li class="list-group-item">
                <strong>ترافیکی : </strong>
                <span @class([
                  'text-success' => $school->is_traffic,
                  'text-danger' => !$school->is_traffic])
                > {{ $school->getTrafficTitle() }}
                </span>
              </li>
              <li class="list-group-item"><strong>تاریخ ثبت : </strong> @jalaliDate($school->created_at)</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
