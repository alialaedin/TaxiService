@extends('core::layouts.auth.family.master')
@section('content')
  <form id="send-token" class="p-4" action="{{ route('family.send-token') }}" method="POST">

    @csrf

    <div class="row">

      <div class="col-12">
        <div class="form-group">
          <span class="fs-24 font-weight-bold">خوش آمدید</span>
        </div>
      </div>

      <div class="col-12">
        <div class="form-group">
          <label for="mobile" class="mb-4">لطفا شماره موبایل خود را وارد کنید</label>
          <input name="mobile" class="form-control" type="text" id="mobile" maxlength="11">
          <x-core::show-validation-error name="mobile"/>
        </div>
      </div>

      <div class="col-12">
        <p class="font-light text-xs sm:text-sm text-center"> ورود شما به معنای پذیرش
          <a href="#" class="text-success" style="font-weight: 700;">شرایط وقوانین حریم‌خصوصی</a>
          است
        </p>
      </div>

      <div class="col-12 text-left">
        <button class="btn btn-light" style="border-radius: 50%;" id="submitButton" disabled>
          <i class="fe fe-arrow-left mt-1"></i>
        </button>
      </div>
    </div>

  </form>
@endsection
@section('scripts')
  <script>

    let submitButton = document.getElementById('submitButton');
    let mobile = document.getElementById('mobile');
    let errorSpan = document.getElementById('errorSpan');

    mobile.addEventListener('input', function () {

      if (this.value.length >= 11) {
        submitButton.removeAttribute('disabled');
        submitButton.classList.remove('btn-light');
        submitButton.classList.add('btn-primary');
      } else {
        submitButton.setAttribute('disabled', 'true');
        submitButton.classList.remove('btn-primary');
        submitButton.classList.add('btn-light');
      }
    });

  </script>

@endsection
