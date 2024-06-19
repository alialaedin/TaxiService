<div class="modal fade" id="createShiftModal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content modal-content-demo">
      <div class="modal-header">
        <p class="modal-title" style="font-size: 20px;">ثبت شیفت جدید</p><button aria-label="Close" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.shifts.store') }}" method="post" class="save">
          @csrf
          <div class="row">

            <div class="col-md-12">
              <div class="form-group">
                <label for="title" class="control-label">عنوان :<span class="text-danger">&starf;</span></label>
                <input type="text" id="title" class="form-control" name="title" placeholder="عنوان شیفت را وارد کنید" value="{{ old('title') }}">
                <x-core::show-validation-error name="title" />
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label for="status" class="control-label">وضعیت :<span class="text-danger">&starf;</span></label>
                <select name="status" id="status" class="form-control">
                  <option value="" class="text-muted">وضعیت شیفت را انتخاب کنید</option>
                  @foreach(config('core.bool_statuses') as $value => $label)
                    <option value="{{ $value }}" @selected(old('status') == "$value")>{{ $label }}</option>
                  @endforeach
                </select>
                <x-core::show-validation-error name="status" />
              </div>
            </div>

          </div>

          <div class="row justify-content-center mt-2">
            <button class="btn btn-success mx-1" type="submit">ثبت و ذخیره</button>
            <button class="btn btn-danger mx-1" data-dismiss="modal">انصراف</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>