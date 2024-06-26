@extends('core::layouts.auth.family.master')
@section('content')
  <form id="verify" class="p-4" action="{{ route('family.verify') }}" method="POST">

    @csrf

    <input type="hidden" value="{{ $mobile }}" name="mobile">

    <div class="row">

      <div class="col-12 text-right">
        <a href="{{ url()->previous() }}" class="bg-transparent">
          <i class="fe fe-arrow-right fs-22 font-weight-bold mt-1"></i>
        </a>
      </div>

      <div class="col-12 mt-3">
        <div class="form-group">
          <p class="fs-18 font-weight-bold">کد تایید را وارد کنید</p>
          <p class="">کد تایید را به شماره <strong>{{ $mobile }}</strong> فرستادیم</p>
          <p class="mt-4">شماره موبایل اشتباه است ؟
            <a href="{{ url()->previous() }}" class="text-info">ویرایش</a>
          </p>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <input name="sms_token" class="form-control" type="text" id="sms_token">
          <x-core::show-validation-error name="sms_token"/>
        </div>
      </div>

      <div class="col-12">
        <div class="submit">
          <button class="btn btn-primary btn-block">ورود</button>
        </div>
      </div>

      <div class="col-12 mt-4">
        <a href="{{ route('family.resend-token', $mobile) }}" class="text-info">ارسال مجدد کد تایید</a>
      </div>

    </div>

  </form>
@endsection
