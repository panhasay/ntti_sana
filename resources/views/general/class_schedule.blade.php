
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
            តារាងបែងចែកម៉ោងបង្រៀន
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          {{-- <a id="btnShowMenuSetting" href="javascript:;"><i class="mdi mdi-settings"></i></a> --}}
        </h4>
      </div>
    </div>
  </div>
</div>
<div class="page-header flex-wrap">
  <div class="header-left">
    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate" href="{{url('class-schedule/transaction/?type=cr')}}"><i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី</i></a>
    
    {{-- <button type="button" data-type="skill" onclick="prints()"
      class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
      <i class="mdi mdi-printer btn-icon-append"></i>
      <button type="button" onclick="DownlaodExcel()"
        class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
          class="mdi mdi-printer btn-icon-append"></i> </button> --}}
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    {{-- <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="{{ $page ?? '' }}" name="search_data"
      placeholder="Serch...." aria-label="Recipient's username" aria-describedby="basic-addon2"> --}}
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
      @include('system.option_advance_search_class_schedule', ['page_name' => 'class-schedule'])
  </div>
</div>
<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>
@include('system.modal_comfrim_delet')
@include('general.class_schedule_lists')
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
