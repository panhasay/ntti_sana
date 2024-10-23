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
            <input type="hidden" id="type" name="type" value="{{ $records->id ?? '' }}">
            <span class="labels col-sm-3 col-form-label text-end">ចាប់ផ្តើមអនុវត្ត<strong
                style="color:red; font-size:15px;"> *</strong></span>
            <div class="col-sm-9">
              <input type="date" class="form-control form-control-sm " id="start_date" name="start_date" value="{{ $records->start_date ?? ''}}"
                placeholder="ចាប់ផ្តើមអនុវត្ត" aria-label="ចាប់ផ្តើមអនុវត្ត">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">ថា្នក់/ក្រុម<strong
                style="color:red; font-size:15px;"> *</strong></span>
                <div class="col-sm-9">
                    <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code" style="width: 100%;">
                        <option value="">&nbsp;</option>
                        @foreach ($classs as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) && $records->class_code == $record->code ? 'selected' : '' }}>
                            {{ isset($record->code) ? $record->code : '' }} -  {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
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
                          <option value="{{ $record->code ?? '' }}" {{ isset($records->session_year_code) && $records->session_year_code == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                          </option>
                      @endforeach
                  </select>
              </div>
            </div>
        </div>

        <div class="col-md-6">
          <div class="form-group row">
            <span class="labels col-sm-3 col-form-label text-end">កម្រិត<strong
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

        <div class="col-md-6">
            <div class="form-group row">
              <span class="labels col-sm-3 col-form-label text-end">ឆមាស<strong style="color:red; font-size:15px;">
                  *</strong></span>
              <div class="col-sm-9">
                <select class="js-example-basic-single form_data" id="semester" name="semester" style="width: 100%;">
                  <option value="1"
                    {{ (isset($records->semester) && $records->semester == '1') ? '' : 'selected' }}>ឆមាសទី ១</option>
                  <option value="2"
                    {{ (isset($records->semester) && $records->semester == '2') ? 'selected' : '' }}>ឆមាសទី ២</option>
                </select>
              </div>
            </div>
          </div>

      </div>
    </div>
  </form>
</div>
<div class="text-center khmer_os_b bold">
  បំពេញឈ្នោះលោក គ្រូ & អ្នកគ្រូ និងម៉ោងបង្រៀន
</div>  
@include('general.class_schedule_sub_lists')
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
          url = `/class-schedule/store`;
      } else {
          url = `/class-schedule/update`;
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
                window.location.href = "{{ url('/class-schedule/transaction?type=ed&code=' . \App\Service\service::Encr_string($records->id ?? '')) }}";
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
    $('#frmDataCard').each(function () {
        var fields = [
            { id: '#start_date', value: null, message: 'ត្រូវបំពេញ ចាប់ផ្តើមអនុវត្ត !' },
            { id: '#class_code', value: null, message: 'ត្រូវបំពេញ ថា្នក់/ក្រុម !' },
            { id: '#sections_code', value: 'A', message: 'ត្រូវបំពេញ វេន !' },
            { id: '#skills_code', value: 'IT', message: 'ត្រូវបំពេញ ជំនាញ !' },
            { id: '#department_code', value: null, message: 'ត្រូវបំពេញ ដេប៉ាតឺម៉ង់ !' },
            { id: '#school_year_code', value: null, message: 'ត្រូវបំពេញ ឆ្នាំសិក្សា !' },
            { id: '#is_active', value: 'yes', message: 'ត្រូវបំពេញ!' },
            { id: '#level', value: 'បរិញ្ញាបត្រ', message: 'ត្រូវបំពេញ កម្រិត !' },
            { id: '#semester', value: '1', message: 'ត្រូវបំពេញ ឆមាស!' }
        ];
        var inValid = false;
        fields.forEach(function (field) {
            var value = $(field.id).val();
            if (!value || value === '') {
                $(field.id).addClass('FieldRequired');
                description = field.message;
                inValid = true;
            } else {
                $(field.id).removeClass('FieldRequired');
                description = '234';
            }
        });
    });
    if(inValid){
        notyf.error(description);
    } 
    return inValid;
  }
</script>