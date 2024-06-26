@extends('core::layouts.auth.family.master')
@section('content')
  <form class="p-4" action="{{ route('family.register') }}" method="POST">

    @csrf

    <input type="hidden" value="{{ $mobile }}" name="mobile">

    <div class="row">

      <div class="col-12">
        <p>خوش آمدید! برای ثبت نام فرم زیر را پر کنید.</p>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="mobile">شماره موبایل :<span class="text-danger">&starf;</span></label>
          <input name="mobile" class="form-control" type="text" id="mobile" value="{{ $mobile }}" readonly>
          <x-core::show-validation-error name="mobile"/>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="name">نام و نام خانوادگی :<span class="text-danger">&starf;</span></label>
          <input name="name" class="form-control" type="text" id="name">
          <x-core::show-validation-error name="name"/>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="email">آدرس ایمیل</label>
          <input name="email" class="form-control" type="email" id="email">
          <x-core::show-validation-error name="email"/>
        </div>
      </div>

      <div class="col-12">
        <div class="submit">
          <button class="btn btn-success btn-block">ثبت نام</button>
        </div>
      </div>

    </div>

  </form>
@endsection

