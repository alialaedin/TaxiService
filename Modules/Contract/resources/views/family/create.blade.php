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
                <button id="progress-step-1" class="px-lg-5 py-3 border-0 bg-info text-white">پذیرش قوانین</button>
              </li>
              <li>
                <button id="progress-step-2" class="px-lg-5 py-3 border-0 bg-transparent">انتخاب جنسیت</button>
              </li>
              <li>
                <button id="progress-step-3" class="px-lg-5 py-3 border-0 bg-transparent">نوع مدرس</button>
              </li>
              <li>
                <button id="progress-step-4" class="px-lg-5 py-3 border-0 bg-transparent">انتخاب مقطع مدرسه</button>
              </li>
              <li>
                <button id="progress-step-5" class="px-lg-5 py-3 border-0 bg-transparent">انتخاب مدرسه</button>
              </li>
              <li>
                <button id="progress-step-6" class="px-lg-5 py-3 border-0 bg-transparent">وارد کردن آدرس</button>
              </li>
              <li>
                <button id="progress-step-7" class="px-lg-5 py-3 border-0 bg-transparent">نوع سرویس</button>
              </li>
              <li>
                <button id="progress-step-8" class="px-lg-5 py-3 border-0 bg-transparent">انتخاب شرکت</button>
              </li>
              <li>
                <button id="progress-step-9" class="px-lg-5 py-3 border-0 bg-transparent">اطلاعات فرزند</button>
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
                          class="custom-control-input gender-radio"
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
                          class="custom-control-input school-type"
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
            </div>
            <div id="step-5-inputs" class="row d-none">
            </div>
            <div id="step-6-inputs" class="row d-none">
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

    let totalSteps = 9;
    let completedSteps = 0;
    let currentStep = 1;

    $(document).ready(function () {

      $('#rulesAndConditionCheckBox').on('change', function () {
        if ($(this).is(':checked')) {
          nextButton.prop('disabled', false);
          nextButton.removeClass('btn-gray').addClass('btn-primary');
        } else {
          nextButton.prop('disabled', true);
          nextButton.removeClass('btn-primary').addClass('btn-gray');
        }
      });

      nextButton.on('click', function () {

        let currentInputStep = $(`#step-${currentStep}-inputs`);
        let nextInputStep = $(`#step-${currentStep + 1}-inputs`);

        nextInputStep.removeClass('d-none');
        currentInputStep.addClass('d-none');

        if (currentStep - completedSteps === 1) {
          $(this).prop('disabled', true);
          $(this).removeClass('btn-primary').addClass('btn-gray');
        }

        if (totalSteps - completedSteps + 1 !== 1) {
          prevButton.prop('disabled', false);
          prevButton.removeClass('btn-gray').addClass('btn-primary');
        } else {
          prevButton.prop('disabled', true);
          prevButton.removeClass('btn-primary').addClass('btn-gray');
        }

        let currentProgressStepButton = $(`#progress-step-${currentStep}`);
        let nextProgressStepButton = $(`#progress-step-${currentStep + 1}`);

        currentProgressStepButton.removeClass('bg-info text-white');
        currentProgressStepButton.addClass('bg-transparent');

        nextProgressStepButton.removeClass('bg-transparent');
        nextProgressStepButton.addClass('bg-info text-white');

        if (currentStep - completedSteps === 1) {
          completedSteps++;
        }

        currentStep++;

        if (currentStep === 4) {
          loadEducationLevels();
        }

        if (currentStep === 5) {
          loadSchools();
        }

        if (currentStep === 8) {
          loadCompanies();
        }

      });

      prevButton.on('click', function () {

        let currentInputStep = $(`#step-${currentStep}-inputs`);
        let pervInputStep = $(`#step-${currentStep - 1}-inputs`);

        pervInputStep.removeClass('d-none');
        currentInputStep.addClass('d-none');

        currentStep--;

        if (totalSteps - currentStep === 8) {
          $(this).prop('disabled', true);
          $(this).removeClass('btn-primary').addClass('btn-gray');
        }

        if (currentStep - completedSteps !== 1) {
          nextButton.prop('disabled', false);
          nextButton.removeClass('btn-gray').addClass('btn-primary');
        }

        let currentProgressStepButton = $(`#progress-step-${currentStep + 1}`);
        let nextProgressStepButton = $(`#progress-step-${currentStep}`);

        currentProgressStepButton.removeClass('bg-info text-white');
        currentProgressStepButton.addClass('bg-transparent');

        nextProgressStepButton.removeClass('bg-transparent');
        nextProgressStepButton.addClass('bg-info text-white');

      });

      // function changeTheStepInput(step) {
      //   if (step <= completedSteps + 1) {
      //
      //     let currentProgressStepButton = $(`#progress-step-${currentStep}`);
      //     let nextProgressStepButton = $(`#progress-step-${step}`);
      //
      //     currentProgressStepButton.removeClass('bg-info text-white');
      //     currentProgressStepButton.addClass('bg-transparent');
      //
      //     nextProgressStepButton.removeClass('bg-transparent');
      //     nextProgressStepButton.addClass('bg-info text-white');
      //
      //     let currentInputStep = $(`#step-${currentStep}-inputs`);
      //     let nextInputStep = $(`#step-${step}-inputs`);
      //
      //     nextInputStep.removeClass('d-none');
      //     currentInputStep.addClass('d-none');
      //
      //     if (step === 1) {
      //       prevButton.prop('disabled', true);
      //       prevButton.removeClass('btn-primary').addClass('btn-gray');
      //     }
      //
      //     nextButton.prop('disabled', false);
      //     nextButton.removeClass('btn-gray').addClass('btn-primary');
      //
      //     currentStep = step;
      //
      //   }
      // }

    })

    function activeNextButton() {
      nextButton.prop('disabled', false);
      nextButton.removeClass('btn-gray').addClass('btn-primary');
    }

    function getCsrfToken() {
      return $('meta[name="csrf-token"]').attr('content');
    }

    function loadEducationLevels() {
      $.ajax({
        url: '{{ route("family.contracts.load-education-levels") }}',
        type: 'POST',
        data: {gender: $('.gender-radio:checked').val()},
        headers: {'X-CSRF-TOKEN': getCsrfToken()},
        success: function (educationLevels) {
          let content = `<div class="col-12 mb-3 form-label font-weight-bold">مقطع مدرسه را انتخاب کنید :</div>`;
          if (educationLevels === null) {
            content += `<div class="col-12 mb-3 alert alert-danger form-label font-weight-bold">مقطع مدرسه ای پیدا نشد! :</div>`;
          }else {
            educationLevels.forEach((educationLevel) => {
              content += `
              <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="form-group">
                  <div class="custom-controls-stacked">
                    <label class="custom-control custom-radio">
                      <input
                        type="radio"
                        onchange="activeNextButton()"
                        class="custom-control-input education-level"
                        name="education_level_id"
                        value="${educationLevel.id}"
                      >
                      <span class="custom-control-label">${educationLevel.title}</span>
                    </label>
                  </div>
                 </div>
               </div>
            `;
            });
          }
          $('#step-4-inputs').html(content);
        }
      });

      if (!$('.education-level:checked')) {
        nextButton.prop('disabled', true);
        nextButton.removeClass('btn-primary').addClass('btn-gray');
      }
    }

    function loadSchools() {
      $.ajax({
        url: '{{ route("family.contracts.load-schools") }}',
        type: 'POST',
        data: {
          school_type: $('.school-type:checked').val(),
          education_level: $('.education-level:checked').val(),
        },
        headers: {'X-CSRF-TOKEN': getCsrfToken()},
        success: function (schools) {
          let content = `<div class="col-12 mb-3 form-label font-weight-bold">مدرسه را انتخاب کنید :</div>`;
          if (schools === null) {
            content += `<div class="col-12 alert alert-danger mb-3 form-label font-weight-bold">مدرسه ای پیدا نشد! :</div>`;
          }else {
            schools.forEach((school) => {
              content += `
                  <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="form-group">
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio">
                          <input
                            type="radio"
                            onchange="activeNextButton()"
                            class="custom-control-input school"
                            name="school_id"
                            value="${school.id}"
                          >
                          <span class="custom-control-label">${school.title}</span>
                        </label>
                      </div>
                     </div>
                   </div>
                `;
            });
          }
          $('#step-5-inputs').html(content);
        }
      });
      if (!$('.school:checked')) {
        nextButton.prop('disabled', true);
        nextButton.removeClass('btn-primary').addClass('btn-gray');
      }
    }

    function loadCompanies() {
      $.ajax({
        url: '{{ route("family.contracts.load-companies") }}',
        type: 'POST',
        data: {
          school_id: $('.school:checked').val(),
        },
        headers: {'X-CSRF-TOKEN': getCsrfToken()},
        success: function (companies) {
          let content = `<div class="col-12 mb-3 form-label font-weight-bold">شرکت را انتخاب کنید :</div>`;
          if (companies === null) {
            content += `<div class="col-12 alert alert-danger mb-3 form-label font-weight-bold">شرکتی پیدا نشد! :</div>`;
          } else {
            companies.forEach((company) => {
              content += `
                  <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <div class="form-group">
                      <div class="custom-controls-stacked">
                        <label class="custom-control custom-radio">
                          <input
                            type="radio"
                            onchange="activeNextButton()"
                            class="custom-control-input company"
                            name="company_id"
                            value="${company.id}"
                          >
                          <span class="custom-control-label">${company.title}</span>
                        </label>
                      </div>
                     </div>
                   </div>
                `;
            });
          }
          $('#step-8-inputs').html(content);
        }
      });

      if (!$('.company:checked')) {
        nextButton.prop('disabled', true);
        nextButton.removeClass('btn-primary').addClass('btn-gray');
      }
    }

  </script>
@endsection
