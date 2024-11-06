<base href="/public">
<style>
  .col-md-6 {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
    width: 50%;
    margin-bottom: -10px;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px;
    margin-top: -7px;
    margin-left: -15px;
  }

  .labels {
    font-family: 'Khmer OS Battambang';
    padding: 9px 8px 6px 16px !important;
  }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-12 col-sm-12 col-12">
      <div class="page-title page-title-custom text-center">
        <h4 class="text-center">
          ពាក្យសុំចូលរៀន
        </h4>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <form id="frmDataCard" role="form" class="form-sample" enctype="multipart/form-data">
    <div class="card-body p-3">
      <div class="row">

        <div class="col-md-6 col-sm-12">
          <div class="form-group row">
            <input type="hidden" id="type" name="type" value="{{ $records->code ?? '' }}">
            <span class="labels col-sm-3 col-form-label">ខ្ញុំបាទ/នាងខ្ញុំឈ្មោះ<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name_2" name="name_2"
                value="{{ $records->name_2 ?? ''}}" placeholder="ឈ្មោះ ជាភាសាខ្មែរ" aria-label="ឈ្មោះ ជាភាសាខ្មែរ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">អក្សរឡាតាំង<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name" name="name"
                value="{{ $records->name ?? ''}}" placeholder="ឈ្មោះ ជាអក្សរឡាតាំង" aria-label="ឈ្មោះ ជាអក្សរឡាតាំង">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label dateInput">ថ្ងៃ ខែ ឆ្នាំកំណើត<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="date" class="form-control form-control-sm " min="1995-01-01" max="2010-12-31" id="date_of_birth" name="date_of_birth"
                value="{{ $records->date_of_birth ?? ''}}" placeholder="ថ្ងៃ ខែ ឆ្នាំកំណើត"
                aria-label="ថ្ងៃ ខែ ឆ្នាំកំណើត">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group row">
               <span class="labels col-sm-6 col-form-label">សញ្ជាតិ<strong style="color:red; font-size:15px;">
                   *</strong></span>
               <div class="col-sm-6">
                 <input type="text" class="form-control form-control-sm " id="" name=""
                   value="ខ្មែរ" placeholder="សញ្ជាតិ" aria-label="សញ្ជាតិ">
               </div>
             </div>
           </div>
           <div class="col-md-6 col-sm-12">
            <div class="form-group row">
              <span class="labels col-sm-3 col-form-label">ភេទ</span>
              <div class="col-sm-9">
                <select class="js-example-basic-single" id="gender" name="gender" style="width: 100%;">
                  <option value="ប្រុស" {{ isset($records->gender) && $records->gender ==  'ប្រុស' ? 'selected' : '' }}>ប្រុស</option>
                  <option value="ស្រី" {{ isset($records->gender) && $records->gender ==  'ស្រី' ? 'selected' : '' }}>ស្រី</option>
                </select>
              </div>
            </div>
           </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ទីកន្លែងកំណើត<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="student_address" name="student_address"
                value="{{ $records->student_address ?? ''}}" placeholder="ទីកន្លែងកំណើត" aria-label="ទីកន្លែងកំណើត">
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">អាសយដ្ឋានបច្ចុប្បន្ន<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="current_address" name="current_address"
                value="{{ $records->current_address ?? ''}}" placeholder="អាសយដ្ឋានបច្ចុប្បន្ន"
                aria-label="អាសយដ្ឋានបច្ចុប្បន្ន">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">មុខរបរ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="occupation" name="occupation"
                value="{{ $records->occupation ?? ''}}" placeholder="មុខរបរ" aria-label="មុខរបរ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">លេខទូរស័ព្ទ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="phone_student" name="phone_student"
                value="{{ $records->phone_student ?? ''}}" placeholder="លេខទូរស័ព្ទ" aria-label="លេខទូរស័ព្ទ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">អាណាព្យាបាល<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="guardian_name" name="guardian_name"
                value="{{ $records->guardian_name ?? ''}}" placeholder="អាណាព្យាបាល" aria-label="អាណាព្យាបាល">
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">លេខទូរស័ព្ទ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="guardian_phone" name="guardian_phone"
                value="{{ $records->guardian_phone ?? ''}}" placeholder="លេខទូរស័ព្ទ" aria-label="លេខទូរស័ព្ទ">
            </div>
          </div>
        </div>


        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ឈ្មោះឪពុក<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="father_name" name="father_name"
                value="{{ $records->father_name ?? ''}}" placeholder="ឈ្មោះឪពុក" aria-label="ឈ្មោះឪពុក">
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">មុខរបរ</span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="father_occupation" name="father_occupation"
                value="{{ $records->father_occupation ?? ''}}" placeholder="មុខរបរ" aria-label="មុខរបរ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">ឈ្មោះម្ដាយ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="mother_name" name="mother_name"
                value="{{ $records->mother_name ?? ''}}" placeholder="ឈ្មោះម្ដាយ" aria-label="ឈ្មោះម្ដាយ">
            </div>
          </div>
        </div>

        <div class="col-md-6 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">មុខរបរ</span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="mother_occupation" name="mother_occupation"
                value="{{ $records->father_occupation ?? ''}}" placeholder="មុខរបរ" aria-label="មុខរបរ">
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-12">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label">កម្រិតវប្បធម៌<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
                <select class="js-example-basic-single" id="education_Level" name="education_Level" style="width: 100%;">
                  <?php 
                    $options = [
                            '' => '',
                            'បឋមសិក្សាសិក្សាទុតិយភូមិ' => 'បឋមសិក្សាសិក្សាទុតិយភូមិ',
                            'មធ្យមសិក្សាទុតិយភូមិ' => 'មធ្យមសិក្សាទុតិយភូមិ',
                        ];
                    ?>
                  @foreach ($options as $value => $label)
                  <option value="{{ $value }}" {{ isset($records->education_Level) && $records->education_Level == $value ?
                    'selected' : '' }}>
                    {{ $label }}
                  </option>
                  @endforeach
                </select>

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="label col-sm-3 col-form-label">ជំនាញ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code"
                style="width: 100%;">
                <option value="">&nbsp;</option>
                @foreach ($skills as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) && $records->skills_code ==
                  $record->code ? 'selected' : '' }}>
                  {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="label col-sm-3 col-form-label">វេន<strong style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="sections_code" name="sections_code"
                style="width: 100%;">
                <option value="">&nbsp;</option>
                @foreach ($sections as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) && $records->sections_code
                  == $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="label col-sm-3 col-form-label">សុំចូលរៀនឆ្នាំទី<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="apply_year" name="apply_year"
                style="width: 100%;">
                <option value="">&nbsp;</option>
                @foreach ($study_years as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->apply_year) && $records->apply_year ==
                  $record->code ? 'selected' : '' }}>
                  {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="label col-sm-3 col-form-label ">កម្រិត<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single" id="qualification" name="qualification" style="width: 100%;">
                <?php 
                  $options = [
                         
                          'បរិញ្ញាបត្រ' => 'បរិញ្ញាបត្រ',
                          'បរិញ្ញាបត្ររង' => 'បរិញ្ញាបត្ររង',
                          'អនុបណ្ឌិត' => 'អនុបណ្ឌិត',
                          'បរិញ្ញាបត្រ C1' => 'បរិញ្ញាបត្រ C1',
                          'បរិញ្ញាបត្រ C2' => 'បរិញ្ញាបត្រ C2',
                          'បរិញ្ញាបត្រ C3' => 'បរិញ្ញាបត្រ C3',
                      ];
                  ?>
                @foreach ($options as $value => $label)
                <option value="{{ $value }}" {{ isset($records->qualification) && $records->qualification == $value ?
                  'selected' : '' }}>
                  {{ $label }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-12 d-flex justify-content-center mt-2">
            <button type="button" id="BtnSave" class="btn btn-success btn-icon-text btn-sm mb-2 text-center" style="width: 110px;">
                <i class="mdi mdi-content-save"></i> រក្សាទុក
            </button>
        </div>
      </div>

    </div>
    <div class="row border-bottom">
      <div class="col-md-12 col-sm-12 col-12">
        <div class="page-title page-title-custom">
          <div class="title-page text-center">
          </div>
        </div>
      </div><br><br><br>
    </div>
  </form>


  <!--Model--->
  @include('system.modal_create_user_student')
  <!--End Model-->
</div><br><br>
<script>
  $(document).ready(function() {
    $('#BtnSave').on('click', function() {
        var formData = $('#frmDataCard').serialize();
        var type = $('#type').val();
        var checkbox = $('#status');
        var status = checkbox.prop('checked') ? 'yes' : 'no';
        var url;
        if (!type) {
            url = '/student/registration/store?status=' + status;
        } else {
            url = '/student/registration/update?status=' + status;
        }
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status == 'success') {
                  notyf.success(response.msg);
                }else if(response.store == 'yes'){
                  window.location.href = '/thank-you-for-submit';
                }else {
                    notyf.error(response.msg);
                }
            }
        });
    });

    $(document).on('click', '#BtnCreateUser', function() {
      $("#btnYes").attr('data-code', $(this).attr('data-code'));
      $("#divCreateUser").modal('show');
    });

    $(document).on('click', '#btnYes', function() {
      var code = $(this).attr('data-code');
      var password = $("#password").val();
      var username = $("#username").val();
      $.ajax({
        type: "get",
        url: `/student/registration/create-user-account`,
        data: {
          code: code, password:password , username: username
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#divConfirmation").modal('hide');
            notyf.success(response.msg);
          }else{
            notyf.error(response.msg);
          }
        }
      });
    });

    $(document).on('click', '#btnClose', function() {
      $("#divCreateUser").modal('hide');
    });

    $('#name').on('input', function(){
        let inputValue = $(this).val();
        let uppercasedValue = inputValue.toUpperCase();
        $(this).val(uppercasedValue);
    });
    $('#name_2').on('input', function() {
        // Regular expression for Khmer Unicode range
        let khmerPattern = /^[\u1780-\u17FF\s]*$/;
        // Get current input value
        let inputValue = $(this).val();
        // Test if input matches Khmer characters and spaces
        if (!khmerPattern.test(inputValue)) {
            // Remove last character if it doesn't match Khmer characters
            $(this).val(inputValue.replace(/[^ឨ-៹\s]+$/, ''));
            // Show error message with Notyf
            notyf.error("សូមបំពេញឈ្មោះជាអក្សខ្មែរ");
        }
    });
    $('#name').on('input', function() {
        // Regular expression for English letters and spaces
        let englishPattern = /^[A-Za-z\s]*$/;
        
        // Get current input value
        let inputValue = $(this).val();
        
        // Test if input matches only English characters and spaces
        if (!englishPattern.test(inputValue)) {
            // Remove last character if it doesn't match English characters
            $(this).val(inputValue.replace(/[^A-Za-z\s]+$/, ''));
            
            // Show error message with Notyf
            notyf.error("សូម បំពេញជា ភាសាអង់គ្លេស");
        }
    });
    $('.dateInput').on('input', function() {
        const minDate = new Date("1990-01-01");
        const maxDate = new Date("2010-12-31");
        const selectedDate = new Date($(this).val());

        if (selectedDate < minDate) {
            $(this).val("1990-01-01");
        } else if (selectedDate > maxDate) {
            $(this).val("2010-12-31");
        }
    });
  });

  function DownlaodExcel() {
    var url = '/student/registration/downlaodexcel/';
    if ($('#search_data').val() == '') {
      data = $("#advance_search").serialize();
    } else {
      data = 'value=' + $('#search_data').val();
    }
    data = $("#advance_search").serialize();
    $.ajax({
      type: "post",
      url: url,
      data: data,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function() {
        // $.LoadingOverlay("show", {
        //   custom: loadingOverlayCustomElement
        // });
        // loadingOverlayCustomElement.text('Request Processing...');
      },
      success: function(response) {
        $.LoadingOverlay("hide", true);
        if (response.status == 'success') {
          $('#divPassword').modal('hide');
          location.href = response.path;
          // myfn.showNotify(response['status'], 'lime', 'top', 'right', response['message']);
        } else {
          $('.secure_msg').html(response.message);
          $('.secure_msg').show();
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {}
    });
  }
  function FieldRequired() {
    var inValid = false ;
    $('#frmDataCard').each(function (event) {
      var code = $('#code').val();
      if(!code){
          $('#code').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#code').removeClass('FieldRequired');
          inValid = false; 
      }
      var name = $('#name').val();
      if(!name){
          $('#name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#name').removeClass('FieldRequired');
          inValid = false; 
      }
      var name_2 = $('#name_2').val();
      if(!name_2){
          $('#name_2').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#name_2').removeClass('FieldRequired');
          inValid = false; 
      }
      var date_of_birth = $('#date_of_birth').val();
      if(!date_of_birth){
          $('#date_of_birth').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#date_of_birth').removeClass('FieldRequired');
          inValid = false; 
      }
      var phone_student = $('#phone_student').val();
      if(!phone_student){
          $('#phone_student').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#phone_student').removeClass('FieldRequired');
          inValid = false; 
      }
      var father_name = $('#father_name').val();
      if(!father_name){
          $('#father_name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#father_name').removeClass('FieldRequired');
          inValid = false; 
      }
      var mother_name = $('#mother_name').val();
      if(!mother_name){
          $('#mother_name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#mother_name').removeClass('FieldRequired');
          inValid = false; 
      }
      var father_occupation = $('#father_occupation').val();
      if(!father_occupation){
          $('#father_occupation').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#father_occupation').removeClass('FieldRequired');
          inValid = false; 
      }
      var mother_occupation = $('#mother_occupation').val();
      if(!mother_occupation){
          $('#mother_occupation').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#mother_occupation').removeClass('FieldRequired');
          inValid = false; 
      }
      var guardian_name = $('#guardian_name').val();
      if(!guardian_name){
          $('#guardian_name').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#guardian_name').removeClass('FieldRequired');
          inValid = false; 
      }
      var guardian_address = $('#guardian_address').val();
      if(!guardian_address){
          $('#guardian_address').addClass('FieldRequired');
          inValid = true; 
      } else{
          $('#guardian_address').removeClass('FieldRequired');
          inValid = false; 
      }

    });
    if(inValid){
        notyf.error('field is required');
    } 
    return inValid;

    
  }
</script>
@endsection