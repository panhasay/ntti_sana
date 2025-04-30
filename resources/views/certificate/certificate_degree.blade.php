
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
          ​បោះពុម្ព​ សញ្ញាបត្រ
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
    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate" href="{{url('classes/transaction/?type=cr')}}"><i class="mdi mdi-account-plus"></i> បន្ថែបថ្មី</i></a>
    {{-- <button type="button" data-type="skill" onclick="prints()"
      class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
      <i class="mdi mdi-printer btn-icon-append"></i>
      <button type="button" onclick="DownlaodExcel()"
        class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
          class="mdi mdi-printer btn-icon-append"></i> </button> --}}
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    {{-- <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="classes" name="search_data"
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
    @include('system.option_advance_search_class_schedule', ['page_name' => 'Certificate-Degree'])

    {{-- <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group row">
            <div class="col-sm-2">
              <span class="labels">លេខកូដ</span>
              <input type="text" class="form-control form-control-sm" id="code" name="code" value=""
                placeholder="លេខកូដ" aria-label="លេខកូដ">
            </div>
            <div class="col-sm-2">
              <span class="labels">ដេប៉ាតឺម៉ង់</span>
              <input type="text" class="form-control form-control-sm" id="name" name="name" value=""
                placeholder="ដេប៉ាតឺម៉ង់" aria-label="ដេប៉ាតឺម៉ង់">
            </div>
            <div class="col-sm-2">
              <span class="labels">Department</span>
              <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value=""
                placeholder="Department" aria-label="Department">
            </div>
          </div>
          <button type="button" class="btn btn-primary text-white" data-page="class" id="btn-adSearch">Search</button>
        </div>
      </div>
    </form> --}}

  </div>
</div>

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
            <button type="button" id="YesPrints" data-code="" data-id=""
            class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
</div>

<div class="print" style="display: none">
  <div class="print-content">

  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="ModalPriviewCertificate" tabindex="-1" aria-labelledby="ModalTeacherSchedule"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1000ch">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark title-modal" id="ModalPriviewCertificate">កែសម្រូល ពត័មានបោះពុម្ព</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-2">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                <button type="button" data-id="" class="btn btn-primary" id="SaveTeacherSchedule">រក្សាទុក</button>
            </div>
        </div>
    </div>
</div>

@include('system.modal_comfrim_delet')
{{-- @include('system.model_update_certificate') --}}
@include('certificate.certificate_degree_lists')
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

      $(document).on('click', '#prints', function() {
          $(".modal-confirmation-text").html('Do you want to Downlaod prints ?');
          $("#YesPrints").attr('data-code', $(this).attr('data-code'));
          $("#ModelPrints").modal('show');
      });

      $(document).on('click', '#YesPrints', function() {
          var code = $(this).attr('data-code');
          let url = '/certificate/degree-print?code=' + code;
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

      $(document).on('click', '#BtnPriview', function() {
        var code = $(this).attr('data-code');
        var name = $(this).attr('data-name');
        $(".title-modal").text('កែសម្រូល ពត័មានបោះពុម្ពសញ្ញាបត្រ : ' + name);
        let url = '/certificate/degree-priview?code=' + code;
        
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.loader').hide();
                
                if (response.status === 'success') {
                    $("#ModalPriviewCertificate .modal-body").html(response.html); // Inject HTML into modal
                    $("#ModalPriviewCertificate").modal('show'); // Show modal
                } else {
                    notyf.error("Error: " + response.msg);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.loader').hide();
                notyf.error("AJAX Error: " + thrownError);
            }
        });
      });

      $(document).on('change', '#panha', function() {
        alert("hello");
        var code = $(this).attr('data-code');
        var name = $(this).attr('data-name');
        $(".title-modal").text('កែសម្រូល ពត័មានបោះពុម្ពសញ្ញាបត្រ : ' + name);
        let url = '/certificate/degree-priview?code=' + code;
        
        $.ajax({
            type: 'GET',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.loader').hide();
                
                if (response.status === 'success') {
                    $("#ModalPriviewCertificate .modal-body").html(response.html); // Inject HTML into modal
                    $("#ModalPriviewCertificate").modal('show'); // Show modal
                } else {
                    notyf.error("Error: " + response.msg);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('.loader').hide();
                notyf.error("AJAX Error: " + thrownError);
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
