@extends('core::layouts.family.master')
@section('content')
  <div class="row justify-content-center">
    <div class="col-10">
      <div class="card">
        <div class="card-header border-bottom-0">
          <p class="card-title">ایجاد قرارداد</p>
        </div>
        <div class="card-body">

          <div>
            <ul class="list-group-item d-flex justify-content-center py-4">
              <li>
                <button id="progress-step-1" onclick="changeTheStepInput(1)"
                        class="px-5 py-3 border-0 bg-info text-white">پذیرش قوانین
                </button>
              </li>
              <li>
                <button id="progress-step-2" onclick="changeTheStepInput(2)" class="px-5 py-3 border-0 bg-transparent">
                  انتخاب جنسیت
                </button>
              </li>
              <li>
                <button id="progress-step-3" onclick="changeTheStepInput(3)" class="px-5 py-3 border-0 bg-transparent">
                  نوع مدرسه
                </button>
              </li>
              <li>
                <button id="progress-step-4" onclick="changeTheStepInput(4)" class="px-5 py-3 border-0 bg-transparent">
                  انتخاب مقطع مدرسه
                </button>
              </li>
              <li>
                <button id="progress-step-5" onclick="changeTheStepInput(5)" class="px-5 py-3 border-0 bg-transparent">
                  انتخاب مدرسه
                </button>
              </li>
              <li>
                <button id="progress-step-6" onclick="changeTheStepInput(6)" class="px-5 py-3 border-0 bg-transparent">
                  وارد کردن آدرس
                </button>
              </li>
              <li>
                <button id="progress-step-7" onclick="changeTheStepInput(7)" class="px-5 py-3 border-0 bg-transparent">
                  نوع سرویس
                </button>
              </li>
              <li>
                <button id="progress-step-8" onclick="changeTheStepInput(8)" class="px-5 py-3 border-0 bg-transparent">
                  انتخاب شرکت
                </button>
              </li>
              <li>
                <button id="progress-step-9" onclick="changeTheStepInput(9)" class="px-5 py-3 border-0 bg-transparent">
                  اطلاعات فرزند
                </button>
              </li>
            </ul>
          </div>

          <form style="margin-top: 3%;">

            <div id="step-1-inputs" class="row">

              <div class="col-12">
                <div class="form-group">
                  <label class="font-weight-bold">قوانین و مقررات :</label>
                  <textarea class="form-control"> {{ $rulesAndConditions }} </textarea>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group mb-0 justify-content-end">
                  <div class="">
                    <label class="custom-control custom-checkbox">
                      <input id="rulesAndConditionCheckBox" value="1" type="checkbox" class="custom-control-input">
                      <span class="custom-control-label">شرایط و قوانین را می پذیرم</span>
                    </label>
                  </div>
                </div>
              </div>

            </div>
            <div id="step-2-inputs" class="row d-none">
              <div class="col-12">
                <div class="form-group ">
                  <div class="form-label font-weight-bold">جنسیت فرزند خود را انتخاب کنید :</div>
                  <div class="custom-controls-stacked">
                    @foreach($genders as $gender)
                      <label class="custom-control custom-radio">
                        <input
                          type="radio"
                          onchange="activeNextButton()"
                          class="custom-control-input"
                          name="gender"
                          value="{{ $gender }}"
                        />
                        <span class="custom-control-label">{{ config('contract.genders.'.$gender) }}</span>
                      </label>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div id="step-3-inputs" class="row d-none">
              <div class="col-12">
                <div class="form-group ">
                  <div class="form-label font-weight-bold">نوع مدرسه را انتخاب کنید :</div>
                  <div class="custom-controls-stacked">
                    @foreach($schoolTypes as $schoolType)
                      <label class="custom-control custom-radio">
                        <input
                          type="radio"
                          onchange="activeNextButton()"
                          class="custom-control-input"
                          name="school_type_id"
                          value="{{ $schoolType->id }}"
                        />
                        <span class="custom-control-label">{{ $schoolType->title }}</span>
                      </label>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            <div id="step-4-inputs" class="row d-none">
              <div class="col-12">
                <div class="form-group ">
                  <div class="form-label font-weight-bold">مقطع مدرسه را انتخاب کنید :</div>
                  <div class="custom-controls-stacked">
                    @foreach($educationLevels as $educationLevel)
                      <label class="custom-control custom-radio">
                        <input
                          type="radio"
                          onchange="activeNextButton()"
                          class="custom-control-input"
                          name="education_level_id"
                          value="{{ $educationLevel->id }}"
                        />
                        <span class="custom-control-label">{{ $educationLevel->title }}</span>
                      </label>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>

          </form>

          <div class="d-flex justify-content-between mt-5">
            <button id="prevButton" class="btn btn-gray" disabled>قبلی</button>
            <button id="nextButton" class="btn btn-gray" disabled>بعدی</button>
          </div>

        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script>

    const nextButton = $('#nextButton');
    const prevButton = $('#prevButton');

    let counter = 1;
    let newNextCounter = 0;
    let newPrevCounter = 0;

    $(document).ready(function () {

      $('#rulesAndConditionCheckBox').on('change', function () {
        if ($(this).is(':checked')) {
          nextButton.prop('disabled', false);
          nextButton.removeClass('btn-gray');
          nextButton.addClass('btn-primary');
        } else {
          nextButton.prop('disabled', true);
          nextButton.removeClass('btn-primary');
          nextButton.addClass('btn-gray');
        }
      });

      nextButton.on('click', function () {

        let pervInputStep = $(`#step-${counter}-inputs`);
        let nextInputStep = $(`#step-${counter+1}-inputs`);

        let pervProgressStepButton = $(`#progress-step-${counter}`);
        let nextProgressStepButton = $(`#progress-step-${counter+1}`);

        nextInputStep.removeClass('d-none');
        pervInputStep.addClass('d-none');

        if (newNextCounter <= counter) {
          $(this).prop('disabled', true);
          $(this).removeClass('btn-primary');
          $(this).addClass('btn-gray');
        }else {
          newNextCounter = counter++;
        }


        if (newNextCounter !== 0) {
          prevButton.prop('disabled', false);
          prevButton.removeClass('btn-gray');
          prevButton.addClass('btn-primary');
        } else {
          prevButton.prop('disabled', true);
          prevButton.removeClass('btn-primary');
          prevButton.addClass('btn-gray');
        }

        pervProgressStepButton.removeClass('bg-info text-white');
        pervProgressStepButton.addClass('bg-transparent');

        nextProgressStepButton.removeClass('bg-transparent');
        nextProgressStepButton.addClass('bg-info text-white');
      });

      prevButton.on('click', function () {

        let pervInputStep = $(`#step-${counter}-inputs`);
        let nextInputStep = $(`#step-${counter-1}-inputs`);

        let pervProgressStepButton = $(`#progress-step-${counter}`);
        let nextProgressStepButton = $(`#progress-step-${counter-1}`);

        nextInputStep.removeClass('d-none');
        pervInputStep.addClass('d-none');

        if (newPrevCounter >= counter) {
          $(this).prop('disabled', true);
          $(this).removeClass('btn-primary');
          $(this).addClass('btn-gray');
        }else {
          newPrevCounter = counter--;
        }

        if (newPrevCounter === 0) {
          $(this).prop('disabled', true);
          $(this).removeClass('btn-primary');
          $(this).addClass('btn-gray');
        }

        nextButton.prop('disabled', false);
        nextButton.removeClass('btn-gray');
        nextButton.addClass('btn-primary');

        pervProgressStepButton.removeClass('bg-info text-white');
        pervProgressStepButton.addClass('bg-transparent');

        nextProgressStepButton.removeClass('bg-transparent');
        nextProgressStepButton.addClass('bg-info text-white');

      });

    });

    function changeTheStepInput(step) {
      if (step < counter) {
        let pervProgressStepButton = $(`#progress-step-${counter}`);
        let nextProgressStepButton = $(`#progress-step-${step}`);

        pervProgressStepButton.removeClass('bg-info text-white');
        pervProgressStepButton.addClass('bg-transparent');

        nextProgressStepButton.removeClass('bg-transparent');
        nextProgressStepButton.addClass('bg-info text-white');

        let pervInputStep = $(`#step-${counter}-inputs`);
        let nextInputStep = $(`#step-${step}-inputs`);

        nextInputStep.removeClass('d-none');
        pervInputStep.addClass('d-none');

        if (step === 1) {
          prevButton.prop('disabled', true);
          prevButton.removeClass('btn-primary');
          prevButton.addClass('btn-gray');
        }

        nextButton.prop('disabled', false);
        nextButton.removeClass('btn-gray');
        nextButton.addClass('btn-primary');

        counter = step;

      }
    }

    function activeNextButton() {
      nextButton.prop('disabled', false);
      nextButton.removeClass('btn-gray').addClass('btn-primary');
    }

  </script>
@endsection
