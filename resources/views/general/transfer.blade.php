
@extends('app_layout.app_layout')
@section('content')

<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
            ការគ្រប់គ្រង ប្ដូរក្រុម / ប្ដូរវេនសិក្សា ព្យួរកាសិក្សា និងឈប់
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="btnShowMenuSetting" href="javascript:;"><i class="mdi mdi-settings"></i></a>
        </h4>
      </div>
    </div>
  </div>
</div>
<div class="page-header flex-wrap">
  <div class="header-left">
    {{-- <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate" href="{{url('transfer/transaction/?type=cr')}}"><i class="mdi mdi-account-plus"></i> Add New</i></a> --}}
    {{-- <button type="button" data-type="skill" onclick="prints()"
      class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
      <i class="mdi mdi-printer btn-icon-append"></i> --}}
      <button type="button" onclick="DownlaodExcel()"
        class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
          class="mdi mdi-printer btn-icon-append"></i> </button>
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="{{ $page ?? '' }}" name="search_data"
      placeholder="Serch...." aria-label="Recipient's username" aria-describedby="basic-addon2">
    <div>
    </div>
    <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button"
      aria-expanded="false" aria-controls="collapseExample">
      Fliter
    </a>
  </div>
</div>
<div class="collapse" id="Fliter">
  <div class="card card-body">
    <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <div class="col-sm-3">
              <span class="labels">លេខកូដ</span>
              <input type="text" class="form-control form-control-sm" id="code" name="code" value=""
                placeholder="លេខកូដ" aria-label="លេខកូដ">
            </div>
            <div class="col-sm-3">
              <span class="labels">ជំនាញ</span>
              <input type="text" class="form-control form-control-sm" id="name" name="name" value=""
                placeholder="ជំនាញ" aria-label="ជំនាញ">
            </div>
            <div class="col-sm-3">
              <span class="labels">ជំនាញ ភាសាខ្មែរ</span>
              <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value=""
                placeholder="ជំនាញ ភាសាខ្មែរ" aria-label="ជំនាញ ភាសាខ្មែរ">
            </div>
          </div>
          <button type="button" class="btn btn-primary text-white" data-page="transfer" id="btn-adSearch">Search</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="print" style="display: none">
  <div class="print-content">

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
                    $("#row" + code).addClass("bg-danger text-white"); 
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
