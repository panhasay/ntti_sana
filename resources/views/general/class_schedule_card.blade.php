<base href="/public">
@extends('app_layout.app_layout')
<style>
    .table thead th {
        background: #d4d4d5;
        font-family: 'Khmer OS Battambang' !important;
        border: 1px solid #5b5b5b33 !important;
        padding: 8px !important;
    }
    .select2-container--default .select2-dropdown {
        font-size: .8125rem;
        z-index: 9999999999 !important;
    }
</style>
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
                        <span class="labels col-sm-3 col-form-label text-end">ចាប់ផ្តើមអនុវត្ត<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm " id="start_date" name="start_date" value="{{ $records->start_date ?? ''}}" placeholder="ចាប់ផ្តើមអនុវត្ត" aria-label="ចាប់ផ្តើមអនុវត្ត">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ថា្នក់/ក្រុម<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($classs as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) && $records->class_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name) ? $record->name : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">វេន<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="sections_code" name="sections_code" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($sections as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) && $records->sections_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ជំនាញ<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($skills as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) && $records->skills_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ដេប៉ាតឺម៉ង់<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($department as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ឆ្នាំសិក្សា<strong style="color:red; font-size:15px;"> *</strong></span>
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
                        <span class="labels col-sm-3 col-form-label text-end">កម្រិត<strong style="color:red; font-size:15px;"> *</strong></span>
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
                                <option value="1" {{ (isset($records->semester) && $records->semester == '1') ? '' : 'selected' }}>ឆមាសទី ១</option>
                                <option value="2" {{ (isset($records->semester) && $records->semester == '2') ? 'selected' : '' }}>ឆមាសទី ២</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">បរិញាប័ត្រ ឆ្នាំ<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="years" name="years" style="width: 100%;">
                                <option value="">&nbsp;</option>
                                @foreach ($study_years as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} - {{ isset($record->name_2) ? $record->name_2 : '' }}
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

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-6">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="AddTeacherSchedule" href="javascript:void(0);"><i class="mdi mdi-account-plus"></i> Add New</a>
        </div>
        <div class="col-md-6 col-sm-6 col-6 khmer_os_b bold">
            កាលវិភាគបង្រៀន
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalTeacherSchedule" tabindex="-1" aria-labelledby="ModalTeacherSchedule" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 100%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="ModalTeacherSchedule">កាលវិភាគបង្រៀន</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 400px;">
            <div class="control-table table-responsive custom-data-table-wrapper2">
                <form id="frmDataSublist" role="form" class="form-sample" enctype="multipart/form-data">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2">ឈ្មោះ​ សាស្រ្តាចារ្យ</th>
                            <th class="text-center" colspan="2">ចន្ទ</th>
                            <th class="text-center" colspan="2">អង្គា</th>
                            <th class="text-center" colspan="2">ពុធ</th>
                            <th class="text-center" colspan="2">ព្រហស្បត៏</th>
                            <th class="text-center" colspan="2">សុក្រ</th>
                            <th class="text-center" colspan="2">សៅរ៏</th>
                        </tr>
                        <tr class="general-data">
                            <th class="text-center"><input class="formSublist" type="time" date-name="monday" id="start_time_monday" name="start_time_monday" value="10"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="monday" id="end_time_monday" name="end_time_monday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="tuesday" id="start_time_tuesday" name="start_time_tuesday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="tuesday" id="end_time_tuesday" name="end_time_tuesday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="wednesday" id="start_time_wednesday" name="start_time_wednesday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="wednesday" id="end_time" name="end_time"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="thursday" id="start_time_thursday" name="start_time_thursday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="thursday" id="end_time_thursday" name="end_time_thursday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="friday" id="start_time_friday" name="start_time_friday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="friday" id="end_time_friday" name="end_time_friday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="saturday" id="start_time_saturday" name="start_time_saturday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="saturday" id="end_time_saturday" name="end_time_saturday"></th>
        
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="general-data">
                            <td class="text-letf">
                                <select class="js-example-basic-single FieldRequired formSublist" id="teacher_code_1" name="teacher_code" style="width: 100% !important;">
                                    <option value="">សាស្រ្តាចារ្យ</option>
                                    @foreach ($teachers as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="monday" id="subjects_code_monday" name="subjects_code_monday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room" class="formSublist text-center" name="room_monday" date-room="monday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="tuesday" id="subjects_code_tuesday" name="subjects_code_tuesday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room" class="formSublist text-center" name="room_tuesday" date-room="tuesday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="wednesday" id="subjects_code_wednesday" name="subjects_code_wednesday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room" class="formSublist text-center" name="room_wednesday" date-room="wednesday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="thursday" id="subjects_code_thursday" name="subjects_code_thursday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room" class="formSublist text-center" name="room_thursday" date-room="thursday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="friday" id="subjects_code_friday" name="subjects_code_friday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room" class="formSublist text-center" name="room_friday" date-room="friday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="saturday" id="subjects_code_saturday" name="subjects_code_saturday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room" class="formSublist text-center" name="room_saturday" date-room="saturday" placeholder="H & Room" style="width: 100%;">
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary khmer_os_b" data-bs-dismiss="modal">បិទ</button>
          <button type="button" id="SaveTeacherSchedule" class="btn btn-primary khmer_os_b">រក្សាទុក</button>
        </div>
      </div>
    </div>
  </div><br>
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
                if (FieldRequired()) return;
                url = `/class-schedule/store`;
            } else {
                url = `/class-schedule/update`;
            }
            $.ajax({
                type: "POST"
                , url: url
                , data: formData
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    if (response.status == 'success') {
                        notyf.success(response.msg);
                    } else if (response.store == 'yes') {
                        window.location.href = response.url;
                        notyf.success(response.msg);
                    } else {
                        notyf.error(response.msg);
                    }
                }
            });
        });
        // $('.formSublist').on('change', function() {
        //   var name = $(this).attr('name');
        //   var value = $(this).val();
        //   var date_name = $(this).attr('date-name');
        // });
        $("#AddTeacherSchedule").on('click', function() {
            $("#ModalTeacherSchedule").modal('show');
        })
        $("#SaveTeacherSchedule").on('click', function() {
            var frmDataSublist = $('#frmDataSublist').serialize();
            var code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";
            url = `/class-schedule/save-schedule?code=${code}`;
            $.ajax({
                type: "POST"
                , url: url
                , data: frmDataSublist
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    // if (response.status == 'success') {
                    //     notyf.success(response.msg);
                    // } else if (response.store == 'yes') {
                    //     window.location.href = response.url;
                    //     notyf.success(response.msg);
                    // } else {
                    //     notyf.error(response.msg);
                    // }
                }
            });
        })
        $(".formSublista").on('change', function() {
            var name = $(this).attr('name');
            var value = $(this).val();
            var date_name = $(this).attr('date-name');
            var date_type = $(this).attr('date-type');
            var date_room = $(this).attr('date-room');
            var code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";
            url = `/class-schedule/save-schedule?&name=` + name + `&value=` + value + `&date_name=` + date_name + `&date_type=` + date_type + `&date_room=` + date_room + `&code=` + code;
            $.ajax({
                type: "POST"
                , url: url
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , success: function(response) {
                    // if (response.status == 'success') {
                    //     notyf.success(response.msg);
                    // } else if (response.store == 'yes') {
                    //     window.location.href = response.url;
                    //     notyf.success(response.msg);
                    // } else {
                    //     notyf.error(response.msg);
                    // }
                }
            });
        })
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
            type: "post"
            , url: url
            , data: data
            , headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , beforeSend: function() {
                // $.LoadingOverlay("show", {
                //   custom: loadingOverlayCustomElement
                // });
                // loadingOverlayCustomElement.text('Request Processing...');
            }
            , success: function(response) {
                $.LoadingOverlay("hide", true);
                if (response.status == 'success') {
                    $('#divPassword').modal('hide');
                    location.href = response.path;
                    // myfn.showNotify(response['status'], 'lime', 'top', 'right', response['message']);
                } else {
                    $('.secure_msg').html(response.message);
                    $('.secure_msg').show();
                }
            }
            , error: function(xhr, ajaxOptions, thrownError) {}
        });
    }

    function FieldRequired() {
        var inValid = false;
        $('#frmDataCard').each(function() {
            var fields = [{
                    id: '#start_date'
                    , value: null
                    , message: 'ត្រូវបំពេញ ចាប់ផ្តើមអនុវត្ត !'
                }
                , {
                    id: '#class_code'
                    , value: null
                    , message: 'ត្រូវបំពេញ ថា្នក់/ក្រុម !'
                }
                , {
                    id: '#sections_code'
                    , value: 'A'
                    , message: 'ត្រូវបំពេញ វេន !'
                }
                , {
                    id: '#skills_code'
                    , value: 'IT'
                    , message: 'ត្រូវបំពេញ ជំនាញ !'
                }
                , {
                    id: '#department_code'
                    , value: null
                    , message: 'ត្រូវបំពេញ ដេប៉ាតឺម៉ង់ !'
                }
                , {
                    id: '#school_year_code'
                    , value: null
                    , message: 'ត្រូវបំពេញ ឆ្នាំសិក្សា !'
                }
                , {
                    id: '#is_active'
                    , value: 'yes'
                    , message: 'ត្រូវបំពេញ!'
                }
                , {
                    id: '#level'
                    , value: 'បរិញ្ញាបត្រ'
                    , message: 'ត្រូវបំពេញ កម្រិត !'
                }
                , {
                    id: '#semester'
                    , value: '1'
                    , message: 'ត្រូវបំពេញ ឆមាស!'
                }
            ];
            var inValid = false;
            fields.forEach(function(field) {
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
        if (inValid) {
            notyf.error(description);
        }
        return inValid;
    }

</script>
