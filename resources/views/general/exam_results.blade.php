
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">


<div class="print" style="display: none">
  <div class="print-content-exam">

  </div>
</div>
<div class="modal" id="ModalExamResults">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header bg-m-header">
        <h4 class="modal-title text-white modal-title-exam-results khmer_os_b"></h4>
        <div class="pull-right" style="float: right;margin-left: 10px;">
          <button type="button" data-type="skill" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2 pull-right text-white" style="float: right !important;"> Print
            <i class="mdi mdi-printer btn-icon-append"></i>
          </button>
          {{-- <button type="button" class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2 text-white BtnDownlaodExcel">Excel 
            <i class="mdi mdi-printer btn-icon-append"></i>
          </button> --}}
        </div>
      </div>
      <div class="modal-body">
        <div class="content-exam-results">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
<div class="modal fade" id="ModelExcel" tabindex="-1" role="dialog" aria-labelledby="ModelExcel" aria-hidden="true">
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
        <button type="button" id="YesExcel" data-code="{{ $_GET['assing_no'] ?? '' }}" data-id=""
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
<input type="hidden" id="class_code">
@include('general.exam_results_lists')
<script>
    $(document).ready(function() {
      $('.ExamResults').on('click', function() {

          let class_code = $(this).attr('data-class');
          var years = $(this).attr('data-years');
          var type = $(this).attr('data-type'); 
          var semester = $(this).attr('data-semester'); 

          var url = 'get-exam-results?class_code=' + class_code + '&years=' + years + '&type=' + type + '&semester=' + semester;
          $.ajax({
              type: "get",
              url: url,
              class_code: class_code,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                  if (response.status === 'success') {
                      $('#ModalExamResults').modal('show');
                      $('.content-exam-results').html(response.html);  
                      $('.modal-title-exam-results').text(
                          'តារាង សរុបពិន្ទុ ' + semester + ' ឆ្នាំទី ' + years + ' ' + type + ' ក្រុម ' + class_code
                      );
                      $('#class_code').val(class_code);
                  } 
              },
          });
      });
    });

    $(document).on('click', '#prints', function() {
      $(".modal-confirmation-text").html('Do you want to Downlaod prints ?');
      $("#YesPrints").attr('data-code', $(this).attr('data-type'));
      $("#ModelPrints").modal('show');
    });
    $(document).on('click', '.BtnDownlaodExcel', function() {
      $(".modal-confirmation-text").html('Do you want to Downlaod excel ?');
      $("#YesExcel").attr('data-code', $(this).attr('data-type'));
      $("#ModelExcel").modal('show');
    });
    $(document).on('click', '#YesExcel', function() {
      let class_code = $('#class_code').val();
      var years = "{{ isset($_GET['years']) ? addslashes($_GET['years']) : '' }}";
      var type = "{{ isset($_GET['type']) ? addslashes($_GET['type']) : '' }}";
      var semester = "{{ isset($_GET['semester']) ? addslashes($_GET['semester']) : '' }}";
      var url = 'get-exam-results-excel-exam?class_code=' + class_code + '&years=' + years + '&type=' + type + '&semester=' + semester;
      var data;
      
      data = 'class_code=' + class_code+ '&years=' + years + '&type=' + type + '&semester=' + semester;

      var form = $('<form>', {
          action: url,
          method: 'GET'
      });

        // Append the serialized data to the form
        $.each(data.split('&'), function(i, field) {
            var parts = field.split('=');
            form.append($('<input>', {
                type: 'hidden',
                name: decodeURIComponent(parts[0]),
                value: decodeURIComponent(parts[1])
            }));
        });

        // Append the form to the body and submit it
        $('body').append(form);
        form.submit();

        // Optionally, you can show a loader here
        $('.loader').hide();
        $("#divConfirmationExcel").modal('hide');

    });
    $(document).on('click', '#YesPrints', function() {
      let class_code = $('#class_code').val();
      var years = "{{ isset($_GET['years']) ? addslashes($_GET['years']) : '' }}";
      var type = "{{ isset($_GET['type']) ? addslashes($_GET['type']) : '' }}";
      var semester = "{{ isset($_GET['semester']) ? addslashes($_GET['semester']) : '' }}";
      var url = 'get-exam-results-print-exam?class_code=' + class_code + '&years=' + years + '&type=' + type + '&semester=' + semester;
      $.ajax({
          type: "get",
          url: url,
          class_code: class_code,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function() {
          $('.loader').show();
        },
        success: function(response) {
          if (response.status != 'success') {
            $('.loader').hide();
            $('.print-content-exam').printThis({});
            $('.print-content-exam').html(response);
            $('#ModelPrints').modal('hide');
          } else {
            $('.loader').hide();
            notyf.error("Error: " + response.msg);
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {}
      });
    });
</script>
@endsection
