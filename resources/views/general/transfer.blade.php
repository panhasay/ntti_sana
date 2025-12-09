@extends('app_layout.app_layout')
@section('content')

<div class="page-head page-head-custom">
</div>

<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>

<div class="modal fade" id="divChangeClass" tabindex="-1" aria-labelledby="modaldivChangeClass" aria-hidden="true">
    <div class="modal-dialog modal-xl"><!-- XL for 1200px width -->
        <div class="modal-content">
            <div class="modal-header bg-m-header">
                <h5 class="modal-title" id="modaldivChangeClass">ស្ពាក្យសុំប្ដូរវេនសិក្សា</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row container contain-changeClass mt-2 mb-2" style="white-space: nowrap">
                    
                </div>
            </div><br>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">បិទ</button>
                <button type="button" id="SaveStudentChangeClass" data-code="" data-type="change-class" class="btn btn-primary">រក្សាទុក</button>
            </div>
        </div>
    </div>
</div>

@include('modals.modals_hang_of_study')
@include('system.modal_comfrim_delet')
@include('general.transfer_lists')

<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })

    $('#from_date').on('input', function () {
      // Allow only numeric characters and specific symbols (-, ., /)
      let rawValue = $(this).val().replace(/[^0-9\-\.\/]/g, ''); 

      // Update the input value with the cleaned value
      $(this).val(rawValue);

      // Check if rawValue contains invalid characters
      if (/[^0-9\-\.\/]/.test($(this).val())) {
          notyf.error("សូមវាយលេខ (0-9) និងសញ្ញា (-, ., /)!");
          return;
      }
      // Process input only if the raw numeric length is exactly 8 (ddmmyyyy)
      const numericValue = rawValue.replace(/[^0-9]/g, ''); // Remove symbols to check numeric length
      if (numericValue.length === 8) {
        const day = numericValue.substring(0, 2);
        const month = numericValue.substring(2, 4);
        const year = numericValue.substring(4, 8);

        // Validate date components
        const isValidDate = validateDate(day, month, year);

        if (isValidDate) {
            const formattedDate = `${day}-${month}-${year}`;
            $(this).val(formattedDate); // Update input with formatted date
            $('#error_message').text(''); // Clear error message
        } else {
            notyf.error("សូម ពិនិត្យមើល ថ្ងៃខែឆ្នាំម្ដងទៀត​!");
        }
      }
    });

    $(document).on('click', '#btnDelete', function() {
      $(".modal-confirmation-text").html('Do you want to delete?');
      $("#btnYes").attr('data-code', $(this).attr('data-code'));
      $("#divConfirmation").modal('show');
    });

    $(document).on('click', '#hang_of_study', function() {
        var code = $(this).attr('data-code');
        $.ajax({
          type: "get",
          url: `transfer/get-student/-hang_of_study`,
          data: {
            code: code
          },
          success: function(response) {
            if (response.status == 'success') {
              $("#btnYesSave").attr('data-code', $(this).attr('data-code'));
              $("#divHangOfStudy").modal('show');
              $(".name_2").html(response.records.name_2);
              $("#date_of_birth").html(response.records.date_of_birth);
              $("#student_code").html(response.records.code);
              $("#class_code").html(response.records.class_code);
              $("#phone_student").html(response.records.phone_student);

              $('#hang_of_study').select2({
                  dropdownParent: $('#divHangOfStudy') 
              });
            }
          }
        });
       
    });
    
    $(document).on('click', '#student_change_class', function() {
        var code = $(this).attr('data-code');
        $.ajax({
            type: "GET",
            url: "transfer/get-student/change-class",
            data: {
                code: code,
            },
            success: function(response) {
                if (response.status === 'success') {
                    $("#SaveStudentChangeClass").attr('data-code', code);
                    $("#divChangeClass").modal('show');
                    $(".contain-changeClass").html(response.view);
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
   
    $(document).on('click', '#btnYesSave', function() {
        var code = $('#student_code').text();
        var hang_of_study = $('#hang_of_study').val();
        var from_date = $('#from_date').val();
        var file = $('#file_name')[0].files[0]; 

        let formData = new FormData();
        formData.append('code', code);
        formData.append('hang_of_study', hang_of_study);
        formData.append('from_date', from_date);
        formData.append('file_name', file); 

        $.ajax({
            type: "POST",
            url: `transfer/submit-student-request-hang-of-study`,
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status == 'success') {
                    $("#divHangOfStudy").modal('hide');
                    $("#row" + code).addClass("bg-warning text-white"); 
                } else {
                    notyf.error(response.msg);
                }
            },
            error: function(xhr) {
                alert('Error occurred. Please try again.');
            }
        });
    });

    $(document).on('click', '#btnYes', function() {
      var code = $(this).attr('data-code');
      $.ajax({
        type: "POST",
        url: `/skills-delete`,
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

    $(document).on('click', '#transfer', function() {
      var code = $(this).attr('data-code');
      alert(code);
      $.ajax({
        type: "GEt",
        url: `/get-student-transfer`,
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

    $(document).on('click', '#SaveStudentChangeClass', function() {
      var code = $(this).attr('data-code');
      var class_code = $('#class_code_new').val();
      var class_old = $('#class_old').val();
      var reason_detail = $('#reason_detail').val();
      var posting_date = $('#posting_date').val();
      var year = $('#years').val();
      var semester = $('#semester').val();
      var assing_no = $('#assing_no').val();
      var session_year_code = $('#session_year_codes').val();
      $.ajax({
        type: "POST",
        url: `/transfer/submit-student-request-change-class`,
        data: {
          code : code,
          class_code: class_code,
          class_old : class_old,
          reason_detail: reason_detail,
          posting_date: posting_date,
          year: year,
          semester: semester,
          assing_no: assing_no,
          session_year_code : session_year_code,
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#divChangeClass").modal('hide');
            $("#row" + code).addClass("bg-info text-white"); 
          }else {
            notyf.error(response.msg);
          }
        }
      });
    });

  });

  function prints(ctrl) {
    var url = 'departments/print';
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
        $('.loader').hide();
        $('.print-content').html(response);
        $('.print-content').printThis({});
      },
      error: function(xhr, ajaxOptions, thrownError) {}
    });
  }

   // Date validation function
  function validateDate(day, month, year) {
      const date = new Date(`${year}-${month}-${day}`);
      return (
          date &&
          date.getFullYear() == year &&
          date.getMonth() + 1 == month &&
          date.getDate() == day
      );
  }

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
      beforeSend: function() {},
      success: function(response) {
        notyf.error(response.msg);
      },
      error: function(xhr, ajaxOptions, thrownError) {}
    });
  }
</script>
@endsection