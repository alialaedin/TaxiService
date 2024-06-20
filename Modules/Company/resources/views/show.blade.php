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
              <li class="list-group-item">
                <strong>لوگو : </strong>
                <figure class="figure mb-0">
                  <a target="_blank" href="{{ Storage::url($company->logo) }}">
                    <img src="{{ Storage::url($company->logo) }}" class="img-thumbnail" alt="{{ $company->title }}"
                         width="50" style="max-height: 35.5px;"/>
                  </a>
                </figure>
              </li>
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
              <li class="list-group-item">
                <strong>فایل رزومه : </strong>
                <a href="{{ Storage::url($company->resume) }}" class="btn btn-sm btn-icon btn-outline-success text-center" download>
                  <i class="fe fe-download ml-1"></i>دانلود فایل
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
