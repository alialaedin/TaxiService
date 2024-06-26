<form id="register-login" action="{{ route('family.register-login') }}" name="login" method="POST">
  @csrf

  <div class="row">

    <div class="p-4 pb-0 mt-5 text-center text-md-right">
      <span class="fs-24 font-weight-bold">خوش آمدید</span>
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
