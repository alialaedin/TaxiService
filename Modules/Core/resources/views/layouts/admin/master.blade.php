<!DOCTYPE html>
<html lang="fa" dir="rtl">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard." name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="keywords" content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>

		<title>@yield('title', config('app.name'))</title>

		@include("core::layouts.admin.includes.styles")

		@yield("styles")

	</head>

	<body class="app sidebar-mini color-menu">

		<div id="global-loader" >
			<img src="{{asset('assets/images/svgs/loader.svg')}}" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">

				@include("core::layouts.admin.includes.sidebar")
        @include("core::layouts.admin.includes.header")



				<div class="app-content px-5 py-1">

            @if($errors->any())
              @php
                toastr()->error('خطا در پردازش اطلاعات!')
              @endphp
          @endif

						@yield("content")

				</div>
			</div>

			@include("core::layouts.admin.includes.footer")

		</div>
		<a href="#" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

		@include("core::layouts.admin.includes.scripts")

		@yield("scripts")

	</body>
</html>
