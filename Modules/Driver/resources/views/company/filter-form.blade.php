<div class="card">
  <div class="card-header border-0">
    <p class="card-title">جستجوی پیشرفته</p>
    <x-core::card-options/>
  </div>
  <div class="card-body">
    <div class="row">
      <form action="{{ route("company.drivers.index") }}" class="col-12">
        <div class="row">
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="name">نام و نام خانوادگی :</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="mobile">شماره موبایل :</label>
              <input type="text" id="mobile" name="mobile" class="form-control" value="{{ request('mobile') }}">
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="status">انتخاب وضعیت :</label>
              <select id="status" name="status" class="form-control">
                <option value="" class="text-muted"> همه </option>
                @foreach(config('driver.statuses') as $name => $label)
                  <option value="{{ $name }}" @selected(request('gender') == $name)> {{ $label }} </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="gender">انتخاب جنسیت :</label>
              <select id="gender" name="gender" class="form-control">
                <option value="" class="text-muted"> همه </option>
                @foreach(config('driver.genders') as $name => $label)
                  <option value="{{ $name }}" @selected(request('gender') == $name)> {{ $label }} </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-xl-9 col-lg-8 col-md-6 col-12">
            <button class="btn btn-primary btn-block" type="submit">جستجو <i class="fa fa-search"></i></button>
          </div>

          <div class="col-xl-3 col-lg-4 col-md-6 col-12">
            <a href="{{ route("company.drivers.index") }}" class="btn btn-danger btn-block">حذف همه فیلتر ها <i class="fa fa-close"></i></a>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
