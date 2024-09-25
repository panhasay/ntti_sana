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
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <a href="{{ url('student') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
            @if($type == 'cr')
              បន្ថែមថ្មី
            @else
              កែប្រែ |
            @endif
           {{ $records->name_2 ?? '' }} &nbsp;&nbsp; 
           <button type="button" id="BtnSave" class="btn btn-success btn-icon-text btn-sm mb-2 mb-md-0 me-2"><i class="mdi mdi-content-save"></i> save</button>
           <button type="button" id="BtnCreateUser" data-code="{{$records->code ?? ''}}" class="btn btn-dark btn-icon-text btn-sm mb-2 mb-md-0 me-2"><i class="mdi mdi-account"></i> create user</button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="btnShowMenuSetting" href="{{ url('/student') }}"><i class="mdi mdi-keyboard-return"></i></a>
        </h4>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <form id="frmDataCard" role="form" class="form-sample" enctype="multipart/form-data">
    <div class="col-lg-12 mx-auto">
      <!-- Accordion -->
      <div id="accordion_formData" class="accordion shadow">
        <div id="headingOne" class="card-header bg-white shadow-sm border-0">
          <h2 class="mb-0">
            <button type="button" data-toggle="collapse" data-target="#General" aria-expanded="true"
              aria-controls="General" class="btn text-dark font-weight-bold collapsible-link general-accordion">សិស្សទូទៅ</button>
          </h2>
        </div>
        <div id="General" aria-labelledby="headingOne" data-parent="#accordion_formData" class="collapse show">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <input type="hidden" name="type" id="type" value="{{ $records->code ?? '' }}">
                  <span class="labels col-sm-3 col-form-label text-end">អត្តលេខ<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm " id="code" name="code" value="{{ $records->code ?? ''}}"
                      placeholder="អត្តលេខ" aria-label="អត្តលេខ">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">គោត្តនាម និងនាម<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value="{{ $records->name_2 ?? '' }}"
                      placeholder="គោត្តនាម និងនាម" aria-label="គោត្តនាម និងនាម">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះជាឡាតាំង<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ $records->name ?? '' }}"
                      placeholder="ឈ្មោះជាឡាតាំង" aria-label="ឈ្មោះជាឡាតាំង">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end"><br>ថ្ងៃខែឆ្នាំកំណើត<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <span class="date-note">ថ្ងៃ-ខៃ-ឆ្នាំ</span>
                    <input type="date" class="form-control form-control-sm" id="date_of_birth" name="date_of_birth" value="{{ $records->date_of_birth ?? '' }}"
                      placeholder="ថ្ងៃខែឆ្នាំកំណើត" aria-label="ថ្ងៃខែឆ្នាំកំណើត">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">ថ្នាក់ / ក្រុម<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code" style="width: 100%;">
                      <option value="">&nbsp;</option>
                      @foreach ($class_record as $record) 
                        <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) && $records->class_code == $record->code ? 'selected' : '' }}>
                          {{ isset($record->code) ? $record->code : '' }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">លេខទូរស័ព្ទ<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm" id="phone_student" name="phone_student" value="{{ $records->phone_student ?? '' }}"
                      placeholder="លេខទូរស័ព្ទ" aria-label="លេខទូរស័ព្ទ">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">ជំនាញ<strong
                      style="color:red; font-size:15px;"> *</strong></span>
                  <div class="col-sm-9">
                    <select class="js-example-basic-single" id="skills_code" name="skills_code" style="width: 100%;">
                      <option value="">&nbsp;</option>
                      @foreach ($skills_records as $record)
                      <option value="{{ $record->code ?? '' }}"{{ isset($records->skills_code) && $records->skills_code ==  $record->code ? 'selected' : '' }}>
                        {{ $record->name ?? '' }} - {{ $record->name_2 ?? '' }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">                    
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">អ៊ីមែល</span>
                  <div class="col-sm-9">
                    <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ $records->email ?? '' }}"
                      placeholder="អ៊ីមែល" aria-label="អ៊ីមែល">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">ភេទ</span>
                  <div class="col-sm-9">
                    <select class="js-example-basic-single" id="gender" name="gender" style="width: 100%;">
                      <option value="ប្រុស" {{ isset($records->gender) && $records->gender ==  'ប្រុស' ? 'selected' : '' }}>Male-ប្រុស</option>
                      <option value="ស្រី" {{ isset($records->gender) && $records->gender ==  'ស្រី' ? 'selected' : '' }}>Female - ស្រី</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">អាស័យ​ដ្ឋាន​បច្ចុប្បន្ន</span>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm" id="student_address" name="student_address" value="{{ $records->student_address ?? '' }}"
                      placeholder="អាស័យ​ដ្ឋាន​បច្ចុប្បន្ន" aria-label="អាស័យ​ដ្ឋាន​បច្ចុប្បន្ន">
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  {{-- <span class="labels col-sm-3 col-form-label text-end">វេនសិក្សា</span> --}}
                  <div class="col-sm-9">
                    {{-- <select class="js-example-basic-single" id="sections_code" name="sections_id" style="width: 100%;">
                      <option value="">&nbsp;</option>
                        @foreach ($sections as $record)
                        <option value="{{ $record->code ?? '' }}"{{ isset($records->sections_code) && $records->sections_code  ==  $record->code ? 'selected' : '' }}>
                          {{ $record->section ?? '' }}
                      </option>
                      @endforeach
                    </select> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">ដេប៉ាដេម៉ង់</span>
                  <div class="col-sm-9">
                    <select class="js-example-basic-single" id="department_code" name="department_code" style="width: 100%;">
                      <option value="">&nbsp;</option>
                        @foreach ($department as $record)
                        <option value="{{ $record->code ?? '' }}"
                          {{ isset($records->department_code) && $records->department_code ==  $record->code ? 'selected' : '' }}
                          {{ isset(Auth::user()->childs) && Auth::user()->childs == $record->id ? 'selected' : '' }}
                           >
                          {{ $record->name_2 ?? '' }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <span class="labels col-sm-3 col-form-label text-end">សកម្មភាព</span>
                  <div class="col-sm-9">
                    <input class="form-check-input" type="checkbox" value="" id="status" name="status" {{ isset($records->status) && $records->status == 'yes' ? 'checked' : '' }}>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Accordion item 2 -->
      <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
        <h2 class="mb-0">
          <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
            aria-controls="collapseTwo"
            class="btn  collapsed text-dark font-weight-bold text-uppercase general-accordion">ពត៏មានអាណាព្យាបាល</button>
        </h2>
      </div>
      <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordion_formData" class="collapse show">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ ឪពុក<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="father_name" name="father_name" value="{{ $records->father_name ?? '' }}"
                    placeholder="ឈ្មោះ ឪពុក" aria-label="ឈ្មោះ ឪពុក">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ទូរស័ព្ទ ឪពុក</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="father_phone" name="father_phone" value="{{ $records->father_phone ?? '' }}"
                    placeholder="ទូរស័ព្ទ ឪពុក" aria-label="ទូរស័ព្ទ ឪពុក">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ ឪពុក ជាឡាតាំង</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="s" name="s" value=""
                    placeholder="ឈ្មោះជាឡាតាំង" aria-label="ឈ្មោះជាឡាតាំង">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">មុខរបរឪពុក<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="father_occupation" name="father_occupation" value="{{ $records->father_occupation ?? '' }}"
                    placeholder="មុខរបរឪពុក" aria-label="មុខរបរឪពុក">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ ម្ដាយ<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="mother_name" name="mother_name" value="{{ $records->mother_name ?? '' }}"
                    placeholder="ឈ្មោះ ម្ដាយ" aria-label="ឈ្មោះ ម្ដាយ">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ទូរស័ព្ទ ម្ដាយ</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="mother_phone" name="mother_phone" value="{{ $records->mother_phone ?? '' }}"
                    placeholder="ទូរស័ព្ទ ម្ដាយ" aria-label="ទូរស័ព្ទ ម្ដាយ">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ ម្ដាយ ជាឡាតាំង</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="p" name="p" value=""
                    placeholder="ឈ្មោះជាឡាតាំង" aria-label="ឈ្មោះជាឡាតាំង">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">មុខរបរម្ដាយ<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="mother_occupation" name="mother_occupation" value="{{ $records->mother_occupation ?? '' }}"
                    placeholder="មុខរបរឪពុក" aria-label="មុខរបរឪពុក">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ អាណាព្យាបាល<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="guardian_name" name="guardian_name" value="{{ $records->guardian_name ?? '' }}"
                    placeholder="ឈ្មោះ ម្ដាយ" aria-label="ឈ្មោះ ម្ដាយ">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">ទូរស័ព្ទ អាណាព្យាបាល</span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="guardian_phone" name="guardian_phone" value="{{ $records->guardian_phone ?? '' }}"
                    placeholder="ទូរស័ព្ទ អាណាព្យាបាល" aria-label="ទូរស័ព្ទ អាណាព្យាបាល">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">មុខរបរ អាណាព្យាបាល </span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="guardian_occupation" name="guardian_occupation" value="{{ $records->guardian_occupation ?? '' }}"
                    placeholder="មុខរបរ អាណាព្យាបាល" aria-label="មុខរបរ អាណាព្យាបាល ">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">អាសយដ្ឋាន អាណាព្យាបាល<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" id="guardian_address" name="guardian_address" value="{{ $records->guardian_address ?? '' }}"
                    placeholder="អាសយដ្ឋាន អាណាព្យាបាល" aria-label="អាសយដ្ឋាន អាណាព្យាបាល">
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- End -->
      <!-- Accordion item 3 -->
      <div id="headingThree" class="card-header bg-white shadow-sm border-0">
        <h2 class="mb-0">
          <button type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
            aria-controls="collapseThree"
            class="btn collapsed text-dark font-weight-bold text-uppercase collapsible-link general-accordion">ឆ្នាំ សិក្សា របស់សិស្ស</button>
        </h2>
      </div>
      <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordion_formData" class="collapse show">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">សិស្សឆ្នាំ<strong
                    style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                  <select class="js-example-basic-single" id="stu_y" name="stu_y" style="width: 100%;">
                    <option value="{{ $records->stu_y ?? '' }}">សិស្សឆ្នាំ {{ $records->stu_y ?? '' }}</option>
                    <option value="1">សិស្សឆ្នាំ 1</option>
                    <option value="2">សិស្សឆ្នាំ 2</option>
                    <option value="2">សិស្សឆ្នាំ 3</option>
                    <option value="2">សិស្សឆ្នាំ 4</option>
                    <option value="2">សិស្សឆ្នាំ 5</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <span class="labels col-sm-3 col-form-label text-end">បរិញ្ញាប័ត្ររង​ ឫ​​ បរិញ្ញាប័ត្រ</span>
                <div class="col-sm-9">
                <select class="js-example-basic-single" id="study_type" name="study_type" style="width: 100%;">
                  <option value="{{ $records->study_type ?? '' }}">{{ $records->study_type ?? '' }}</option>
                  <option value="បរិញ្ញាប័ត្រ">បរិញ្ញាប័ត្រ</option>
                  <option value="បរិញ្ញាប័ត្ររង">បរិញ្ញាប័ត្ររង</option>
                </select>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End -->
    </div>
  </form>
  <!--Model--->
  @include('system.modal_create_user_student')
  <!--End Model-->
</div><br><br>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#BtnSave').on('click', function() {
        var formData = $('#frmDataCard').serialize();
        var type = $('#type').val();
        var checkbox = $('#status');
        var status = checkbox.prop('checked') ? 'yes' : 'no';
        var url;
        if (!type) {
            if(FieldRequired()) return;
            url = '/student/store?status=' + status;
        } else {
            url = '/student/update?status=' + status;
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
                  $('#frmDataCard')[0].reset();
                  notyf.success(response.msg);
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
        url: `/student/create-user-account`,
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
  });
  function DownlaodExcel() {
    var url = '/student/downlaodexcel/';
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