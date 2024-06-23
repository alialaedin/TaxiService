<div class="card">
  <div class="card-header border-0">
    <p class="card-title">جستجوی پیشرفته</p>
    <x-core::card-options/>
  </div>
  <div class="card-body">
    <div class="row">
      <form action="{{ route("admin.companies.index") }}" class="col-12">
        <div class="row">
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="title">عنوان شرکت :</label>
              <input type="text" id="title" name="title" class="form-control" value="{{ request('title') }}">
            </div>
          </div>
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
              <label for="mobile">انتخاب وضعیت :</label>

              <select id="status" name="status" class="form-control">
                <option value=""> همه </option>
                <option value="1" @selected(old('status') == '1')> فعال </option>
                <option value="0" @selected(old('status') == '0')> غیر فعال </option>
              </select>
            </div>
          </div>
        </div>
        <x-core::filter-buttons table="companies"/>
      </form>
    </div>
  </div>
</div>
