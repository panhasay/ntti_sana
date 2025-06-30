<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <a href="{{ url('skills') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
           &nbsp;&nbsp; <button type="button" id="BtnSave" class="btn btn-success float-left btn-sm mb-2 mb-md-0 me-2"><i class="mdi mdi-content-save"></i>  រក្សាទុក </button>
         
         
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
            <a id="btnShowMenuSetting" href="{{ url('subject') }}"><i class="mdi mdi-keyboard-return"></i></a>
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
  <form id="frmDataCard" role="form" class="form-sample" enctype="multipart/form-data">
    <div class="card-body p-3">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group row">
            <input type="hidden" id="type" name="type" value="{{ $records->id ?? '' }}">
            <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ អ្នកប្រើប្រាស់<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name" name="name" value="{{ $records->name ?? ''}}"
                placeholder="ឈ្មោះ អ្នកប្រើប្រាស់" aria-label="ឈ្មោះ អ្នកប្រើប្រាស់">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">អុីម៉ែល<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="email" name="email" value="{{ $records->email ?? ''}}"
                placeholder="អុីម៉ែល" aria-label="អុីម៉ែល">
            </div>
          </div>
        </div>

         <div class="col-md-6">
            <div class="form-group row">
              <span class="labels col-sm-3 col-form-label text-end">ដេប៉ាតឺម៉ង់<strong
                  style="color:red; font-size:15px;"> *</strong></span>
              <div class="col-sm-9">
                  <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code" style="width: 100%;">
                      <option value="">&nbsp;</option>
                      @foreach ($department as $record) 
                          <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
                          {{ isset($record->code) ? $record->code : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                          </option>
                      @endforeach
                  </select>
              </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
              <span class="labels col-sm-3 col-form-label text-end">តួនាទី<strong
                  style="color:red; font-size:15px;"> *</strong></span>
              <div class="col-sm-9">
                <select class="js-example-basic-single" id="role" name="role" style="width: 100%;">
                    <option value="">&nbsp;</option>
                    <option value="admin" {{ ($records->role ?? '') == 'admin' ? 'selected' : '' }}>admin</option>
                    <option value="teachers" {{ ($records->role ?? '') == 'teachers' ? 'selected' : '' }}>teachers</option>
                    <option value="student" {{ ($records->role ?? '') == 'student' ? 'selected' : '' }}>student</option>
                </select>
              </div>
            </div>
        </div>

       

      </div>
    </div>
  </form>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    
    $('#BtnSave').on('click', function() {
      var formData = $('#frmDataCard').serialize();
      var type = $('#type').val();
      var url;
      if (!type) {
          url = `/users/store`;
      } else {
          url = `/users/update`;
      }
      $.ajax({
          type: "POST",
          url: url,
          data: formData,
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
              if (response.status == 'success') {
                notyf.success(response.msg);
              }else if(response.store == 'yes'){
                $('#frmDataCard')[0].reset();
                notyf.success(response.msg);
              }else if(response.tatus == 'logout')
                window.location.href = response.redirect;
              else {
                  notyf.error(response.msg);
              }
          }
      });
  });
  });
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
      beforeSend: function() {
        // $.LoadingOverlay("show", {
        //   custom: loadingOverlayCustomElement
        // });
        // loadingOverlayCustomElement.text('Request Processing...');
      },
      success: function(response) {
        $.LoadingOverlay("hide", true);
        if (response.status == 'success') {
          $('#divPassword').modal('hide');
          location.href = response.path;
          // myfn.showNotify(response['status'], 'lime', 'top', 'right', response['message']);
        } else {
          $('.secure_msg').html(response.message);
          $('.secure_msg').show();
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {}
    });
  }
</script>