
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <i class="mdi mdi-format-list-bulleted"></i>
            មុខវិជ្ជា
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
    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate" href="{{url('subjects/transaction/?type=cr')}}"><i class="mdi mdi-account-plus"></i> Add New</i></a>
    <button type="button" data-type="skill" onclick="prints()"
      class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> Print
      <i class="mdi mdi-printer btn-icon-append"></i>
      <button type="button" onclick="DownlaodExcel()"
        class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
          class="mdi mdi-printer btn-icon-append"></i> </button>
  </div>
  <div class="d-grid d-md-flex justify-content-md-end p-3">
    <input type="text" class="form-control mb-2 mb-md-0 me-2" id="search_data" data-page="{{ $page ?? '' }}" name="search_data"
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
              <span class="labels">លេខកូដ</span>
              <input type="text" class="form-control form-control-sm" id="code" name="code" value=""
                placeholder="លេខកូដ" aria-label="លេខកូដ">
            </div>
            <div class="col-sm-3">
              <span class="labels">មុខវិជ្ជា</span>
              <input type="text" class="form-control form-control-sm" id="name" name="name" value=""
                placeholder="ជំនាញ" aria-label="ជំនាញ">
            </div>
            <div class="col-sm-3">
              <span class="labels">ជំនាញ ភាសាខ្មែរ</span>
              <input type="text" class="form-control form-control-sm" id="name_2" name="name_2" value=""
                placeholder="ជំនាញ ភាសាខ្មែរ" aria-label="ជំនាញ ភាសាខ្មែរ">
            </div>

            <div class="col-sm-3">
               <span class="labels">ដេប៉ាតឺម៉ង់</span>
                  <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code" style="width: 100%;">
                     <option value="">&nbsp;</option>
                     @foreach ($department as $record) 
                        <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
                        {{ isset($record->code) ? $record->code : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                        </option>
                     @endforeach
               </select>
            </div>

            <div class="col-sm-3">
               <span class="labels">ប្រភេទម៉ោង</span>
               <select class="js-example-basic-single" id="type" name="type" style="width: 100%;">
                  <option value="">&nbsp;</option>
                  <option value="theory" {{ isset($records->type) && $records->type == 'theory' ? 'selected' : '' }}>ម៉ោង​ ទ្រឹស្តី</option>
                  <option value="practical" {{ isset($records->type) && $records->type == 'practical' ? 'selected' : '' }}>ម៉ោងអនុវត្ត ជាក់ស្តែង</option>
              </select>
            </div>

            <div class="col-sm-3">
               <span class="labels">ជំនាញ</span>
               <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code" style="width: 100%;">
                  <option value="">&nbsp;</option>
                  @foreach ($skills as $record) 
                      <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) && $records->skills_code == $record->code ? 'selected' : '' }}>
                      {{ isset($record->code) ? $record->code : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                      </option>
                  @endforeach
               </select>
            </div>


            <div class="col-sm-3">
               <span class="labels">ឆ្នាំ</span>
               <select class="js-example-basic-single" id="year_type" name="year_type" style="width: 100%;">
                  @for ($i = 1; $i <= 4; $i++)
                      <option value="{{ $i }}" {{ isset($records->year_type) && $records->year_type == $i ? 'selected' : '' }}>ឆ្នាំទី {{ $i }}</option>
                  @endfor
              </select>
            </div>
          </div>
          <button type="button" class="btn btn-primary text-white" data-page="subjects" id="btn-adSearch">Search</button>
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
@include('general.subjects_lists')
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
        url: `/subjects-delete`,
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