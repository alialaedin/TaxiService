<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>

  @include('core::layouts.auth.family.includes.meta-tags')
  <title> ورود به پنل کاربری </title>
  @include('core::layouts.auth.family.includes.styles')

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
                    @foreach($errors->all() as $error)
                      <span>{{ $error }}</span>
                    @endforeach
                  </div>
                @endif

                @if(session()->has('error'))
                  <div class="alert alert-danger">
                    <span>{{ session()->get('error') }}</span>
                  </div>
                @endif

                @yield('content')

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('core::layouts.auth.family.includes.scripts')
@yield('scripts')
</body>
</html>

