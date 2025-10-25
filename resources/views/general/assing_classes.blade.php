
@extends('app_layout.app_layout')
@section('content')


<div class="collapse" id="Fliter">
  <div class="card card-body">
      @include('system.option_advance_search_assign_classes', ['page_name' => 'assign-classes'])
  </div>
</div>
<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>

@include('system.modal_comfrim_delet')
@include('general.assing_classes_lists')
@include('modals.modals_create_assing_classde')
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
      $(document).on('click', '#BntCreateAssign', function() {
        $(".modal-confirmation-text").html('បង្កើតកំណត់ ក្រុម / ថ្នាក់ ថ្មី' + "{{ $type }}"+" ឆ្នាំទី "+"{{ $_GET['years'] ?? ''}}");
        $("#btnYes").attr('data-code', $(this).attr('data-code'));
        $("#ModalCreateAssign").modal('show');
      });
      $(document).on('click', '.btnCreateAssice', function() {
        let data_years = $(this).attr('data-years');
        let data_type = $(this).attr('data-type');
        $.ajax({
          type: "get",
          url: `/create-assing-classeds-new`,
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
      $(document).on('click', '#btnYes', function() {
        var code = $(this).attr('data-code');
        $.ajax({
          type: "POST",
          url: `/classes-delete`,
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
