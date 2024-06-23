<div class="card">
  <div class="card-header border-0">
    <p class="card-title">جستجوی پیشرفته</p>
    <x-core::card-options/>
  </div>
  <div class="card-body">
    <div class="row">
      <form action="{{ route("admin.schools.index") }}" class="col-12">
        <div class="row">
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="title">عنوان مدرسه :</label>
              <input type="text" id="title" name="title" class="form-control" value="{{ request('title') }}">
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="telephone">شماره تلفن :</label>
              <input type="text" id="telephone" name="telephone" class="form-control" value="{{ request('telephone') }}">
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="status">انتخاب وضعیت :</label>
              <select id="status" name="status" class="form-control">
                <option value="" class="text-muted"> همه </option>
                <option value="1" @selected(request('status') == '1')> فعال </option>
                <option value="0" @selected(request('status') == '0')> غیر فعال </option>
              </select>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="is_traffic">ترافیکی :</label>
              <select id="is_traffic" name="is_traffic" class="form-control">
                <option value="" class="text-muted"> همه </option>
                <option value="1" @selected(request('is_traffic') == '1')> باشد </option>
                <option value="0" @selected(request('is_traffic') == '0')> نباشد </option>
              </select>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="shift_id">شیفت :</label>
              <select id="shift_id" name="shift_id" class="form-control">
                <option value="" class="text-muted"> انتخاب شیفت </option>
                @foreach($shifts as $shift)
                  <option
                    value="{{ $shift->id }}"
                    @selected(request('shift_id') == $shift->id )>
                    {{$shift->title}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="school_type_id">نوع مدرسه :</label>
              <select id="school_type_id" name="school_type_id" class="form-control">
                <option value="" class="text-muted"> انتخاب نوع مدرسه </option>
                @foreach($schoolTypes as $schoolType)
                  <option
                    value="{{ $schoolType->id }}"
                    @selected(request('school_type_id') == $schoolType->id )>
                    {{$schoolType->title}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 ">
            <div class="form-group">
              <label for="education_level_id">مقطع تحصیلی :</label>
              <select id="education_level_id" name="education_level_id" class="form-control">
                <option value="" class="text-muted"> انتخاب مقطع تحصیلی </option>
                @foreach($educationLevels as $educationLevel)
                  <option
                    value="{{ $educationLevel->id }}"
                    @selected(request('education_level_id') == $educationLevel->id )>
                    {{$educationLevel->title.' '.'('.$educationLevel->getGender().')'}}
                  </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <x-core::filter-buttons table="schools"/>
      </form>
    </div>
  </div>
</div>
