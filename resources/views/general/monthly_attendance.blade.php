
@extends('app_layout.app_layout')
<style>
    .box-hover {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        transition: all 0.3s ease;
        background: #fff;
    }

    .box-hover:hover {
        border-color: #007bff; 
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-3px);
        cursor: pointer;
    }
    .page-title-card {
        padding: 24px !important;
    }
</style>
@section('content')
<div class="page-head page-head-custom">
    <div class="row">
        <div class="col-md-6 col-sm-6  col-6">
        <div class="page-title-card page-title-custom">
            <div class="title-page">
            <i class="mdi mdi-format-list-bulleted"></i>
                បញ្ជីវត្តមានប្រចាំខែឆមាស
            </div>
        </div>
        </div>
        <div class="col-md-6 col-sm-6 col-6">
        <div class="page-title-card page-title-custom text-right">
            <h4 class="text-right">
            {{-- <a id="btnShowMenuSetting" href="javascript:;"><i class="mdi mdi-settings"></i></a> --}}
            </h4>
        </div>
        </div>
    </div>

    <div class="container">
        <div class="row m-3">
            <div class="col-md-12 col-sm-6 col-6 text-center">បរិញ្ញាបត្រ</div>
            <div class="col-md-3 col-sm-4 col-6 p-3">
            <div class="page-title-card page-title-custom text-center box-hover">
                <h4 class="text-center">Hello</h4>
            </div>
            </div>

            <div class="col-md-3 col-sm-4 col-6 p-3">
            <div class="page-title-card page-title-custom text-center box-hover">
                <h4 class="text-center">Hello</h4>
            </div>
            </div>

            <div class="col-md-3 col-sm-4 col-6 p-3">
            <div class="page-title-card page-title-custom text-center box-hover">
                <h4 class="text-center">Hello</h4>
            </div>
            </div>

            <div class="col-md-3 col-sm-4 col-6 p-3">
            <div class="page-title-card page-title-custom text-center box-hover">
                <h4 class="text-center">Hello</h4>
            </div>
            </div>

        </div>
        </div>
    </div>


<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
{{-- @include('system.modal_comfrim_delet')
@include('general.class_schedule_lists') --}}
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
        url: `/class-schedule-delete`,
        data: {
          code: code
        },
        success: function(response) {
          if (response.status == 'success') {
            $("#divConfirmation").modal('hide');
            $("#row" + code).remove();
            notyf.success(response.msg);
          }else if (response.status == "warning"){
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
