<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>

  <!-- Meta data -->
  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
  <meta
    content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard."
    name="description">
  <meta content="Spruko Technologies Private Limited" name="author">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="keywords"
        content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>

  <!-- Title -->
  <title> ورود به پنل کاربری </title>
  <link href="{{asset('assets/font/font.css')}}" rel="stylesheet"/>
  <!--Favicon -->
  <link href="{{asset('assets/images/brand/favicon.ico')}}" rel="icon" type="image/x-icon"/>
  <!-- Bootstrap css -->
  <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet"/>
  <link href="{{asset('assets/css-rtl/style.css')}}" rel="stylesheet"/>
  <link href="{{asset('assets/css-rtl/style.css')}}" rel="stylesheet">
  <link href="{{asset('assets/css-rtl/dark.css')}}" rel="stylesheet"/>
  <link href="{{asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet"/>
  <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
  <!-- Animate css -->
  <link href="{{asset('assets/css-rtl/animated.cs')}}s" rel="stylesheet"/>
  <!---Icons css-->
  <link href="{{asset('assets/css-rtl/icons.css')}}" rel="stylesheet"/>
  <!-- Select2 css -->
  <link href="{{asset('assets/plugins/select2/select2.min.cs')}}s" rel="stylesheet"/>
  <!-- P-scroll bar css-->
  <link href="{{asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet"/>

  <style>
    .input {
      width: 40px;
      border: none;
      border-bottom: 3px solid rgba(0, 0, 0, 0.5);
      margin: 0 10px;
      text-align: center;
      font-size: 36px;
      cursor: not-allowed;
      pointer-events: none;
    }

    .input:focus {
      border-bottom: 3px solid orange;
      outline: none;
    }

    .input:nth-child(1) {
      cursor: pointer;
      pointer-events: all;
    }
  </style>

</head>

<body style="color: #000000;">

<div class="page login-bg">
  <div class="page-single">
    <div class="container">
      <div class="row">
        <div class="col mx-auto">
          <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
              <div class="card">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <span>اطلاعات وارد شده صحیح نمیباشد.</span>
                  </div>
                @endif

                <form class="card-body pt-0" id="login" action="" name="login" method="POST">
                  @csrf

                  <div class="row d-none" id="confirmationCodeBox"></div>

                  <div class="row" id="MobileInputBox">

                    <div class="p-4 pb-0 mt-5 text-center text-md-right">
                      <span class="fs-24 font-weight-bold">خوش آمدید</span>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label class="mb-4">لطفا شماره موبایل خود را وارد کنید</label>
                        <input name="mobile" class="form-control" type="text" id="mobileInput" maxlength="11">
                        <span id="errorSpan" class="text-danger mt-1 fs-12" style="display: none"></span>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Jquery js-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap4 js-->
<script src="{{ asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<!-- P-scroll js-->
<script src="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>
<!-- Custom js-->
<script src="{{ asset('assets/js/custom.js')}}"></script>

<script>

  function returnBack() {
    $('#MobileInputBox').removeClass('d-none');
    $('#confirmationCodeBox').addClass('d-none');
  }

  function inputKeyUp() {
    const inputs = document.getElementById("inputs");
    inputs.addEventListener("keyup", function (e) {
      const target = e.target;
      const key = e.key.toLowerCase();

      if (key == "backspace" || key == "delete") {
        target.value = "";
        const prev = target.previousElementSibling;
        if (prev) {
          prev.focus();
        }
        return;
      }
    });
  }

  function inputInput() {
    const inputs = document.getElementById("inputs");

    inputs.addEventListener("input", function (e) {
      const target = e.target;
      const val = target.value;

      if (isNaN(val)) {
        target.value = "";
        return;
      }

      if (val != "") {
        const next = target.nextElementSibling;
        if (next) {
          next.focus();
        }
      }
    });
  }

  function sendToken(mobile, event) {
    let token = $('meta[name="csrf-token"]').attr('content');

    return $.ajax({
      url: '{{ route("family.send-token") }}',
      type: 'POST',
      data: {mobile: mobile},
      headers: {'X-CSRF-TOKEN': token},
      success: function (response) {
        $('#MobileInputBox').addClass('d-none');

        let confirmationCodeBox = $('#confirmationCodeBox');

        confirmationCodeBox.removeClass('d-none');

        confirmationCodeBox.html(`
          <button class="btn bg-transparent mt-2 ml-2" type="button" onclick="returnBack()">
            <i class="fe fe-arrow-right"></i>
          </button>
          <p class="col-12 fs-20 font-weight-bold mx-1">کد تایید را وارد کنید</p>
          <p class="col-12 fs-14 mx-1">کد تایید را به شماره <strong>${mobile}</strong> فرستادیم</p>
          <p class="col-12 fs-14 mx-1">شماره موبایل اشتباه است ؟
            <a onclick="returnBack()" class="text-info" style="cursor: pointer">ویرایش</a>
          </p>

          <div class="col-12 d-flex justify-content-center align-items-center">
            <div id="inputs" class="inputs" oninput="inputInput()" onkeyup="inputKeyUp()">
                <input class="input" type="text" inputmode="numeric" maxlength="1"/>
                <input class="input" type="text" inputmode="numeric" maxlength="1"/>
                <input class="input" type="text" inputmode="numeric" maxlength="1"/>
                <input class="input" type="text" inputmode="numeric" maxlength="1"/>
                <input class="input" type="text" inputmode="numeric" maxlength="1"/>
                <input class="input" type="text" inputmode="numeric" maxlength="1"/>
            </div>
          </div>

        `);

        $('.input').style({
          'width': '40px',
          'border': 'none',
          'border-bottom': '3px solid rgba(0, 0, 0, 0.5)',
          'margin': '0 10px',
          'text-align': 'center',
          'font-size': '36px',
          'cursor': 'not-allowed',
          'pointer-events': 'none'
        });

        $('.input:nth-child(1)').style({
          'cursor': 'pointer',
          'pointer-events': 'all'
        });
        $('.input:focus').style({
          'border-bottom': '3px solid orange',
          'outline': 'none'
        });
      }
    });


  }

  let submitButton = document.getElementById('submitButton');
  let mobileInput = document.getElementById('mobileInput');
  let errorSpan = document.getElementById('errorSpan');

  mobileInput.addEventListener('input', function () {

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

  submitButton.addEventListener('click', function (e) {

    e.preventDefault();

    if (isNaN(mobileInput.value) || !mobileInput.value.startsWith('09')) {
      errorSpan.style.display = 'block';
      errorSpan.innerText = 'شماره موبایل صحیح نمی باشد!';
    } else if (mobileInput.value.length < 11 || mobileInput.value.length > 11) {
      errorSpan.style.display = 'block';
      errorSpan.innerText = 'شماره موبایل باید 11 رقم باشد!';
    } else {
      sendToken(mobileInput.value, e);
    }

  });

</script>

</body>
</html>
