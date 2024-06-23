<div class="card">
  <div class="card-header border-0">
    <p class="card-title">جستجوی پیشرفته</p>
    <x-core::card-options/>
  </div>
  <div class="card-body">
    <div class="row">
      <form action="{{ route("admin.drivers.index") }}" class="col-12">
        <div class="row">
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="name">نام و نام خانوادگی :</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
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
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="company_id">شرکت :</label>
              <select id="company_id" name="company_id" class="form-control">
                <option value="" class="text-muted"> انتخاب شرکت </option>
                @foreach($companies as $company)
                  <option
                    value="{{ $company->id }}"
                    @selected(request('company_id') == $company->id )>
                    {{ $company->title }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <x-core::filter-buttons table="drivers"/>
      </form>
    </div>
  </div>
</div>
