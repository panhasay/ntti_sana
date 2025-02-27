<base href="/public">
<style>
   .select2-container--default .select2-dropdown {
        font-size: .8125rem;
        z-index: 9999999999 !important;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <a href="{{ url('skills') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
          @if($type == 'ed')
          កែប្រែ, ជំនាញ {{ $records->name_2 ?? '' }}
          @else
          បន្ថែមថ្មី
          @endif
          &nbsp;&nbsp; <button type="button" id="BtnSave" class="btn btn-success"> save </button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="btnShowMenuSetting" href="{{ url('skills') }}"><i class="mdi mdi-keyboard-return"></i></a>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <form id="frmDataCard" role="form" class="form-sample" enctype="multipart/form-data">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group row">
            <input type="hidden" id="type" name="type" value="{{ $records->id ?? '' }}">
            <span class="labels col-sm-3 col-form-label text-end">ចាប់ផ្តើមអនុវត្ត<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="date" class="form-control form-control-sm " id="starting_date" name="starting_date"
                value="{{ $records->starting_date ?? ''}}" placeholder="ចាប់ផ្តើមអនុវត្ត" aria-label="ចាប់ផ្តើមអនុវត្ត">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">បញ្ចប់នៅថ្ងៃ<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="date" class="form-control form-control-sm " id="ending_date" name="ending_date"
                value="{{ $records->ending_date ?? ''}}" placeholder="បញ្ចប់នៅថ្ងៃ" aria-label="បញ្ចប់នៅថ្ងៃ">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ថា្នក់/ក្រុម<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                style="width: 100%;">
                <option value="">&nbsp;</option>
                @foreach ($classs as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) && $records->class_code ==
                  $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name) ? $record->name : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ជំនាន់<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <input type="number" class="form-control form-control-sm " id="index_class" name="index_class"
                value="{{ $records->index_class ?? ''}}" placeholder="ជំនាន់" aria-label="ជំនាន់">
            </div>
          </div>
        </div>

      </div>
    </div>
  </form>
</div>


<div class="container-fluid p-2">
  <div class="row">
    <div class="col-md-5 col-sm-6 col-6">
      <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="AddgroupSana" href="javascript:void(0);"><i
          class="mdi mdi-account-plus"></i>បន្ថែមក្រុម</a>
      <button type="button" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
        <i class="mdi mdi-printer btn-icon-append"></i>
      </button>
    </div>
    <div class="col-md-4 col-sm-6 col-6 khmer_os_b title-page">
      តារាងបែងចែកក្រុមនិស្សឹតសរសេរសារណា
    </div>
  </div>
</div>
@include('system.model_group_student_sana')
@include('system.model_student_sana')
@include('general.student_sana_sub_lists')

<script>
  $(document).ready(function() {
    $('#BtnSave').on('click', function() {
      var formData = $('#frmDataCard').serialize();
      var type = $('#type').val();
      var url;
      if (!type) {
          url = `/skills/store`;
      } else {
          url = `/skills/update`;
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

    $(document).on('click', '#AddgroupSana', function() {
      $('#teacher_leader_code').select2({
          dropdownParent: $('#ModalCreateStudentSana') 
      });
      $('#teacher_consult_code').trigger('change');
      $("#ModalCreateStudentSana #frmDataSublist")[0].reset();
      $('#ModalCreateStudentSana #teacher_leader_code').val(null).trigger('change'); 
      $('#ModalCreateStudentSana #teacher_consult_code').val(null).trigger('change'); 
      $("#ModalCreateStudentSana").modal('show');
      let data_years = $(this).attr('data-years');
      let data_type = $(this).attr('data-type');
      $.ajax({
        type: "get",
        url: `/create-assing-classeds-newsss`,
        data: {
          data_type: data_type, data_years: data_years
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#ModalCreateAssign").modal('hide');
            location.reload();
            notyf.success(response.msg);
          }
        }
      });
    });

    $(document).on('click', '.BtnEditsubGroup', function () {
      var code = $(this).attr('data-code');
      let url = 'student-sana/update/student-sana/transaction?id=' + code;
      $('#frmDataSublist')[0].reset();
      $.ajax({
          type: 'get',
          url: url,
          beforeSend: function () {
              $('.loader').show();
          },
          success: function (response) {
              $('.loader').hide();
              if (response.status === "success") {
                  if (response.records) {
                      const records = response.records;
                      $('.sub_class_code').val(records.sub_class_code);
                      $('#topic').val(records.topic);

                   // Example data stored in the database
                    var storedData = response.storedData;
                    var storedDataName =  response.storedDataNameString;

                    // Convert string to an array and remove duplicates
                    var teacherCodes = storedData.split(",");
                    var teacherNames = storedDataName.split(",");

                    // Create an array of objects mapping codes to names
                    var teachers = [];
                    $.each(teacherCodes, function (index, code) {
                        if (!teachers.some(t => t.code === code)) { // Prevent duplicates
                            teachers.push({ code: code, name: teacherNames[index] });
                        }
                    });

                    // Append new options dynamically
                    $.each(teachers, function (index, teacher) {
                        $('#teacher_consult_code').append(
                            $('<option>', {
                                value: teacher.code,
                                text: teacher.name
                            }).prop('selected', true) // Select the appended options
                        );
                    });

                    // Refresh the Select2 dropdown if using Select2
                    $('#teacher_consult_code').trigger('change');


                      let $select = $('#teacher_leader_code');
                      $select.empty(); 
                      // Append default empty option
                      $('#teacher_leader_code').append(`<option value="${response.teachers_code}">${response.teachers_name}</option>`);
                      
                      // Loop through teachers and append options
                      if (Array.isArray(response.teachers)) {
                          $.each(response.teachers, function (index, teacher) {
                              $select.append(
                                  `<option value="${teacher.code}">${teacher.name_2 || ''}</option>`
                              );
                          });
                      }
                      // Select the teacher from records if available
                      if (records.teachers && records.teachers.code) {
                          $select.val(records.teachers.code).trigger('change');
                      }
                      $("#ModalCreateStudentSana").modal("show");
                  } else {
                      alert("No records found!");
                  }
              }
          },
          error: function (xhr, ajaxOptions, thrownError) {
              $('.loader').hide();
              console.error(thrownError);
          }
      });
    });

    $(document).on('click', '.btnEditStudentSana', function() {
      let dataId = $(this).attr('data-id'); 
      $.ajax({
          type: 'GET',
          url: 'student-sana/edit/student-sana/transaction?id=' + dataId, 
          beforeSend: function () {
              $('.loader').show(); 
          },
          success: function (response) {
              $('.loader').hide(); 
              if(response.status == 'success') {
                $('#ModalStudentSana').modal('show');
              }
              console.log(response);
          },
          error: function (xhr, ajaxOptions, thrownError) {
              $('.loader').hide(); 
              console.error('AJAX Error:', thrownError);
          }
      });
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
</script>
@endsection