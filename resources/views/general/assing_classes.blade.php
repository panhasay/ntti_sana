
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
          កំណត់ ក្រុម / ថ្នាក់ {{ $type ?? '' }}ឆ្នាំទី {{ $years ?? '' }}
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="" href="{{ url('manage-academic-work') }}"><i class="mdi mdi-keyboard-return"></i></a>
        </h4>
      </div>
    </div>
  </div>
</div>
<div class="page-header flex-wrap">
  <div class="header-left">
    @if(isset($users->role) && $users->role == 'admin')
      {{-- <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreateAssign" href="#"></i> <i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី</i></a>  --}}
    @endif
        <button class="btn btn-success btn-icon-text btn-sm mb-2 mb-md-0 me-2 khmer_os_b" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="mdi mdi-signal"></i>លទ្ធិផលប្រឡង
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item khmer_os_b" href="{{ url('exam-results?' . http_build_query(['years' => $_GET['years'], 'type' => $_GET['type'], 'semester' => 1])) }}">លទ្ធិផលប្រឡងឆមាសទី១</a>
          <a class="dropdown-item khmer_os_b" href="{{ url('exam-results?' . http_build_query(['years' => $_GET['years'], 'type' => $_GET['type'], 'semester' => 2])) }}">លទ្ធិផលប្រឡងឆមាសទី២</a>
        </div>
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    {{-- <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="assign-classes" name="search_data"
      placeholder="Serch...." aria-label="Recipient's username" aria-describedby="basic-addon2"> --}}
    <div>
    </div>
    <a class="btn btn-primary mb-2 mb-md-0 me-2" data-toggle="collapse" href="#Fliter" role="button" aria-expanded="false" aria-controls="collapseExample">
        Fliter
    </a>
  </div>
</div>
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
