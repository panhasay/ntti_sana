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
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <div class="title-page p-2">
                ជ្រើសរើសសិស្សិតឡើងថ្នាក់
            </div>
            {{-- <div class="header-left">
                <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="BntCreate"
                    href="{{url('/student/registration/transaction?type=cr')}}"><i class="mdi mdi-account-plus"></i>
                    បន្ថែមថ្មី</i>
                </a>
                <button type="button" id="BtnDownlaodExcel"
                    class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
                        class="mdi mdi-printer btn-icon-append"></i>
                </button>
            </div> --}}
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/department-menu') }}">ទំព័រដើម</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/up-grade-class') }}">ឡើងថ្នាក់</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ជ្រើសរើសសិស្សិតឡើងថ្នាក់</li>
                    
                </ol>
            </nav>
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
                        <span class="labels col-sm-3 col-form-label text-end">ថា្នក់/ក្រុម<strong
                                style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                                style="width: 100%;" {{ count($record_sub_lines)> 0 ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($classs as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->code) && $records->code ==
                                    $record->code ? 'selected' : '' }}>
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
                                style="width: 100%;" {{ count($record_sub_lines)> 0 ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($skills as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->skills_code) &&
                                    $records->skills_code == $record->code ? 'selected' : '' }}>
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
                        <span class="labels col-sm-3 col-form-label text-end">ដេប៉ាតឺម៉ង់<strong
                                style="color:red; font-size:15px;"> *</strong></span>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single FieldRequired" id="department_code"
                                name="department_code" style="width: 100%;" {{ count($record_sub_lines)> 0 ? 'disabled'
                                : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($department as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->department_code) &&
                                    $records->department_code == $record->code ? 'selected' : '' }}>
                                    {{ isset($record->name_2) ? $record->name_2 : '' }}
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
                                name="school_year_code" style="width: 100%;" {{ count($record_sub_lines)> 0 ? 'disabled'
                                : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($school_years as $record)
                                <option value="{{ $record->code ?? '' }}" {{ isset($records->school_year_code) &&
                                    $records->school_year_code == $record->code ? 'selected' : '' }}>
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
                                count($record_sub_lines)> 0 ? 'disabled' : '' }}>
                                <option value="">&nbsp;</option>
                                @foreach ($qualifications as $value => $label)
                                <option value="{{ $label->code }}" {{ isset($records->level) && $records->level ==
                                    $label->code ? 'selected' : '' }}>
                                    {{ $label->code ?? '' }}
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
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="UpGradeClass"
                href="javascript:void(0);">UpGrade Class
            </a>
            <button type="button" id="BtnDownlaodExcel"
                class="btn btn-outline-success btn-icon-text btn-sm mb-2 mb-md-0 me-2">Excel <i
                    class="mdi mdi-printer btn-icon-append"></i>
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="divModalUpdradeClass" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-m-header">
                <h5 class="modal-title">Confirmation Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="divContent">
                    <!-- AJAX content loads here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnYesSaveAllstudent" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>

@include('system.modal_comfrim_donwload')
@include('general.upp_grade_class_sub_lists')

<script>
    $(document).ready(function() {
        $('#CheckAllStudent').on('change', function () {
            $('.CheckStudent').prop('checked', $(this).prop('checked'));
        });
        $(document).on('change', '.CheckStudent', function () {
            if (!$(this).prop('checked')) {
                $('#CheckAllStudent').prop('checked', false);
            } else if ($('.CheckStudent:checked').length === $('.CheckStudent').length) {
                $('#CheckAllStudent').prop('checked', true);
            }
        });

        // $('#UpGradeClass').on('click', function () {
        //     $("#divModalUpdradeClass").modal('show');
        // });
        
        $('#UpGradeClass').on('click', function () {
            let selectedStudents = [];

            $('.CheckStudent:checked').each(function () {
                selectedStudents.push($(this).data('code'));
            });

            if (selectedStudents.length === 0) {
                AlertMessager("warning", "សូមជ្រើសរើស​ !", "សូមជ្រើសរើសសិស្សយ៉ាងហោចណាស់ម្នាក់!");
                return;
            }
            // ✅ Get parameters from the URL
            let params = new URLSearchParams(window.location.search);
            let semester = params.get('semester');
            let years = params.get('years');
            let code = params.get('code');

            console.log('Selected student codes:', selectedStudents);

            $.ajax({
                url: 'up-grade-class/save-selected-students',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    student_codes: selectedStudents,
                    semester: semester,
                    years : years, 
                    class_code : code,
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $("#divModalUpdradeClass").modal('show');
                        $(".divContent").html(response.view);
                    } 
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('Server error occurred.');
                }
            });
        });

        $('#btnYesSaveAllstudent').on('click', function () {
            let students = [];

            // collect student codes from table
            $('.data-list-studnet tr').each(function () {
                let code = $(this).find('td:first').text().trim();
                if (code) students.push(code);
            });

            // collect other fields from modal
            let class_code = $('#class_code').val();
            let sections_code = $('#sections_code').val();
            let semester = $('#semester').val();
            let years = $('#years').val();
            let session_year_code = $('#session_y_code').val();

            if (students.length === 0) {
                alert('No students found!');
                return;
            }

            $.ajax({
                url: "up-grade-class/save-upgraded-students",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    student_codes: students,
                    class_code: class_code,
                    sections_code: sections_code,
                    semester: semester,
                    years: years,
                    session_year_code: session_year_code
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#divModalUpdradeClass').modal('hide');
                        window.location.href = "{{ url('up-grade-class') }}";
                    }else{
                        AlertMessager("warning", "មានរូចហើយ", response.msg);
                    }
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection