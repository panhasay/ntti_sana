
  @extends('app_layout.app_layout')
  @section('content')
  <div class="page-head page-head-custom">
  </div>

  <div class="print" style="display: none">
    <div class="print-content">
  
    </div>
  </div>
  @include('system.modal_comfrim_delet')
  @include('general.upp_grade_class_lists')
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
          url: `/classes-delete`,
          data: {
            code: code
          },
          success: function(response) {
            if (response.status == 'success') {
              $("#divConfirmation").modal('hide');
              $("#row" + code).remove();
              notyf.success(response.msg);
            }else if (response.status == 'error') {
              notyf.error(response.msg);
            }
          }
        });
      });
    });
  </script>
  @endsection
  