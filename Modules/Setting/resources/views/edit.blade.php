@extends('core::layouts.admin.master')
@section('content')
  <div class="page-header">
    <ol class="breadcrumb align-items-center">
      <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}"><i class="fe fe-home ml-1"></i> داشبورد </a>
      </li>
      <li class="breadcrumb-item active">مدیریت تنظیمات</li>
    </ol>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route("admin.settings.update") }}" method="POST">
        @csrf
        @method("PATCH")
        <div class="row">
          @foreach ($groups as $group => $settings)
            <p class="header p-3 fs-20 font-weight-bold col-12">{{ $group }}</p>
            @foreach ($settings as $setting)
              @if(in_array($setting->type, ['text', 'number']))
                <div class="col-xl-4 col-lg-6 col-12">
                  <div class="form-group">
                    <label class="form-label" for="{{ $setting->name }}">{{ $setting->label }}</label>
                    <input
                      id="{{ $setting->name }}"
                      type="{{ $setting->type }}"
                      name="{{ $setting->name }}"
                      class="form-control"
                      value="{{ $setting->value }}"
                      @if ($setting->type == "number") min="0" @endif
                    />
                    <x-core::show-validation-error name="{{ $setting->name }}"/>
                  </div>
                </div>
              @elseif($setting->type == 'textarea')
                <div class="col-12">
                  <div class="form-group">
                    <label class="form-label" for="{{ $setting->name }}">{{ $setting->label }}</label>
                    <textarea
                      class="form-control"
                      name="{{ $setting->name }}"
                      id="{{ $setting->name }}">
                      {!! $setting->value !!}
                    </textarea>
                    <x-core::show-validation-error name="{{ $setting->name }}"/>
                  </div>
                </div>
              @endif
            @endforeach
          @endforeach
        </div>
        <x-core::update-button/>
      </form>
    </div>
  </div>

@endsection
