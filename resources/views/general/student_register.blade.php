{{-- <base href="/public"> --}}
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
            ចុះឈ្មោះចូលរៀន
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
      href="{{url('/student/registration/transaction?type=cr')}}"><i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី</i>
    </a>
      <button type="button" id="BtnDownlaodExcel"
          class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
          class="mdi mdi-printer btn-icon-append"></i> 
      </button>
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="student_registration" name="search_data"
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
              <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value=""
                placeholder="គោត្តនាម និងនាម" aria-label="គោត្តនាម និងនាម">
            </div>
           
            <div class="col-sm-3">
              <span class="labels">ដេប៉ាតឺម៉ង់</span>
              <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code" style="width: 100%;">
                <option value="">&nbsp;</option>
                @foreach ($department as $record)
                <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
                    {{ isset($record->name_2) ? $record->name_2 : '' }}
                </option>
                @endforeach
            </select>
            </div>

            <div class="col-sm-3">
              <span class="labels">ជំនាញ</span>
                <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code" style="width: 100%;">
                    <option value="">&nbsp;</option>
                    @foreach ($skills as $record)
                    <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) && $records->skills_code == $record->code ? 'selected' : '' }}>
                        {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
              <span class="labels">វេន</span>
              <div class="col-sm-9">
                <select class="js-example-basic-single FieldRequired" id="sections_code" name="sections_code" style="width: 130%;">
                    <option value="">&nbsp;</option>
                    @foreach ($sections as $record)
                    <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) && $records->sections_code == $record->code ? 'selected' : '' }}>
                        {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            </div>

            <div class="col-sm-3">
              <span class="labels col-sm-3 col-form-label text-end">កម្រិត<strong style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                    <select class="js-example-basic-single" id="qualification" name="qualification" style="width: 130%;">
                        <option value="">&nbsp;</option>
                        @foreach ($qualifications as $value => $label)
                            <option value="{{ $label->code }}" {{ isset($records->qualification) && $records->qualification == $label->code ? 'selected' : '' }}>
                                {{ $label->code ?? ''}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

          </div>
          <button type="button" class="btn btn-primary text-white" data-page="student_registration" id="btn-adSearch">Search</button>
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
@include('system.modal_comfrim_donwload')
@include('general.student_register_lists')
@include('system.model_upload_excel')
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
        url: `/student/register/delete`,
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

    $(document).on('click', '#BtnDownlaodExcel', function() {
      $(".modal-confirmation-text").html('Do you want to Downlaod Excel ?');
      $("#btnYesExcel").attr('data-code', $(this).attr('data-type'));
      $("#divConfirmationExcel").modal('show');
    });
    $(document).on('click', '#btnYesExcel', function() {
      DownlaodExcel();
    });

  });

  function DownlaodExcel() {
    var url = '/student/registration-downlaodexcel';
    if ($('#search_data').val() == '') {
      data = $("#advance_search").serialize();
    } else {
      data = 'value=' + $('#search_data').val();
    }
    data = $("#advance_search").serialize();
    $.ajax({
      type: "get",
      url: url,
      data: data,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: function() {
        $('.loader').show();
      },
      success: function(response) {
        $("#divConfirmationExcel").modal('hide');
        $('.loader').hide();
        notyf.success(response.msg);
        location.href = response.path;
      },
      error: function(xhr, ajaxOptions, thrownError) {
        $('.loader').hide();
      }
    });
  }

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

  function importExcel() {
    $("#divUplocadExcel").modal('show');
  }
</script>
@endsection
