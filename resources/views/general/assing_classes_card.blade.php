<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <a href="{{ url('classes') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
          {{ $_GET['type'] }} ឆ្នាំទី {{ $_GET['years'] }}
            @if ($records->exam_type == 'Yes')
                <label class="badge badge-success btn-sm mb-2 mb-md-0 me-2" id="exam_type">បានប្រលងបញ្ចាប់</label>
            @else
                <label class="badge badge-danger btn-sm mb-2 mb-md-0 me-2">   មិនទាន់ប្រលង  </label>
            @endif
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="btnShowMenuSetting" onclick="history.back()" href="javascript:void(0);"><i
              class="mdi mdi-keyboard-return"></i></a>
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
            <input type="hidden" id="id" name="id" value="{{ $records->id ?? ''}}">
            <span class="labels col-sm-3 col-form-label text-end">លោកគ្រូ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired form_data" id="teachers_code" name="teachers_code"
                style="width: 100%;" {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="">&nbsp;</option>
                @foreach ($teachers as $record)
                <option value="{{ $record->code ?? '' }}"
                  {{ isset($records->teachers_code) && $records->teachers_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->name : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ថា្នក់/ក្រុម<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">

              <select class="js-example-basic-single FieldRequired form_data readonly-select" id="class_code"
                name="class_code" style="width: 100%;" {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="">&nbsp;</option>
                @foreach ($classes as $record)
                <option value="{{ $record->code ?? '' }}"
                  {{ isset($records->class_code) && $records->class_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name) ? $record->name : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">វេន<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired form_data" id="sections_code" name="sections_code"
                style="width: 100%;" {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="">&nbsp;</option>
                @foreach ($sections as $record)
                <option value="{{ $record->code ?? '' }}"
                  {{ isset($records->sections_code) && $records->sections_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ជំនាញ<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired form_data" id="skills_code" name="skills_code"
                style="width: 100%;" {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="">&nbsp;</option>
                @foreach ($skills as $record)
                <option value="{{ $record->code ?? '' }}"
                  {{ isset($records->skills_code) && $records->skills_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ដេប៉ាតឺម៉ង់<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired form_data" id="department_code"
                name="department_code" style="width: 100%;" {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="">&nbsp;</option>
                @foreach ($department as $record)
                <option value="{{ $record->code ?? '' }}"
                  {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ឆ្នាំសិក្សា<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired form_data" id="session_year_code"
                name="session_year_code" style="width: 100%;" {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="">&nbsp;</option>
                @foreach ($session_years as $record)
                <option value="{{ $record->code ?? '' }}"
                  {{ isset($records->session_year_code) && $records->session_year_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->name) ? $record->name : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">មុខវិជ្ជា<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single FieldRequired form_data" id="subjects_code" name="subjects_code"
                style="width: 100%;" {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="">&nbsp;</option>
                @foreach ($subjects as $record)
                <option value="{{ $record->code ?? '' }}"
                  {{ isset($records->subjects_code) && $records->subjects_code == $record->code ? 'selected' : '' }}>
                  {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">សកម្មភាព<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single form_data" id="status" name="status" style="width: 100%;"
                {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="yes" {{ (isset($records->status) && $records->status == 'no') ? '' : 'selected' }}>yes
                </option>
                <option value="no" {{ (isset($records->status) && $records->status == 'no') ? 'selected' : '' }}>no
                </option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ឆមាស<strong style="color:red; font-size:15px;">
                *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single form_data" id="semester" name="semester" style="width: 100%;"
                {{ (count($recordsLine) > 0) ? 'disabled' : '' }}>
                <option value="1"
                  {{ (isset($records->semester) && $records->semester == '1') ? '' : 'selected' }}>ឆមាសទី ១</option>
                <option value="2"
                  {{ (isset($records->semester) && $records->semester == '2') ? 'selected' : '' }}>ឆមាសទី ២</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--- LINE FOR STUDENT --->

  <div class="page-head page-head-custom">
    <div class="row border-bottom p-2">
      <div class="col-md-6 col-sm-6  col-6">
        <div class="page-title page-title-custom">
          <div class="title-page">
            <a href="http://127.0.0.1:8000/classes"><i class="mdi mdi-format-list-bulleted"></i></a>
            និស្សិត
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="AssingStudentToClasses"
              href="javascript:;">
              <i class="mdi mdi-account-plus"></i> Add New
            </a>

            {{-- <button type="button" id="BtnDownlaodExcelLine"
              class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2 BtnDownlaodExcelLine">Excel <i
                class="mdi mdi-printer btn-icon-append"></i>
            </button> --}}

            <button type="button" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
              <i class="mdi mdi-printer btn-icon-append"></i>
            </button>

            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="attendantStudent"
                href="{{ url('get-attendant-student?assing_no=' . (isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '')) }}">
                Attendant
            </a>

            <a class="btn btn-success  btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="updatExamType"
                href="javasript:void(0)">
                បានប្រលងបញ្ចាប់
            </a>

          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-6">
        <div class="page-title page-title-custom text-right">
          <h4 class="text-right">
            <div class="form-group row">
              <span class="labels col-sm-7 col-form-label text-end"></span>
              <div class="col-sm-5">
                <select class="js-example-basic-single FieldRequired" id="Assingstudent" name="Assingstudent"
                  style="width: 100%;">
                  <option value="">&nbsp;</option>
                  @foreach ($Assingstudent as $record)
                  <option value="{{ $record->code ?? '' }}">{{ $record->name_2 ?? '' }}-{{ $record->name ?? '' }}
                  </option>
                  @endforeach
                </select>
              </div>
            </div>
          </h4>
        </div>
      </div>
    </div>
    @include('general.assing_classes_sub_line')
  </div>
</div>
<!--Model--->
<div class="modal fade" id="divConfirmation" tabindex="-1" role="dialog" aria-labelledby="divConfirmation"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-m-header">
        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
      </div>
      <div class="modal-body">
        <h4 class="modal-confirmation-text text-center p-4"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnYes" assing-no="{{ $_GET['assing_no'] ?? ''}}" data-classes="{{ $records->class_code ?? ''}}"
          skills-code="{{ $records->skills_code ?? '' }}" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!--DELIET LINE -->
<div class="modal fade" id="divConfirmationLine" tabindex="-1" role="dialog" aria-labelledby="divConfirmationLine"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-m-header">
        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
      </div>
      <div class="modal-body">
        <h4 class="modal-confirmation-text text-center p-4"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnYesLine" data-code="{{ $_GET['assing_no'] ?? '' }}" data-id=""
          class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!---DONWLOAD EXCEL-->
<div class="modal fade" id="ModelDownlaodExcelLine" tabindex="-1" role="dialog" aria-labelledby="ModelDownlaodExcelLine"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-m-header">
        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
      </div>
      <div class="modal-body">
        <h4 class="modal-confirmation-text text-center p-4"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnYesDownlaodExcelLine" data-code="{{ $_GET['assing_no'] ?? ''}}" data-id=""
          class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!---PRINT--->
<div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-m-header">
        <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
      </div>
      <div class="modal-body">
        <h4 class="modal-confirmation-text text-center p-4"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="YesPrints" data-code="{{ $_GET['assing_no'] ?? '' }}" data-id=""
          class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
<!---PRINT CONNECT--->
<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModelAttendantStudent" tabindex="-1" aria-labelledby="ModelAttendantStudent" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark modal-title-attendent" id="ModelAttendantStudent"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="content-attendant">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--END MODEL--->
<script>
  $(document).ready(function() {
    $('.form_data').on('change', function() {
      var formData = $('#frmDataCard').serialize();
      var type = $('#type').val();
      var type = "{{ isset($_GET['type']) ? addslashes($_GET['type']) : '' }}";
      var assing_no = "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}";
      if (!type) {
        if (FieldRequired()) return;
        url = `/assign-classes/store`;
      } else {
        url = `/assign-classes/update?qualification=${type}&assing_no=${assing_no}`;
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
          } else if (response.store == 'yes') {
            $('#frmDataCard')[0].reset();
            notyf.success(response.msg);
          } else {
            notyf.error(response.msg);
          }
        }
      });
    });
    $('#AssingStudentToClasses').on('click', function(e) {
      let class_code = $("#class_code").val();
      $(".modal-confirmation-text").html('បញ្ចាប់ថានិស្សិត​ ត្រូវបញ្ចូលតែដែរមានថ្នាក់​ ' + class_code);
      $("#btnYes").attr('assing-no', $(this).attr('assing-no'));
      $("#btnYes").attr('data-classes', $(this).attr('data-classes'));
      $("#divConfirmation").modal('show');
    });
    $(document).on('click', '#btnYes', function() {
      var assing_no = $(this).attr('assing-no');
      var class_code = $(this).attr('data-classes');
      var skills_code = $(this).attr('skills-code');
      $.ajax({
        type: "GET",
        url: `/assing-studnet-to-class`,
        data: {
          assing_no: assing_no,
          class_code: class_code,
          skills_code: skills_code
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#divConfirmation").modal('hide');
            notyf.success(response.msg);
            $('#recordsLineTableBody').empty();
            response.recordsLine.forEach(function(line) {
              var row = `
                        <tr>
                            <td>
                                <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="${line.student_code}">
                                    <i class="mdi mdi-delete-forever"></i> Delete
                                </button>
                            </td>
                            <td class="text-center">${line.student.code}</td>
                            <td class="text-center">${line.student.name_2 ?? ''}</td>
                            <td class="text-center">${line.student.name ?? ''}</td>
                            <td class="text-center">${line.student.gender ?? ''}</td>
                            <td class="text-center">${line.attendance ?? ''}</td>
                            <td class="text-center">${line.assessment ?? ''}</td>
                            <td class="text-center">${line.midterm ?? ''}</td>
                            <td class="text-center">${line.final ?? ''}</td>
                            <td class="text-center">${line.final ?? ''}</td>
                        </tr>
                    `;
              $('#recordsLineTableBody').append(row);
              window.location.reload();
            });
          }
        }
      });
    });
    $('.form_data_line').on('change', function() {
      var name = $(this).attr('name');
      var value = $(this).val();
      var id = $(this).attr('data-id');
      var student_code = $(this).attr('student-code');
      var assing_no = "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}";
      var url = '/assign-student-line/update?assing_line_no=' + assing_no + '&name=' + name + '&value=' +
        value + '&id=' + id + '&student_code=' + student_code;
      $.ajax({
        type: "POST",
        url: url,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.status == 'success') {
            notyf.success(response.msg);
            // Update total score dynamically based on the row context
            var row = $('tr[data-id="' + id + '"]');
            row.find('#total_score').text(response.total_score);
          } else {
            notyf.error(response.msg);
          }
        }
      });
    });
    $('.DeletDataLine').on('click', function(e) {
      $(".modal-confirmation-text").html('បញ្ចាប់ថានិស្សិត​ ត្រូវ លុប​!​');
      $("#btnYesLine").attr('data-id', $(this).attr('data-id'));
      $("#divConfirmationLine").modal('show');
    });
    $(document).on('click', '#btnYesLine', function() {
      var id = $(this).attr('data-id');
      $.ajax({
        type: "get",
        url: `/assign-classes-delete-studnet-line`,
        data: {
          id: id
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#divConfirmationLine").modal('hide');
            $("#rowLine" + id).remove();
            notyf.success(response.msg);
          }
        }
      });
    });
    $('#Assingstudent').on('change', function() {
      var code = $(this).val();
      $.ajax({
        type: "get",
        url: `/assign-student-line-by-code`,
        data: {
          code: code
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#divConfirmationLine").modal('hide');
            // $("#rowLine" + id).remove();
            notyf.success(response.msg);
          } else if (response.status == 'error') {
            notyf.error(response.msg);
          }
        }
      });
    });
    $(document).on('click', '.BtnDownlaodExcelLine', function() {
      $(".modal-confirmation-text").html('Do you want to Downlaod Excel ?');
      $("#btnYesDownlaodExcelLine").attr('data-code', $(this).attr('data-type'));
      $("#ModelDownlaodExcelLine").modal('show');
    });
    $(document).on('click', '#btnYesDownlaodExcelLine', function() {
      DownlaodExcel();
    });
    $(document).on('click', '#prints', function() {
      $(".modal-confirmation-text").html('Do you want to Downlaod prints ?');
      $("#YesPrints").attr('data-code', $(this).attr('data-type'));
      $("#ModelPrints").modal('show');
    });
    $(document).on('click', '#YesPrints', function() {
      var assing_no = $(this).attr('data-code');
      var url = '/assign-student-print-print?assing_no=' + assing_no + '&type=is_print';
      data = $("#advance_search").serialize();
      $.ajax({
        type: 'get',
        url: url,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
          if (response.status != 'success') {
            $('.loader').hide();
            $('.print-content').printThis({});
            $('.print-content').html(response);
            $('#ModelPrints').modal('hide');
          } else {
            $('.loader').hide();
            notyf.error("Error: " + response.msg);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    });
    $(document).on('click', '#updatExamType', function() {
    $.get('/assign-classes-update-examtype', {
        assing_no: "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}"
        }, function(response) {
            if (response.status == 'success') {
                notyf.success(response.msg);
                $("label.badge-danger")
                    .text("បានប្រលងបញ្ចាប់")
                    .removeClass('badge-danger')
                    .addClass('badge-success')
                    .length || $("<label/>", {
                        class: "badge badge-success btn-sm mb-2 mb-md-0 me-2",
                        text: "បានប្រលងបញ្ចាប់"
                    }).appendTo("#statusContainer");
                $("#exam_type").text("បានប្រលងបញ្ចាប់");
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

  function FieldRequired() {
    var inValid = false;
    $('#frmDataCard').each(function(event) {
      var code = $('#code').val();
      var name = $('#name').val();
      var sections_code = $('#sections_code').val();
      if (!code) {
        $('#code').addClass('FieldRequired');
        description = "ត្រូវបំពេញ លេខកូដ​!";
        inValid = true;
      } else {
        $('#code').removeClass('FieldRequired');
        description = "ត្រូវបំពេញ លេខកូដ​!";
        inValid = false;
      }
      if (!name) {
        $('#name').addClass('FieldRequired');
        description = "ត្រូវបំពេញ Field Required !";
        inValid = true;
      } else {
        $('#name').removeClass('FieldRequired');
        description = "ត្រូវបំពេញ Field Required !";
        inValid = false;
      }
      if (!sections_code) {
        $('#sections_code').addClass('FieldRequired');
        description = "ត្រូវបំពេញ Field Required !";
        inValid = true;
      } else {
        $('#sections_code').removeClass('FieldRequired');
        description = "ត្រូវបំពេញ Field Required !";
        inValid = false;
      }
    });
    if (inValid) {
      notyf.error(description);
    }
    return inValid;
  }
</script>
@endsection
