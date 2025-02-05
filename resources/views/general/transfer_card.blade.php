<base href="/public">
@extends('app_layout.app_layout')
@section('content')
<div class="page-head page-head-custom">
    <div class="row border-bottom p-2">
        <div class="col-md-6 col-sm-6  col-6">
            <div class="page-title page-title-custom">
                <div class="title-page">
                    <a href="{{ url('skills') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
                    @if($type == 'ed')
                    កែប្រែ, ជំនាញ {{ $records->name_2 ?? '' }}
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
                    <a id="btnShowMenuSetting" href="{{ url('skills') }}"><i class="mdi mdi-keyboard-return"></i></a>
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
                        <input type="hidden" id="type" name="type" value="{{ $records->no ?? '' }}">
                        <span class="labels col-sm-3 col-form-label text-end">ថ្នាក់/ក្រុម<strong
                                style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                                style="width: 100%;" {{ (count($record_sub_lines)> 0) ?
                                'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($classs as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) &&
                                    $records->class_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name) ?
                                    $record->name : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ផ្លាស់ប្ដូរទៅ ថ្នាក់/ក្រុម<strong
                                style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="transfer_to_class_code"
                                name="transfer_to_class_code" style="width: 100%;" {{ (count($record_sub_lines)> 0) ?
                                'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($classs as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->transfer_to_class_code) &&
                                    $records->transfer_to_class_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name) ?
                                    $record->name : '' }}
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
                            <select class="js-example-basic-single FieldRequired" id="sections_code"
                                name="sections_code" style="width: 100%;" {{ (count($record_sub_lines)> 0) ? 'disabled'
                                : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($sections as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) &&
                                    $records->sections_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ?
                                    $record->name_2 : '' }}
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
                            <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code"
                                style="width: 100%;" {{ (count($record_sub_lines)> 0) ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($skills as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) &&
                                    $records->skills_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ?
                                    $record->name_2 : '' }}
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
                            <select class="js-example-basic-single FieldRequired" id="department_code"
                                name="department_code" style="width: 100%;" {{ (count($record_sub_lines)> 0) ?
                                'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($department as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) &&
                                    $records->department_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ?
                                    $record->name_2 : '' }}
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
                            <select class="js-example-basic-single FieldRequired" id="school_year_code"
                                name="school_year_code" style="width: 100%;" {{ (count($record_sub_lines)> 0) ?
                                'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($school_years as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->session_year_code) &&
                                    $records->session_year_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->name) ? $record->name : '' }}
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
                            <select class="js-example-basic-single FieldRequired" id="qualification"
                                name="qualification" style="width: 100%;" {{ (count($record_sub_lines)> 0) ?
                                'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($qualifications as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->qualification) &&
                                    $records->qualification == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ឆមាស<strong
                                style="color:red; font-size:15px;">
                                *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single form_data" id="semester" name="semester"
                                style="width: 100%;" {{ (count($record_sub_lines)> 0) ? 'disabled' : '' }}>
                                <option value="1" {{ (isset($records->semester) && $records->semester == '1') ? '' :
                                    'selected' }}>ឆមាសទី ១</option>
                                <option value="2" {{ (isset($records->semester) && $records->semester == '2') ?
                                    'selected' : '' }}>ឆមាសទី ២</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">បរិញាប័ត្រ ឆ្នាំ<strong
                                style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="years" name="years"
                                style="width: 100%;" {{ (count($record_sub_lines)> 0) ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($study_years as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years
                                    == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ?
                                    $record->name_2 : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ផ្សេងៗ</span>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm " id="note" name="note" value="{{ $records->note ?? '' }}"
                                placeholder="ផ្សេងៗ">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@include('general.transfer_sub_lists')
<script>
    $(document).ready(function() {
        $('#BtnSave').on('click', function() {
            var formData = $('#frmDataCard').serialize();
            var type = $('#type').val();
            var url;
            if (!type) {
                url = `/transfer/store`;
            } else {
                url = `/transfer/update`;
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
</script>

@endsection