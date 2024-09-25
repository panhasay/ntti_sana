<style>
    .table> :not(:last-child)> :last-child>*,
    .jsgrid .jsgrid-table> :not(:last-child)> :last-child>* {
      border-bottom-color: #e4e9f0;
      font-family: "Moul", serif;
    }
    .btn.btn-sm {
      font-size: 11px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 28px;
      margin-top: -7px;
    }
  </style>
  @extends('app_layout.app_layout')
  @section('content')
  <div class="page-head page-head-custom">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-6">
        <div class="page-title page-title-custom">
          <div class="title-page">
            <i class="mdi mdi-format-list-bulleted"></i>
                {{ $page_title ?? '' }}
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
      <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate" href="{{url('departments/transaction/?type=cr')}}">
        <i class="mdi mdi-account-plus"></i>Add New</i></a>
    </div>
    <div class="d-grid d-md-flex justify-content-md-end p-3">
      <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="student" name="search_data"
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
                <span class="labels">អត្តលេខ</span>
                <input type="text" class="form-control form-control-sm" id="parent_id" name="parent_id" value=""
                  placeholder="អត្តលេខ" aria-label="អត្តលេខ">
              </div>
              <div class="col-sm-3">
                <span class="labels">គោត្តនាម និងនាម</span>
                <input type="text" class="form-control form-control-sm" id="firstname" name="firstname" value=""
                  placeholder="គោត្តនាម និងនាម" aria-label="គោត្តនាម និងនាម">
              </div>
              <div class="col-sm-3">
                <span class="labels"> ឈ្មោះជាឡាតាំង</span>
                <input type="text" class="form-control form-control-sm" id="lastname" name="lastname" value=""
                  placeholder="	ឈ្មោះជាឡាតាំង" aria-label="	ឈ្មោះជាឡាតាំង">
              </div>
              <div class="col-sm-3">
                <span class="labels">ថ្ងៃខែឆ្នាំកំណើត</span>
                <input type="text" class="form-control form-control-sm" id="dob" name="dob" value=""
                  placeholder="ថ្ងៃខែឆ្នាំកំណើត" aria-label="ថ្ងៃខែឆ្នាំកំណើត">
              </div>
              <div class="col-sm-3 p-3">
                <span class="labels">ថ្នាក់ / ក្រុម</span>
                {{-- <select class="js-example-basic-single" id="class_code" name="class_code" style="width: 100%;">
                    <option value="">&nbsp;</option>
                    @foreach ($class_record as $class)
                    <option value="{{ $class->id ?? ''}}">{{ $class->class ?? '' }}</option>
                @endforeach
                </select> --}}
              </div>
            </div>
            <button type="button" class="btn btn-primary text-white" data-page="student" id="btn-adSearch">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="print" style="display: none">
    <div class="print-content">
  
    </div>
  </div>
  @include('system.modal_comfrim_delet')
  @include('system_setup.users_lists')
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
          url: `/department-delete`,
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
      var url = '/student/print';
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

 