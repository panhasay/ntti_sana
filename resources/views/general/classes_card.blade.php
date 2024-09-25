<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
  <div class="row border-bottom p-2">
    <div class="col-md-6 col-sm-6  col-6">
      <div class="page-title page-title-custom">
        <div class="title-page">
          <a href="{{ url('classes') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
          @if($type == 'ed')
            កែប្រែ, {{ $records->name ?? '' }}
          @else
            បន្ថែមថ្មី
          @endif
          &nbsp;&nbsp; <button type="button" id="BtnSave" class="btn btn-success"> save </button>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-6">
      <div class="page-title page-title-custom text-right">
        <h4 class="text-right">
            <a id="btnShowMenuSetting" href="{{ url($page) }}"><i class="mdi mdi-keyboard-return"></i></a>
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
            <input type="hidden" id="type" name="type" value="{{ $records->code ?? '' }}">
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
            <span class="labels col-sm-3 col-form-label text-end">ថា្នក់/ក្រុម<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="text" class="form-control form-control-sm " id="name" name="name" value="{{ $records->name ?? ''}}"
                placeholder="ថា្នក់/ក្រុម" aria-label="ថា្នក់/ក្រុម">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">វេន<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
                <select class="js-example-basic-single FieldRequired" id="sections_code" name="sections_code" style="width: 100%;">
                    <option value="">&nbsp;</option>
                    @foreach ($sections as $record) 
                        <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) && $records->sections_code == $record->code ? 'selected' : '' }}>
                        {{ isset($record->code) ? $record->code : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
          </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
              <span class="labels col-sm-3 col-form-label text-end">ជំនាញ<strong
                  style="color:red; font-size:15px;"> *</strong></span>
              <div class="col-sm-9">
                  <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code" style="width: 100%;">
                      <option value="">&nbsp;</option>
                      @foreach ($skills as $record) 
                          <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) && $records->skills_code == $record->code ? 'selected' : '' }}>
                          {{ isset($record->code) ? $record->code : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                          </option>
                      @endforeach
                  </select>
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
              <span class="labels col-sm-3 col-form-label text-end">ឆ្នាំសិក្សា<strong
                  style="color:red; font-size:15px;"> *</strong></span>
              <div class="col-sm-9">
                  <select class="js-example-basic-single FieldRequired" id="school_year_code" name="school_year_code" style="width: 100%;">
                      <option value="">&nbsp;</option>
                      @foreach ($school_years as $record) 
                          <option value="{{ $record->code ?? '' }}" {{ isset($records->school_year_code) && $records->school_year_code == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                          </option>
                      @endforeach
                  </select>
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

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">សកម្មភាព<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <select class="js-example-basic-single" id="level" name="level" style="width: 100%;">
                  <?php 
                      $options = [
                        'បរិញ្ញាបត្រ' => 'បរិញ្ញាបត្រ',
                        'សញ្ញាបត្រជាន់ខ្ពស់បច្ចេកទេស' => 'សញ្ញាបត្រជាន់ខ្ពស់បច្ចេកទេស',
                        'បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា' => 'បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា',
                    ];
                  ?>
                  @foreach ($options as $value => $label)
                      <option value="{{ $value }}" {{ isset($records->level) && $records->level == $value ? 'selected' : '' }}>
                          {{ $label }}
                      </option>
                  @endforeach
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
          url = `/classes/store`;
      } else {
          url = `/classes/update`;
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
      var sections_code = $('#sections_code').val();

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
          description = "ត្រូវបំពេញ Field Required !";
          inValid = true; 
      } else{
          $('#name').removeClass('FieldRequired');
          description = "ត្រូវបំពេញ Field Required !";
          inValid = false; 
      }

      if(!sections_code){
          $('#sections_code').addClass('FieldRequired');
          description = "ត្រូវបំពេញ Field Required !";
          inValid = true; 
      } else{
          $('#sections_code').removeClass('FieldRequired');
          description = "ត្រូវបំពេញ Field Required !";
          inValid = false; 
      }
    });
    if(inValid){
        notyf.error(description);
    } 
    return inValid;
  }
</script>