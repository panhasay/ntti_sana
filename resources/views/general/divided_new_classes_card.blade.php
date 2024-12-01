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
                <div class="title-report">
                    <a href="{{ url('/class-schedule') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
                    @if($type != 'ed')
                       
                    @endif
                    {{-- @if(count($record_sub_lines) <= 0)
                        <button type="button" id="BtnSave" class="btn btn-success"> save </button>
                    @endif --}}
                   បញ្ចូលនិស្សិតចូល ក្រុម/ថា្នក់​:{{ $records->name ??'' }}
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
                {{-- <div class="col-md-6">
                    <div class="form-group row">
                        <input type="hidden" id="type" name="type" value="{{ $records->id ?? '' }}">
                        <span class="labels col-sm-3 col-form-label text-end">ចាប់ផ្តើមអនុវត្ត<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <input type="date" class="form-control form-control-sm " id="start_date" name="start_date" value="{{ $records->start_date ?? ''}}" placeholder="ចាប់ផ្តើមអនុវត្ត" aria-label="ចាប់ផ្តើមអនុវត្ត"  {{ (count($record_sub_lines) > 0) ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ថា្នក់/ក្រុម<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code" style="width: 100%;" {{ (count($record_sub_lines) > 0) ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($classs as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->code) && $records->code == $record->code ? 'selected' : '' }}>
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
                            <select class="js-example-basic-single FieldRequired" id="sections_code" name="sections_code" style="width: 100%;" {{ (count($record_sub_lines) > 0) ? 'disabled' : '' }}>
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
                            <select class="js-example-basic-single FieldRequired" id="skills_code" name="skills_code" style="width: 100%;" {{ (count($record_sub_lines) > 0) ? 'disabled' : '' }}>
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
                            <select class="js-example-basic-single FieldRequired" id="department_code" name="department_code" style="width: 100%;" {{ (count($record_sub_lines) > 0) ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($department as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->name_2) ? $record->name_2 : '' }}
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
                            <select class="js-example-basic-single FieldRequired" id="school_year_code" name="school_year_code" style="width: 100%;" {{ (count($record_sub_lines) > 0) ? 'disabled' : '' }}>
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
                        <span class="labels col-sm-3 col-form-label text-end">កម្រិត<strong style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" id="level" name="level" style="width: 100%;" {{ (count($record_sub_lines) > 0) ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($qualifications as $value => $label)
                                    <option value="{{ $label->code }}" {{ isset($records->level) && $records->level == $label->code ? 'selected' : '' }}>
                                        {{ $label->code ?? ''}}
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
        <div class="col-md-12 col-sm-12 col-6">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="GetStudnetRegister" href="javascript:void(0);"><i class="mdi mdi-account-plus"></i> Add New</a>
            {{-- <button type="button" id="prints" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
                <i class="mdi mdi-printer btn-icon-append"></i>
            </button> --}}
            <button type="button" id="BtnDownlaodExcel"
                class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
                class="mdi mdi-printer btn-icon-append"></i> 
            </button>
            <span class="title-report">
                បន្ថែបពត៍មាននិស្សិតចូលថ្នាក់ {{ $records->code ?? '' }} សរុបចំនួន ​{{ count($record_sub_lines ?? '') }} / 55 នាក់
            </span>
        </div>
    </div>
</div>
<!-- Modal -->

<div class="modal fade" id="ModalStudnetRegister" tabindex="-1" aria-labelledby="ModalStudnetRegister" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" style="max-width: 100%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="ModalStudnetRegister">ឈ្មោះនិស្សិតឆ្នាំទី១ ក្រុម/ថ្នាក់​ {{ $records->code ?? '' }}</h5>
          <button type="button" id="btnClose" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 400px;">
            <div class="control-table table-responsive custom-data-table-wrapper2 contain-getStudentRegister">
                
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnClose" class="btn btn-secondary khmer_os_b" data-bs-dismiss="modal">បិទ</button>
          {{-- <button type="button" id="SaveTeacherSchedule" class="btn btn-primary khmer_os_b">រក្សាទុក</button> --}}
        </div>
      </div>
    </div>
</div>

<!---PRINT--->
<div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-m-header">
          <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
        </div>
        <div class="modal-body">
          <h4 class="modal-confirmation-text text-center p-4"></h4>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="YesPrints" data-code="{{ $_GET['assing_no'] ?? '' }}" data-id=""
            class="btn btn-primary">Yes</button>
        </div>
      </div>
    </div>
  </div>
  <!---PRINT CONNECT--->
  <div class="print" style="display: none">
    <div class="print-content">
  
    </div>
  </div>
  <!-- Modal -->

<div class="modal fade" id="divConfirmationline" tabindex="-1" role="dialog" aria-labelledby="divConfirmationline"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-m-header">
        <h5 class="modal-title" id="divConfirmationline">Confirmation</h5>
      </div>
      <div class="modal-body">
        <h4 class="modal-confirmation-text text-center p-4"></h4>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnYesLine" data-code="" class="btn btn-primary">Yes</button>
      </div>
    </div>
  </div>
</div>
@include('system.modal_comfrim_donwload')
@include('general.divided_new_classes_sub_lists')

<script>
    var header = "{{ $records }}"
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
        $("#GetStudnetRegister").on('click', function() {
            if (!header) {
                notyf.error("សូមបំពេញ ព៏តមានថ្នាក់និងឆ្នាំសិក្សាខាងលើ");
                return;
            }
            $('.js-example-basic-single').select2();
            let code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";
            let url = '/class-new/get-student-register?code=' + code;
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    $('.loader').hide(); // Hide the loader
                    $("#ModalStudnetRegister").modal('show'); // Show the modal
                    $('.contain-getStudentRegister').html(response); // Update the content of the modal body
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        });

        $(document).on('click', '#btnAddStudentToClasses', function() {
            var code = $(this).attr('data-code');
            var class_code = $(this).attr('data-class');
            var url = `/class-new/add-student-register?code=${code}&class_code=${class_code}`;

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    notyf.success("Student added successfully");
                    // Update the row with new data
                    $(`#row${code}`).replaceWith(response); 
                },
                error: function(error) {
                    notyf.error("Failed to add student");
                }
            });
        });
        $("#btnClose").on('click', function() {
            window.location.reload(); 
        });
        
        $(document).on('click', '#btnDeleteLine', function() {
            $(".modal-confirmation-text").html('Do you want to delete?');
            $("#btnYesLine").attr('data-code', $(this).attr('data-code'));
            $("#divConfirmationline").modal('show');
        });
        $(document).on('click', '#btnYesLine', function() {
            var code = $(this).attr('data-code');
            $.ajax({
                type: "POST",
                url: `/class-new/add-student-register-deleteline`,
                data: {
                    code: code
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Correct header location
                },
                success: function(response) {
                    if (response.status == 'success') {
                        $("#divConfirmationline").modal('hide');
                        $("#row_line" + code).remove();
                        notyf.success(response.msg);
                    }
                },
                error: function() {
                    notyf.error("Something went wrong. Please try again.");
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
                
                }
            });
        })
        $(document).on('click', '#prints', function() {
            $(".modal-confirmation-text").html('Do you want to Downlaod prints ?');
            $("#YesPrints").attr('data-code', $(this).attr('data-type'));
            $("#ModelPrints").modal('show');
        });
        $(document).on('click', '#YesPrints', function() {
            let code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";
            let url = '/class-new-print?code=' + code;
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                if (response.status != 'success') {
                    $('.loader').hide();
                    $('.print-content').printThis({});
                    $('.print-content').html(response);
                    $('#ModelPrints').modal('hide');
                } else {
                    $('.loader').hide();
                    notyf.error("Error: " + response.msg);
                }
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        });

        $(document).on('click', '.BtnEditeacher', function() {
            var code = $(this).attr('data-code');
            let url = 'update/class-schedule/transaction?id=' + code;
            jQuery(function() {
                $('#frmDataSublist')[0].reset();
            });
            $.ajax({
                type: 'get',
                url: url,
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(response) {
                    $('.loader').hide();

                    const days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
                    days.forEach(day => {
                        $(`#subjects_code_${day}`).append(new Option("មុខវិជ្ជា", "", true, true));
                    });

                    $("#teachers").append(new Option("សាស្រ្តាចារ្យ", "", true, true));

                    if (response.status === "success") {
                        $("#teachers").empty();
                        $("#teachers").append(new Option(response.records.teacher.name_2, "", true, true));
                        $.each(response.teachers, function(index, teacher) {
                                let option = new Option(teacher.name_2, teacher.code, false, false);
                                $("#teachers").append(option); 
                        });
                        
                        const days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
                        const day = response.records.date_name.toLowerCase();
                        if (days.includes(day)) {
                            // Define dynamic selectors based on the day
                            const subjectCodeSelector = `#subjects_code_${day}`;
                            const startTimeSelector = `#start_time_${day}`;
                            const endTimeSelector = `#end_time_${day}`;
                            const roomSelector = `#room_${day}`;
                            // Clear and set the main subject
                            $(subjectCodeSelector).empty().append(new Option(response.records.subject.name_2, "", true, true));
                            // Parse and format times
                            let [startHours, startMinutes] = response.records.start_time.split(":");
                            startHours = startHours.padStart(2, '0');
                            let endHours = parseInt(startHours) + 1;
                            if (endHours === 24) endHours = 0;
                            endHours = endHours.toString().padStart(2, '0');
                            const formattedStartTime = `${startHours}:${startMinutes}`;
                            const formattedEndTime = `${endHours}:${startMinutes}`;
                            // Set time and room values
                            $(startTimeSelector).val(formattedStartTime);
                            $(endTimeSelector).val(formattedEndTime);
                            $(roomSelector).val(response.records.room);
                            // Append additional subjects to the dropdown
                            response.subjects.forEach(subject => {
                                $(subjectCodeSelector).append(new Option(subject.name, subject.code, false, false));
                            });
                            // Initialize or refresh select2 and reset the value
                            $(subjectCodeSelector).select2().val("").trigger("change");
                        }

                    }
                    $('.js-example-basic-single').select2();
                    $("#ModalTeacherSchedule").modal("show");
                    $('#teachers, #subjects_code_monday, #subjects_code_tuesday, #subjects_code_wednesday, #subjects_code_thursday, #subjects_code_friday, #subjects_code_saturday').select2({
                        dropdownParent: $('#ModalTeacherSchedule') 
                    });
                    // Show the modal
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.loader').hide();
                }
            });
        });
    });

    function DownlaodExcel() {
        var url = 'class-new/transaction/download-excel';
        var data;
        let code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";
        if ($('#search_data').val() == '') {
            data = $("#advance_search").serialize();
        } else {
            data = 'code=' + code;
        }
        // Create a form to submit the data
        var form = $('<form>', {
            action: url,
            method: 'GET'
        });

        // Append the serialized data to the form
        $.each(data.split('&'), function(i, field) {
            var parts = field.split('=');
            form.append($('<input>', {
                type: 'hidden',
                name: decodeURIComponent(parts[0]),
                value: decodeURIComponent(parts[1])
            }));
        });

        // Append the form to the body and submit it
        $('body').append(form);
        form.submit();

        // Optionally, you can show a loader here
        $('.loader').hide();
        $("#divConfirmationExcel").modal('hide');
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
@endsection

