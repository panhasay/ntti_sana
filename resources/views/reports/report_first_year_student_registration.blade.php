<style>
    .btn.btn-sm {
      font-size: 11px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 28px;
      margin-top: -7px;
    }
    .general-data>td {
      padding: 16px;
    }
    .page-header {
        padding: 1px !important;
        border-bottom: 1px solid #fff !important;
    }
  </style>
  @extends('app_layout.app_layout')
  @section('content')
  <div class="title-report mt-3"> ស្ថិតិសិស្សដាក់ពាក្យចុះឈ្មោះចូលរៀនឆ្នាំទី១</div>
  <!--option--->
  <div class="page-header flex-wrap">
    <div class="header-left">
      <button data-page="student" id="btn-priview" type="button" class="btn btn-outline-primary btn-icon-text btn-sm">
        <i class="mdi mdi-eye"></i> Priview </button>
      <button type="button" onclick="prints()" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
        <i class="mdi mdi-printer btn-icon-append"></i>
        <button type="button" id="BtnDownlaodExcel"
          class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
            class="mdi mdi-printer btn-icon-append"></i> </button>
    </div>
    <div class="d-grid d-md-flex justify-content-md-end p-3">
      <div>
      </div>
      <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
        aria-expanded="true" aria-controls="collapseExample">
          Fliter
      </a>
    </div>
  </div>

  <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                
                <div class="col-sm-2">
                    <span class="labels">ដេប៉ាតឺម៉ង់</span>
                    <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($department as $record)
                        <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) &&
                            $records->department_code == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name_2) ? $record->name_2 : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2">
                    <span class="labels">ជំនាញ</span>
                    <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($skills as $record)
                        <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) &&
                            $records->skills_code == $record->code ? 'selected' : '' }}>
                             {{ isset($record->name_2) ? $record->name_2 : '' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2">
                    <span class="labels">កម្រិត</span>
                    <select class="js-example-basic-single FieldRequired" id="qualification" name="qualification"
                        style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($qualifications as $value => $label)
                            <option value="{{ $label->code }}" {{ isset($records->level) && $records->level ==
                                $label->code ? 'selected' : '' }}>
                                {{ $label->code ?? ''}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
            </div>
        </div>
    </div>
</form>

  <!---end option-->
  <div class="print" style="display: none">
    <div class="print-content">
  
    </div>
  </div>
  @include('system.modal_comfrim_delet')
  @include('reports.report_first_year_student_registration_list')
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      $(document).on('click', '#btnDelete', function() {
        $(".modal-confirmation-text").html('Do you want to delete?');
        $("#btnYes").attr('data-code', $(this).attr('data-code'));
        $("#divConfirmation").modal('show');
      });
      $(document).on('click', '#btnYes', function() {
        var code = $(this).attr('data-code');
        $.ajax({
          type: "POST",
          url: `/student/delete`,
          data: {
            code: code
          },
          success: function(response) {
            if (response.status == 'success') {
              $("#divConfirmation").modal('hide');
              $("#row" + code).remove();
              notyf.success(response.msg);
            }
          }
        });
      });
      $(document).on('click', '#btnClose', function(e) {
        $("#divConfirmation").modal('hide');
      });
      $(document).on('click', '#btn-priview', function() {
        let page = $(this).attr('data-page');
        let data = $('#advance_search').serialize();
        $.ajax({
          type: "GET",
          url: '/report-first-year-student-registration-priview?type=priview',
          data: data,
          beforeSend: function() {
            $('.loader').show();
          },
          success: function(response) {
            if (response.status == 'success') {
              $('.loader').hide();
              $('.control-table').html("");
              $('.control-table').html(response.view);
              $('.collapse').removeClass('show')
            } else {
              $('.loader').hide();
              notyf.error("Error: " + response.msg);
            }
          },
          error: function() { // Corrected error handling
            notyf.success("An error occurred during the request.");
            $('.loader').hide();
          }
        });
      });
      $(document).on('click', '#BtnDownlaodExcel', function() {
        Swal.fire({
            icon: 'warning',
            title: 'NTTI PORTAL',
            text: 'ប្រព័ន្ធ កំពុងដំណើរការ......!',
        });
        return false;
        $(".modal-confirmation-text").html('Do you want to Downlaod Excel ?');
        $("#btnYes").attr('data-code', $(this).attr('data-type'));
        $("#divConfirmation").modal('show');
      });
      $(document).on('click', '#btnYes', function() {
        DownlaodExcel();
      });
    });
  
    function prints(ctrl) {
      Swal.fire({
            icon: 'warning',
            title: 'NTTI PORTAL',
            text: 'ប្រព័ន្ធ កំពុងដំណើរការ......!',
        });
        return false;
      var url = '/reports-list-of-student-priview?type=print';
      var data = '';
      data = $("#advance_search").serialize();
      $.ajax({
        type: 'get',
        url: url,
        data: data,
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
          } else {
            $('.loader').hide();
            notyf.error("Error: " + response.msg);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
  
    function DownlaodExcel() {
      var url = '/reports-list-of-student-priview?type=downlaodexcel';
      if ($('#search_data').val() == '') {
        data = $("#advance_search").serialize();
      } else {
        data = 'value=' + $('#search_data').val();
      }
      data = $("#advance_search").serialize();
      $.ajax({
        type: "get",
        url: url,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {},
        success: function(response) {
          $("#divConfirmation").modal('hide');
          notyf.success(response.msg);
          location.href = response.path;
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    }
  </script>
  @endsection