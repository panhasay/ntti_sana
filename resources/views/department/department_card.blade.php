<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <a href="{{ url('student') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
          @if($type == 'ed')
            កែប្រែ, {{ $records->department_name ?? '' }}
          @else
            បន្ថែមថ្មី
          @endif
          &nbsp;&nbsp; <button type="button" id="BtnSave" class="btn btn-success float-left btn-sm mb-2 mb-md-0 me-2"> <i class="mdi mdi-content-save"></i> រក្សាទុក </button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
          <a id="btnShowMenuSetting" href="{{ url('/department-setup') }}"><i class="mdi mdi-keyboard-return"></i></a>
        </h4>
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
            <input type="hidden" id="type" name="id" value="{{ $records->id ?? '' }}">
            <span class="labels col-sm-3 col-form-label text-end">លេខកូដ<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="code" name="code" value="{{ $records->code ?? ''}}"
                placeholder="លេខកូដ" aria-label="លេខកូដ">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">Department<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name" name="name" value="{{ $records->name ?? ''}}"
                placeholder="Department" aria-label="Department">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ឈ្មោះ ដេប៉ាតឺម៉ង់<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name_2" name="name_2" value="{{ $records->name_2 ?? ''}}"
                placeholder="ឈ្មោះ ដេប៉ាតឺម៉ង់" aria-label="ឈ្មោះ ដេប៉ាតឺម៉ង់">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">សកម្មភាព<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single" id="is_active" name="is_active" style="width: 100%;">
                @if(isset($records->is_active) && $records->is_active == 'no' )
                  <option value="no">no</option>
                  <option value="yes">yes</option>
                @else
                  <option value="yes">yes</option>
                  <option value="no">no</option>
                @endif
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
          if(FieldRequired()) return;
          url = `/departments/store`;
      } else {
          url = `/departments/update`;
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
              }else {
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
  function FieldRequired() {
    var inValid = false ;
    $('#frmDataCard').each(function (event) {
      var code = $('#code').val();
      var name = $('#name').val();
      var name_2 = $('#name_2').val();

      if(!code){
          $('#code').addClass('FieldRequired');
          description = "ត្រូវបំពេញ លេខកូដ​!";
          inValid = true; 
      } else{
          $('#code').removeClass('FieldRequired');
          description = "ត្រូវបំពេញ លេខកូដ​!";
          inValid = false; 
      }

      if(!name){
          $('#name').addClass('FieldRequired');
          description = "ត្រូវបំពេញ Department !";
          inValid = true; 
      } else{
          $('#name').removeClass('FieldRequired');
          description = "ត្រូវបំពេញ ដេប៉ាតឺម៉ង់ !";
          inValid = false; 
      }

      if(!name_2){
          $('#name_2').addClass('FieldRequired');
          description = "ត្រូវបំពេញ ដេប៉ាតឺម៉ង់ !";
          inValid = true; 
      } else{
          $('#name_2').removeClass('FieldRequired');
          description = "ត្រូវបំពេញ ដេប៉ាតឺម៉ង់ !";
          inValid = false; 
      }
    });
    if(inValid){
        notyf.error(description);
    } 
    return inValid;
  }
</script>