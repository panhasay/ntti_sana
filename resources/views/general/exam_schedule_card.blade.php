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
                    <a href="{{ url('/class-schedule') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
                    @if($type != 'ed')
                    បន្ថែមថ្មី
                    @endif
                    @if(count($record_sub_lines) <= 0) 
                    <button type="button" id="BtnSave" class="btn btn-success"> save </button>
                    @endif
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
                            <input type="date" class="form-control form-control-sm " id="start_date" name="start_date"
                                value="{{ $records->start_date ?? '' }}" placeholder="ចាប់ផ្តើមអនុវត្ត"
                                aria-label="ចាប់ផ្តើមអនុវត្ត" {{ count($record_sub_lines)> 0 ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <span class="labels col-sm-3 col-form-label text-end">ថ្នាក់/ក្រុម<strong
                                style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                                style="width: 100%;" {{ count($record_sub_lines)> 0 ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($classs as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->class_code) &&
                                    $records->class_code ?? '' == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} -
                                    {{ isset($record->name) ? $record->name : '' }}
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
                                name="sections_code" style="width: 100%;" {{ count($record_sub_lines)> 0 ? 'disabled' :
                                '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($sections as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->sections_code) &&
                                    $records->sections_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->code) ? $record->code : '' }} -
                                    {{ isset($record->name_2) ? $record->name_2 : '' }}
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
                        <span class="labels col-sm-3 col-form-label text-end">កម្រិត<strong
                                style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single" id="level" name="level" style="width: 100%;" {{
                                (count($record_sub_lines)> 0) ? 'disabled' : '' }}>
                                <?php 
                            $options = [
                                    'បរិញ្ញាបត្រ' => 'បរិញ្ញាបត្រ',
                                    'សញ្ញាបត្រជាន់ខ្ពស់បច្ចេកទេស' => 'សញ្ញាបត្រជាន់ខ្ពស់បច្ចេកទេស',
                                    'បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា' => 'បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា',
                                ];
                            ?>
                                @foreach ($options as $value => $label)
                                <option value="{{ $value }}" {{ isset($records->level) && $records->level == $value ?
                                    'selected' : '' }}>
                                    {{ $label }}
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
            </div>
        </div>
    </form>
</div>

<div class="container-fluid p-2">
    <div class="row">
        <div class="col-md-5 col-sm-5 col-5">
            
            @if(isset($records->id) && $records->id)
                <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-toggle="modal"
                data-bs-target="#examScheduleModal" data-exam-schedule="{{ $records->id ?? '' }}"
                href="{{ url('/exam-schedule/create?exam_schedule=' . $records->id ?? '') }}">
                <i class="mdi mdi-account-plus"></i> Add New</a>
            @endif
            

            <button type="button" id="print_exam_schedule"
                class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-toggle="modal"
                data-bs-target="#ModelPrints">
                <i class="mdi mdi-printer btn-icon-append"></i> Print
            </button>



        </div>
        <div class="col-md-7 col-sm-7 col-7 title-page">
            ឈ្មោះគ្រូនិង មុខវិជ្ចាប្រឡង
        </div>
    </div>
</div>

<div class="modal fade" id="examScheduleModal" tabindex="-1" aria-labelledby="examScheduleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:black" class="modal-title" id="examScheduleModalLabel">បង្កើតតារាងបែងចែក ការប្រឡង
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <form id="examScheduleForm">
                    @csrf
                    <div class="">
                        <button type="button" class="btn btn-primary" id="addRow">
                            <i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី
                        </button>
                    </div>
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr class="general-data">
                                <th width="100">កាលបរិច្ឆេទ</th>
                                <th width="80">មុខវិជ្ជា</th>
                                <th width="50"> សាស្ត្រាចារ្យ</th>
                                <th width="100">សកម្មភាព</th>
                            </tr>
                        </thead>
                    </table>
                    <div id="schedule-section">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                <button type="button" class="btn btn-primary" id="saveSchedule">រក្សាទុក</button>
            </div>
        </div>
    </div>
</div>

@include('system.model_upload_excel')
@include('system.model_exam_schedule')<br>

<div class="modal fade" id="divConfirmation" tabindex="-1" role="dialog" aria-labelledby="divConfirmation"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-m-header">
                <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
            </div>
            <div class="modal-body">
                <h4 class="modal-confirmation-text text-center p-4">បញ្ចាប់ថានិស្សិត&ZeroWidthSpace; ត្រូវ
                    លុប&ZeroWidthSpace;!&ZeroWidthSpace;</h4>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnYesLine" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-m-header">
                <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
                <h4 class="modal-confirmation-text text-center p-4">តើអ្នកច្បាស់អត់ថាចង់Printប្រឡងមែនទេ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnClose" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="YesPrints" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="print" style="display: none">
    <div class="print-content"></div>
</div>

@include('general.exam_schedule_sub_lists')
<script>
    $(document).ready(function() {
        const notyf = new Notyf();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#BtnSave').on('click', function () {
            var formData = $('#frmDataCard').serialize();
            var type = $('#type').val();
            var url;

            if (!type) {
                url = `/exam-schedule/store`;
            } else {
                url = `/exam-schedule/update`;
            }

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function (response) {
                    try {
                      
                        if (response.status === 'success') {
                            notyf.success(response.msg);
                        } else if (response.store === 'yes') {
                            window.location.href = response.url; 
                            notyf.success(response.msg);
                        } else {
                            notyf.error(response.msg);
                        }
                    } catch (e) {
                        console.error("Error processing the response:", e);
                        notyf.error("Unexpected error occurred while processing the response.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                    var errorMessage = xhr.responseText ? xhr.responseText : "An unknown error occurred.";
                    notyf.error(`Failed to process request: ${errorMessage}`);
                }
            });
        });

    
        
        // $('.js-example-basic-single').select2({
        //     dropdownParent: $('#editModal')
        // });
        
        $('.edit-btn').on('click', function() {
            const id = $(this).data('id');
            const date = $(this).data('date');
            const subjectsCode = $(this).data('subjects');
            const teacherCode = $(this).data('teacher');

            $('#edit-date').val(date);
            $('#edit-subject').val(subjectsCode).trigger('change');
            $('#edit-teacher').val(teacherCode).trigger('change');

            $('#editForm').attr('data-id', id);
        });

        $('.save-changes').on('click', function() {
            const id = $('#editForm').data('id');
            const formData = $('#editForm').serialize();

            $.ajax({
                type: 'POST'
                , url: `/exam-schedule/update/${id}`
                , data: formData
                , beforeSend: function() {
                    $('.loader').show();
                }
                , success: function(response) {
                    $('.loader').hide();
                    if (response.status === 'success') {
                        $('#editModal').modal('hide');
                        location.reload();
                        notyf.success(response.msg);
                        updateRowContent(id, response.data);
                    } else {
                        notyf.error(response.msg);
                    }
                }
                , error: function() {
                    $('.loader').hide();
                    notyf.error("An error occurred while updating.");
                }
            });
        });

        $('.delete-btn').on('click', function() {
            const id = $(this).data('id');
            $('#btnYesLine').data('id', id);


            const modal = new bootstrap.Modal(document.getElementById('divConfirmation'));
            modal.show();
        });

        $('#btnYesLine').on('click', function() {
            const id = $(this).data('id');


            performAjaxRequest({
                url: `/exam-schedule/delete/${id}`
                , method: 'DELETE'
                , beforeSend: () => $('.loader').show()
                , onSuccess: (response) => {
                    $('.loader').hide();
                    if (response.status === 'success') {
                        notyf.success(response.msg);
                        $(`#row${id}`).fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        notyf.error(response.msg);
                    }
                }
                , onError: () => {
                    $('.loader').hide();
                    notyf.error("An error occurred while deleting.");
                }
            });

            $('#divConfirmation').modal('hide');
        });

        function performAjaxRequest({
            url
            , method
            , beforeSend
            , onSuccess
            , onError
        }) {
            $.ajax({
                url: url
                , method: method
                , beforeSend: beforeSend
                , success: onSuccess
                , error: onError
            });
        }

        $('#btnClose').on('click', function() {
            $('#divConfirmation').modal('hide');
        });

        $(document).on('click', '#UploadDocument', function() {
            const code = $(this).data('code');
            $('#upload-record-id').val(code);
            $('#uploadFileModal').modal('show');
        });

        $('#document_exam').on('change', function() {
            const file = this.files[0];
            if (file.size > 10 * 1024 * 1024) {
                notyf.error("The file size exceeds the maximum limit of 10 MB.");
                $(this).val('');
            }
        });

        $(document).off('click', '#btnUploadPdf').on('click', '#btnUploadPdf', function() {
            const formData = new FormData($('#uploadFileForm')[0]);
            const recordId = $('#upload-record-id').val();
            const url = `/exam-schedule/upload-document?code=${recordId}`;

            $.ajax({
                type: 'POST'
                , url: url
                , data: formData
                , processData: false
                , contentType: false
                , beforeSend: function() {
                    $('#btnUploadPdf').prop('disabled', true).text('Uploading...');
                }
                , success: function(response) {
                    $('#btnUploadPdf').prop('disabled', false).text('Upload');
                    if (response.status === 'success') {
                        $('#uploadFileModal').modal('hide');
                        notyf.success(response.message);
                        location.reload();
                        $('#dataTable').DataTable().ajax.reload();
                        location.reload();
                    } else {
                        notyf.error(response.message);
                    }
                }
            , });
        });

        let maxRows = 8;
        let rowCount = 0;
        let savedRows = [];

        function initializeSelect2(element) {
            $(element).select2({
                dropdownParent: $('#examScheduleModal')
                , placeholder: ""
                , allowClear: true
                , width: '100%'
                , theme: 'classic'
            });
        }

        function addRow(data = {}) {
            if (rowCount < maxRows) {
                const section = $('#schedule-section');
                const newRow = `
            <div class="row mt-3 align-items-center gx-3">
                <div class="col-md-3">
                    <input type="date" name="date[]" class="form-control" value="${data.date || ''}" required>
                </div>

                <div class="col-md-3">
                    <select class="js-example-basic-single form_data form-control" name="subjects_code[]">
                        <option value="">-- Select Subject --</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->code }}" ${data.subject_code === '{{ $subject->code }}' ? 'selected' : ''}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="js-example-basic-single form_data form-control" name="teacher_code[]">
                        <option value="">-- Select Teacher --</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->code }}" ${data.teacher_code === '{{ $teacher->code }}' ? 'selected' : ''}>
                                {{ $teacher->name_2 }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="mdi mdi-delete-forever"></i> លុប</button>
                </div>
            </div>`;
                section.append(newRow);

                section.find('select[name="subjects_code[]"], select[name="teacher_code[]"]').each(function() {
                    initializeSelect2(this);
                });

                rowCount++;
            } else {
                notyf.error('You can only add up to 8 rows.');
            }
        }

        $('#examScheduleModal').on('shown.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            const examSchedule = button.data('exam-schedule');
            $('#examScheduleForm').data('exam-schedule', examSchedule);

            if (savedRows.length > 0) {
                $('#schedule-section').empty();
                rowCount = 0;
                savedRows.forEach(row => addRow(row));
            } else if (rowCount === 0) {
                addRow();
            }
        });

        $('#examScheduleModal').on('hide.bs.modal', function() {
            savedRows = [];
            $('#schedule-section .row').each(function() {
                const row = $(this);
                const rowData = {
                    date: row.find('input[type="date"]').val()
                    , subject_code: row.find('select[name="subjects_code[]"]').val()
                    , teacher_code: row.find('select[name="teacher_code[]"]').val()
                };
                savedRows.push(rowData);
            });
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('.row').fadeOut(300, function() {
                $(this).remove();
                rowCount--;
            });
        });

        $('#addRow').on('click', addRow);

        $('#saveSchedule').on('click', function() {
            const form = $('#examScheduleForm');
            const formData = form.serialize();
            const examSchedule = form.data('exam-schedule');

            $.ajax({
                url: '{{ route('save.exam.schedule') }}?exam_schedule=' + examSchedule
                , method: 'POST'
                , data: formData
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , beforeSend: function() {
                    $('.loader').show();
                    $('#saveSchedule').prop('disabled', true);
                }
                , success: function(response) {
                    $('.loader').hide();
                    $('#saveSchedule').prop('disabled', false);

                    if (response.status === 'success') {
                        notyf.success(response.msg);
                        $('#examScheduleModal').modal('hide');
                        savedRows = [];
                        rowCount = 0;

                        location.reload();
                    } else {
                        notyf.error(response.msg);
                    }
                }
                , error: function(xhr, status, error) {
                    $('.loader').hide();
                    $('#saveSchedule').prop('disabled', false);
                    notyf.error('An error occurred while saving the exam schedule');
                    console.error('Error:', error);
                }
            });
        });
    });

    function updateRowContent(id, data) {
        const row = $(`#row${id}`);
        row.find('.exam-date').text(data.formatted_date || '');
        row.find('.subject-name').text(data.subject.name || 'N/A');
        row.find('.teacher-name').text(data.teacher.name || 'N/A');
    }

    window.viewFile = function(url) {
        window.open(url, '_blank');
    };

    window.DownloadExcel = function() {
        const url = '/student/downlaodexcel/';
        const data = $('#search_data').val() === '' ? $("#advance_search").serialize() : 'value=' + $(
            '#search_data').val();

        $.ajax({
            type: "POST"
            , url: url
            , data: data
            , beforeSend: function() {}
            , success: function(response) {
                if (response.status === 'success') {
                    location.href = response.path;
                } else {
                    $('.secure_msg').html(response.message).show();
                }
            }
        });


    };

    window.importExcel = function() {
        $('#divUplocadExcel').modal('show');
    };

    document.getElementById('YesPrints').addEventListener('click', function() {
        const assignmentNo = this.getAttribute('data-code');
        const printContent = document.querySelector('.print-content');

        printContent.innerHTML = `
            <p>Printing schedule for Assignment #${assignmentNo}</p>
            `;

        const printDiv = document.querySelector('.print');
        printDiv.style.display = 'block';
        window.print();
        printDiv.style.display = 'none';
    });

</script>
@endsection