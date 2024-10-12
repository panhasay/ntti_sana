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
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
          ប្រពន្ធ័គ្រប់គ្រងសិស្ស
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="btnShowMenuSetting" href="{{ url('/department-menu') }}"><i class="mdi mdi-keyboard-return"></i></a>
        </h4>
      </div>
    </div>
  </div>
</div>
<div class="page-header flex-wrap">
  <div class="header-left">
    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
      href="{{url('/student/transaction?type=cr')}}"><i class="mdi mdi-account-plus"></i> Add New</i></a>
    <button type="button" data-type="skill" onclick="prints()"
      class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
      <i class="mdi mdi-printer btn-icon-append"></i>
      {{-- <button type="button" onclick="DownlaodExcel()"
          class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
          class="mdi mdi-printer btn-icon-append"></i>
      </button> --}}
      <button type="button" onclick="importExcel()"
        class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel
        <i class="mdi mdi-upload btn-icon-prepend"></i>
      </button>
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="student" name="search_data"
      placeholder="Serch...." aria-label="Recipient's username" aria-describedby="basic-addon2">
    <div>
      {{-- <button type="button" class="btn btn-outline-primary"> Seacrh </button> --}}
    </div>
    <a class="btn btn-primary btn-icon-text" data-toggle="collapse" href="#Fliter" role="button" aria-expanded="false"
      aria-controls="collapseExample">Fliter
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
              <input type="text" class="form-control form-control-sm" id="code" name="code" value=""
                placeholder="អត្តលេខ" aria-label="អត្តលេខ">
            </div>
            <div class="col-sm-3">
              <span class="labels">គោត្តនាម និងនាម</span>
              <input type="text" class="form-control form-control-sm" id="name" name="name" value=""
                placeholder="គោត្តនាម និងនាម" aria-label="គោត្តនាម និងនាម">
            </div>
            <div class="col-sm-3">
              <span class="labels"> ឈ្មោះជាឡាតាំង</span>
              <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value=""
                placeholder="	ឈ្មោះជាឡាតាំង" aria-label="	ឈ្មោះជាឡាតាំង">
            </div>
            <div class="col-sm-3">
              <span class="labels">ថ្ងៃខែឆ្នាំកំណើត</span>
              <input type="text" class="form-control form-control-sm" id="date_of_birth" name="date_of_birth" value=""
                placeholder="ថ្ងៃខែឆ្នាំកំណើត" aria-label="ថ្ងៃខែឆ្នាំកំណើត">
            </div>
            <div class="col-sm-3 p-3">
              <span class="labels">ថ្នាក់ / ក្រុម</span>
              <select class="js-example-basic-single" id="class_code" name="class_code" style="width: 100%;">
                <option value="">&nbsp;</option>
                @foreach ($class_record as $class)
                <option value="{{ $class->code ?? ''}}">{{ $class->name ?? '' }}</option>
                @endforeach
              </select>
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
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModals" aria-hidden="true">
  <div class="modal-dialog modal-xl"> 
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="imageModals">Upload Image</h5>
        
      </div>
      <div class="modal-body PreImage" >
          
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
@include('system.modal_comfrim_delet')
@include('general.student_list')
@include('system.model_upload_excel')
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        url: `/student/delete`,
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
    $(document).on('click', '#btnExcel', function() {
      var fileInput = $('#dataExcel')[0];
      var file = fileInput.files[0];
      if (file) {
        var formData = new FormData();
        formData.append('excel_file', file);
        $.ajax({
          type: "POST",
          url: "/studnet/import-excel",
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          processData: false,
          contentType: false,
          success: function(response) {
            if (response.status == 'success') {
              $("#divConfirmation").modal('hide');
              notyf.success(response.msg);
            } else {
              notyf.error(response.msg);
            }
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);
          }
        });
      } else {
        notyf.error('Please select a file');
      }
    });
    $(document).on('click', '.btn-browse', function() {
      $('.upload-item').trigger('click');
    });
    $(document).on('click', '#btn-Image', function() {
      let code = $(this).attr('data-code');
      $.ajax({
        type: "GET",
        url: `/student/getImage`,
        data: {
          code: code
        },
        // beforeSend: function() {
        //     // $('.global_laoder').show();
        // },
        success: function(response) {
          if (response.status == 'success') {
            $('#imageModal').modal('show');
            $('.PreImage').html();
            $('.PreImage').html(response.view);
          }
        }
      });
    });
    $(document).on('change', '#file', function() {
      let file = $('#file').val();
      let data = new FormData(formimg);
      $.ajax({
        type: "POST",
        url: `/student/uploadimage`,
        data: data,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if(response.status == 'success'){
            notyf.success(response.msg);
            $('.append_file').append(`
              <div class="col-3">
                <div class="drag-image">
                <img src="${response.path}" alt="">
                <div class="btn delete_image" data-id ='{{$item->id ?? ''}}'>Remove</div>
                </div>
              </div>
            `);
          }else{
            notyf.error(response.msg);
          }
        }
      });
    });
    $(document).on('click', '.delete_image', function(param) {
      let id = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: `/student/delete-image`,
        beforeSend: function() {
          $('.global_laoder').show();
        },
        data: {
          id: id
        },
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          if (response.status == 'success') {
            $(`.row_${id}`).remove();
            $('.global_laoder').hide();
            notyf.success(response.msg);
          } else {
            notyf.error(response.msg);
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

  function importExcel() {
    $("#divUplocadExcel").modal('show');
  }
</script>