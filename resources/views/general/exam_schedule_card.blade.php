<base href="/public">
@extends('app_layout.app_layout')

@section('styles')
    <style>
        /* Session toggle button styles */
        .session-controls {
            display: flex;
            gap: 5px;
        }

        .toggle-session {
            padding: 2px 6px;
            font-size: 12px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .toggle-session:hover {
            transform: scale(1.1);
        }

        .session-content {
            transition: all 0.3s ease;
        }

        /* Session visibility states */
        .session-one.hidden .session-content,
        .session-two.hidden .session-content {
            display: none;
        }

        /* Disabled session styling */
        .session-disabled {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Session header styling */
        .session-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
            padding: 4px 8px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }

        .session-label {
            font-weight: 500;
            color: #495057;
            margin: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .session-controls {
                flex-direction: column;
                gap: 2px;
            }

            .toggle-session {
                padding: 1px 4px;
                font-size: 10px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-head page-head-custom">
        <div class="row border-bottom p-2">
            <div class="col-md-6 col-sm-6  col-6">
                <div class="page-title page-title-custom">
                    <div class="title-page">
                        <a href="{{ url('/exam-schedule') }}"><i class="mdi mdi-format-list-bulleted"></i></a>
                        @if ($type != 'ed')
                            បន្ថែមថ្មី
                        @endif
                        @if (count($record_sub_lines) <= 0)
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
                                <input type="date" class="form-control form-control-sm " id="start_date"
                                    name="start_date" value="{{ $records->start_date ?? '' }}"
                                    placeholder="ចាប់ផ្តើមអនុវត្ត" aria-label="ចាប់ផ្តើមអនុវត្ត"
                                    {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <span class="labels col-sm-3 col-form-label text-end">ថ្នាក់/ក្រុម<strong
                                    style="color:red; font-size:15px;"> *</strong></span>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single FieldRequired" id="class_code" name="class_code"
                                    style="width: 100%;" {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}
                                    {{ isset($records) ? '' : '' }}>
                                    @if (!isset($records))
                                        <option value="">&nbsp;</option>
                                    @endif
                                    @foreach ($classs as $class)
                                        <option value="{{ $class->code }}"
                                            {{ isset($records) && $records->class_code === $class->code ? 'selected' : '' }}>
                                            {{ $class->code }} - {{ $class->name }}
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
                                    name="sections_code" style="width: 100%;"
                                    {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                                    <option value="">&nbsp;</option>
                                    @foreach ($sections as $record)
                                        <option value="{{ $record->code ?? '' }}"
                                            {{ isset($records->sections_code) && $records->sections_code == $record->code ? 'selected' : '' }}>
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
                                    style="width: 100%;" {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                                    <option value="">&nbsp;</option>
                                    @foreach ($skills as $record)
                                        <option value="{{ $record->code ?? '' }}"
                                            {{ isset($records->skills_code) && $records->skills_code == $record->code ? 'selected' : '' }}>
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
                                    name="department_code" style="width: 100%;"
                                    {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                                    <option value="">&nbsp;</option>
                                    @foreach ($department as $record)
                                        <option value="{{ $record->code ?? '' }}"
                                            {{ isset($records->department_code) && $records->department_code == $record->code ? 'selected' : '' }}>
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
                            <span class="labels col-sm-3 col-form-label text-end">ឆ្នាំសិក្សា<strong
                                    style="color:red; font-size:15px;"> *</strong></span>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single FieldRequired" id="school_year_code"
                                    name="school_year_code" style="width: 100%;"
                                    {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                                    <option value="">&nbsp;</option>
                                    @foreach ($school_years as $record)
                                        <option value="{{ $record->code ?? '' }}"
                                            {{ isset($records->session_year_code) && $records->session_year_code == $record->code ? 'selected' : '' }}>
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
                                <select class="js-example-basic-single" id="level" name="level"
                                    style="width: 100%;" {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                                    <?php
                                    $options = [
                                        'បរិញ្ញាបត្រ' => 'បរិញ្ញាបត្រ',
                                        'សញ្ញាបត្រជាន់ខ្ពស់បច្ចេកទេស' => 'សញ្ញាបត្រជាន់ខ្ពស់បច្ចេកទេស',
                                        'បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា' => 'បន្តបរិញ្ញាបត្របច្ចេកវីទ្យា',
                                    ];
                                    ?>
                                    @foreach ($options as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ isset($records->level) && $records->level == $value ? 'selected' : '' }}>
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
                                    style="width: 100%;" {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                                    <option value="1"
                                        {{ isset($records->semester) && $records->semester == '1' ? '' : 'selected' }}>
                                        ឆមាសទី ១</option>
                                    <option value="2"
                                        {{ isset($records->semester) && $records->semester == '2' ? 'selected' : '' }}>
                                        ឆមាសទី ២</option>
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
                                    style="width: 100%;" {{ count($record_sub_lines) > 0 ? 'disabled' : '' }}>
                                    <option value="">&nbsp;</option>
                                    @foreach ($study_years as $record)
                                        <option value="{{ $record->code ?? '' }}"
                                            {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                            {{ isset($record->code) ? $record->code : '' }} -
                                            {{ isset($record->name_2) ? $record->name_2 : '' }}
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

                @if ($records)
                    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" data-bs-toggle="modal"
                        data-bs-target="#examScheduleModal" data-exam-schedule="{{ $records->id ?? '' }}"
                        href="{{ url('/exam-schedule/create?exam_schedule=' . $records->id ?? '') }}">
                        <i class="mdi mdi-account-plus"></i> Add News</a>
                @endif

                <!-- Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog"
                    aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the selected records?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes,
                                    Delete</button>
                            </div>
                        </div>
                    </div>
                </div>



                <button type="button" id="prints"
                    class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
                    <i class="mdi mdi-printer btn-icon-append"></i>
                </button>



            </div>
            <div class="col-md-7 col-sm-7 col-7 title-page ">
                ឈ្មោះគ្រូនិង មុខវិជ្ចាប្រឡង

            </div>
        </div>
    </div>

    <!-- Essential CSS for functionality and styling -->
    <style>
        /* Modal popup styling */
        .modal-popup {
            max-width: 98% !important;
            margin: 1rem auto !important;
        }

        .modal-dialog-scrollable {
            height: calc(100% - 3.5rem);
        }

        .modal-dialog-scrollable .modal-content {
            max-height: 100%;
        }

        .modal-dialog-scrollable .modal-body {
            overflow-y: auto;
            max-height: calc(100vh - 210px);
        }

        /* Table styling */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #dee2e6;
        }

        /* Table header styling */
        .table thead th {
            position: sticky;
            top: 0;
            background: #d4d4d5;
            z-index: 1;
            border: 1px solid #5b5b5b33 !important;
            padding: 8px !important;
            vertical-align: middle;
            font-weight: 600;
            font-family: 'Khmer OS Battambang' !important;
        }

        /* Table body styling */
        .table tbody td {
            border-bottom: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
            padding: 12px 8px !important;
            vertical-align: middle;
        }

        /* Input group styling */
        .input-group-stacked {
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 8px;
            background: #fff;
        }

        .input-group-stacked>div {
            padding: 8px;
            border-bottom: 1px solid #e9ecef;
        }

        .input-group-stacked>div:last-child {
            border-bottom: none;
        }

        .input-group-stacked label {
            color: #495057;
            font-weight: 500;
            margin-bottom: 4px;
        }

        /* Select2 styling */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-radius: 4px;
            height: 31px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 31px;
            padding-left: 8px;
        }

        /* Schedule section specific styling */
        #schedule-section {
            width: 100% !important;
            table-layout: fixed !important;
        }

        #schedule-section .schedule-row td {
            padding: 4px !important;
            vertical-align: middle !important;
            background-color: #fff !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }


        /* Input field optimization */
        #schedule-section input[type="date"],
        #schedule-section input[type="time"],
        #schedule-section input[type="text"] {
            height: 31px !important;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
            width: 100% !important;
            min-width: 0 !important;
            padding: 4px 8px 16px 8px !important;
            /* Increased padding-bottom to 16px */
        }

        /* Select2 container width optimization */
        #schedule-section .select2-container {
            width: 100% !important;
            min-width: 0 !important;
        }

        /* Modal optimization */
        .modal-popup {
            max-width: 98% !important;
            margin: 1rem auto !important;
        }

        .table-responsive {
            overflow-x: auto !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Compact button styling */
        #schedule-section .btn-danger {
            padding: 4px 8px !important;
            font-size: 12px !important;
            border-radius: 4px !important;
            white-space: nowrap !important;
        }

        /* Header optimization */
        #schedule-section thead th {
            padding: 6px 4px !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            text-align: center !important;
            background-color: #f8f9fa !important;
            border: 1px solid #dee2e6 !important;
            color: #333 !important;
            white-space: nowrap !important;
        }

        /* Dropdown styling */
        #schedule-section .select2-dropdown {
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
            font-size: 13px !important;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1) !important;
        }

        #schedule-section .select2-search--dropdown .select2-search__field {
            padding: 4px !important;
            font-size: 13px !important;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
        }

        #schedule-section .select2-results__option {
            padding: 6px 8px !important;
            font-size: 13px !important;
        }

        #schedule-section .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #f5f5f5 !important;
            color: #333 !important;
        }

        /* Row styling */
        #schedule-section tr {
            background-color: #fff !important;
            border-bottom: 1px solid #eee !important;
        }

        /* Fix for z-index issues */
        .select2-container--open {
            z-index: 9999 !important;
        }

        /* Dropdown styling for long text */
        .select2-results__option {
            white-space: normal !important;
            word-wrap: break-word !important;
            padding: 6px 8px !important;
            font-size: 13px !important;
            line-height: 1.4 !important;
            max-width: none !important;
        }

        /* Custom tooltip for truncated text */
        .select2-tooltip {
            position: absolute !important;
            background: rgba(0, 0, 0, 0.8) !important;
            color: #fff !important;
            padding: 5px 10px !important;
            border-radius: 4px !important;
            font-size: 12px !important;
            z-index: 10000 !important;
            max-width: 300px !important;
            word-wrap: break-word !important;
            display: none;
        }

        /* Table cell optimization */
        #schedule-section td {
            max-width: 0 !important;
            /* Force text truncation */
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }

        #schedule-section td:nth-child(6),
        #schedule-section td:nth-child(7) {
            min-width: 66px !important;
            /* Increased from 90px */
            width: auto !important;
        }

        /* Specific styling for time inputs */
        #schedule-section input[type="time"] {
            width: 120px !important;
            /* Increased from 90px */
            min-width: 120px !important;
            padding: 4px 12px !important;
            /* Increased horizontal padding */
            font-size: 14px !important;
            /* Slightly larger font */
            height: 31px !important;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
            background-color: #fff !important;
        }

        /* Adjust table header width to match */
        #schedule-section thead th:nth-child(6),
        #schedule-section thead th:nth-child(7) {
            min-width: 100px !important;
            width: auto !important;
        }

        /* Specific styling for exam schedule modal dropdowns */
        #examScheduleModal .select2-container {
            width: 100% !important;
        }

        #examScheduleModal .select2-container--default .select2-selection--single {
            height: 31px;
            border: 1px solid #ced4da;
        }

        #examScheduleModal .select2-container--default .select2-dropdown {
            margin-top: 1px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        /* Handle dropdown positioning */
        #examScheduleModal .select2-container--default.select2-container--open .select2-dropdown--below {
            margin-top: 1px;
        }

        #examScheduleModal .select2-container--default.select2-container--open .select2-dropdown--above {
            margin-top: -2px;
        }

        /* Ensure dropdowns are visible at bottom of modal */
        #examScheduleModal .select2-container--default .select2-results>.select2-results__options {
            max-height: 200px;
            overflow-y: auto;
        }

        /* Adjust dropdown position for bottom rows */
        #examScheduleModal .schedule-row:nth-last-child(-n+3) .select2-container--default.select2-container--open .select2-dropdown--below {
            margin-top: -202px;
            /* Flip dropdown direction for bottom rows */
            border-top: 1px solid #ced4da;
            border-bottom: 0;
        }

        /* Prevent modal background scroll when dropdown is open */
        #examScheduleModal.modal {
            overflow-y: hidden !important;
        }

        #examScheduleModal .modal-body {
            overflow-y: auto;
            padding-bottom: 20px;
        }

        /* Ensure proper z-indexing */
        .select2-container--open {
            z-index: 9999999 !important;
        }

        /* Prevent text overflow in dropdowns */
        #examScheduleModal .select2-results__option {
            white-space: normal;
            word-wrap: break-word;
            padding: 6px 12px;
        }

        /* Custom scrollbar for better visibility */
        #examScheduleModal .select2-results__options::-webkit-scrollbar {
            width: 8px;
        }

        #examScheduleModal .select2-results__options::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #examScheduleModal .select2-results__options::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        #examScheduleModal .select2-results__options::-webkit-scrollbar-thumb:hover {
            background: #555;
        }




        /* Remove the specific room-input style since we now have standardized inputs */
        #examScheduleModal .room-input[type="text"] {
            padding: 4px 8px !important;
        }

        /* Date input styling */
        #examScheduleModal input[type="date"].form-control {
            padding: 12px 10px 8px 10px !important;
            height: auto !important;
            border: 1px solid #ddd !important;
            border-radius: 4px !important;
        }
    </style>


    <!-- Modal with scrollable class -->
    <div class="modal fade" id="examScheduleModal" tabindex="-1" aria-labelledby="examScheduleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-popup modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examScheduleModalLabel" style="color:black;">បង្កើតតារាងបែងចែក ការប្រឡង
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('save.exam.schedule') }}" method="POST" id="examScheduleForm">
                        @csrf
                        <input type="hidden" id="examScheduleId" name="exam_schedule"
                            value="{{ $examScheduleId ?? '' }}">

                        @php
                            $examScheduleCount = \App\Models\General\ExamScheduleLine::where(
                                'exam_schedule_id',
                                $examScheduleId ?? '',
                            )->count();
                        @endphp

                        {{-- @if ($examScheduleCount < 6) --}}
                        <div class="mb-3"
                            style="position: sticky; top: 0; background: white; z-index: 2; padding: 10px 0;">
                            <button type="button" class="btn btn-primary" id="addRow">
                                <i class="mdi mdi-account-plus"></i> បន្ថែមថ្មី
                            </button>
                        </div>
                        {{-- @endif --}}

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="general-data">
                                        <th width="100">កាលបរិច្ឆេទ<strong style="color:red; font-size:15px;">
                                                *</strong></th>
                                        <th width="100">សាស្ត្រាចារ្យ<strong style="color:red; font-size:15px;">
                                                *</strong></th>
                                        <th width="100">អនុរក្ស</th>
                                        <th width="100">អនុរក្ស</th>
                                        <th width="100">មុខវិជ្ជា</th>
                                        <th width="70">ថ្ងៃប្រឡង</th>
                                        <th width="80">ម៉ោង<strong style="color:red; font-size:15px;"> *</strong></th>
                                        <th width="80">ដល់<strong style="color:red; font-size:15px;"> *</strong></th>
                                        <th width="50">លេខបន្ទប់<strong style="color:red; font-size:15px;"> *</strong>
                                        </th>
                                        <th width="10">សកម្មភាព</th>
                                    </tr>
                                </thead>
                                <tbody id="schedule-section">
                                    <!-- Dynamic rows will be inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                    <button type="submit" class="btn btn-primary" id="saveSchedule">រក្សាទុក</button>
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
                    <h4 class="modal-confirmation-text text-center p-4">អ្នកប្រាកដទេថាចង់លុបទិន្នន័យនេះ&ZeroWidthSpace;
                        ត្រូវ
                        តែលុប&ZeroWidthSpace;!&ZeroWidthSpace;</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnClose" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnYesLine" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Print Confirmation -->
    <div class="modal fade" id="ModelPrints" tabindex="-1" role="dialog" aria-labelledby="ModelPrints"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-m-header">
                    <h5 class="modal-title" id="divConfirmation">បោះពុម្ពកាលវិភាគប្រឡង</h5>
                </div>
                <div class="modal-body">
                    <h4 class="modal-confirmation-text text-center p-4">តើចង់បោះពុម្ពកាលវិភាគប្រឡងមែនទេ?</h4>
                    <div class="form-group px-3">
                        <div class="input-group">

                            <input type="text" class="form-control form-control-lg khmer_os_b" name="date_khmer"
                                placeholder="បញ្ចូលថ្ងៃ ខែ ឆ្នាំប្រឡង" style="font-size: 1rem;">
                        </div>
                        <small class="text-muted mt-4 d-block khmer_os_b">
                            <i class="mdi mdi-information-outline"></i>
                            ឧទាហរណ៍៖ ថ្ងៃទី១៥ ខែមករា ឆ្នាំ២០២៤
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnClose" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" id="YesPrints" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="print" style="display: none">
        <div class="print-content">

        </div>
    </div>



    @include('general.exam_schedule_sub_lists')
    <script>
        $(document).ready(function() {
            // Clear temporary data on page load
            localStorage.removeItem('examScheduleTemp');

            let maxRows = 6;
            let rowCount = $('#schedule-section .schedule-row').length;

            // Cache modal parent and format functions for better performance
            const $modalParent = $('#examScheduleModal');
            const formatOptionFn = function(option) {
                if (!option.id) return option.text;
                return $('<span style="font-family: \'Khmer OS Battambang\'; font-size: 13px;">' + option.text +
                    '</span>');
            };

            function initializeSelect2(element) {
                // Skip if already initialized
                if ($(element).hasClass('select2-hidden-accessible')) {
                    return;
                }

                // Cache jQuery element
                const $element = $(element);
                const isDateNameCode = $element.attr('name') === 'date_name_code[]';

                // Use cached options for better performance
                const select2Options = {
                    dropdownParent: $modalParent,
                    placeholder: $element.find('option:first').text() || "",
                    allowClear: false,
                    width: '100%',
                    disabled: $element.is(':disabled'),
                    language: {
                        noResults: () => "មិនមានលទ្ធផល"
                    },
                    templateResult: formatOptionFn,
                    templateSelection: formatOptionFn,
                    minimumResultsForSearch: isDateNameCode ? -1 : 10, // Disable search for date_name_code
                    closeOnSelect: true
                };

                // Initialize Select2
                $element.select2(select2Options);

                // Add event handler only for date_name_code fields
                if (isDateNameCode) {
                    $element.on('select2:opening', function(e) {
                        e.preventDefault();
                        return false;
                    });
                }
            }

            // Batch initialize multiple Select2 elements
            function initializeSelect2Batch(selector) {
                const elements = $(selector).not('.select2-hidden-accessible');
                if (!elements.length) return;

                // Process in small batches
                const batchSize = 4;
                let index = 0;

                function initializeBatch() {
                    const end = Math.min(index + batchSize, elements.length);

                    for (; index < end; index++) {
                        initializeSelect2(elements[index]);
                    }

                    if (index < elements.length) {
                        requestAnimationFrame(initializeBatch);
                    }
                }

                requestAnimationFrame(initializeBatch);
            }

            // Map JavaScript day numbers to your day codes
            const dayMapping = {
                0: 'sunday', // Sunday
                1: 'monday', // Monday
                2: 'tuesday', // Tuesday
                3: 'wednesday', // Wednesday
                4: 'thursday', // Thursday
                5: 'friday', // Friday
                6: 'saturday' // Saturday
            };

            function getNextValidDate(currentDate) {
                const nextDate = new Date(currentDate);
                nextDate.setDate(nextDate.getDate() + 1);

                // Skip Sunday
                if (nextDate.getDay() === 0) {
                    nextDate.setDate(nextDate.getDate() + 1);
                }

                return nextDate.toISOString().split('T')[0];
            }

            // Store original values when modal opens
            let originalValues = {};

            // Disable save button and store original values when modal opens
            $('#examScheduleModal').on('show.bs.modal', function() {
                $('#saveSchedule').prop('disabled', true);

                // Store original values for all fields
                $('#schedule-section').find('input[name="date[]"]').each(function() {
                    const $element = $(this);
                    const rowIndex = $element.closest('tr').index();
                    originalValues['date_' + rowIndex] = $element.val();
                });
            });

            // Handle date changes specifically
            $(document).on('change', 'input[name="date[]"]', function() {
                const $element = $(this);
                const rowIndex = $element.closest('tr').index();
                const originalValue = originalValues['date_' + rowIndex];
                const currentValue = $element.val();

                // Enable save button if date is changed
                if (originalValue !== currentValue) {
                    $('#saveSchedule').prop('disabled', false);
                }

                // Call existing date change handler
                handleDateChange(this);
            });

            function handleDateChange(dateInput) {
                const row = $(dateInput).closest('tr');
                const selectedDate = new Date(dateInput.value);
                const dayNumber = selectedDate.getDay();

                // Map JavaScript day numbers (0-6) to your day codes
                const dayMapping = {
                    1: 'monday', // Monday
                    2: 'tuesday', // Tuesday
                    3: 'wednesday', // Wednesday
                    4: 'thursday', // Thursday
                    5: 'friday', // Friday
                    6: 'saturday' // Saturday
                };

                // If selected date is Sunday, show error and clear
                if (dayNumber === 0) {
                    notyf.error('មិនអាចជ្រើសរើសថ្ងៃអាទិត្យបានទេ សូមជ្រើសរើសថ្ងៃចន្ទ - ថ្ងៃសៅរ៍');
                    $(dateInput).val('');
                    return;
                }

                // Find and select the matching day option
                const daySelect = row.find('select[name="date_name_code[]"]');
                const dayCode = dayMapping[dayNumber];

                if (dayCode) {
                    // Always update the exam day to match the selected date
                    let matchingOption = daySelect.find('option').filter(function() {
                        return $(this).val().toLowerCase() === dayCode;
                    });

                    if (matchingOption.length) {
                        daySelect.val(matchingOption.val()).trigger('change');
                        row.attr('data-day-code', dayCode);
                    }
                }

                // Update next row's date if it exists
                const nextRow = row.next('.schedule-row');
                if (nextRow.length) {
                    const nextValidDate = getNextValidDate(selectedDate);
                    nextRow.find('input[name="date[]"]').val(nextValidDate).trigger('change');
                }

                // Enable save button since a change was made
                $('#saveSchedule').prop('disabled', false);
            }

            function addRow(data = null) {
                const currentRowCount = $('#schedule-section tr.schedule-row').length;
                if (currentRowCount >= maxRows) {
                    notyf.error("អ្នកអាចបន្ថែមបានត្រឹមតែ 6 ជួរប៉ុណ្ណោះ");
                    return;
                }

                const section = $('#schedule-section');

                // Get the appropriate date based on row position
                let nextDate = '';
                if (!data) {
                    if (currentRowCount === 0) {
                        const today = new Date();
                        nextDate = today.toISOString().split('T')[0];
                    } else {
                        const lastRow = section.find('tr.schedule-row:last');
                        const lastDate = lastRow.find('input[name="date[]"]').val();
                        if (lastDate) {
                            nextDate = getNextValidDate(lastDate);
                        }
                    }
                }

                const newRowHtml = `
            <tr class="schedule-row">
                <td><input type="date" name="date[]" class="form-control" value="${data ? data.date : nextDate}"></td>
                <td>
                    <div class="input-group-stacked">
                        <div class="mb-2 session-one">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="small mb-0">វេនទី១</label>
                                <div class="session-controls">
                                    <button type="button" class="btn btn-sm btn-outline-secondary toggle-session" data-session="first" title="បិទ/បើកវេនទី១">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="teacher_code_first[]">
                                    <option value="">សាស្ត្រាចារ្យ១</option>
                                </select>
                            </div>
                        </div>
                        <div class="session-two">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="small mb-0">វេនទី២</label>
                                <div class="session-controls">
                                    <button type="button" class="btn btn-sm btn-outline-secondary toggle-session" data-session="second" title="បិទ/បើកវេនទី២">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="teacher_code_sed[]">
                                    <option value="">សាស្ត្រាចារ្យ២</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group-stacked">
                        <div class="mb-2 session-one">
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="co_teacher_code[]">
                                    <option value="null">អនុរក្ស១-១</option>
                                </select>
                            </div>
                        </div>
                        <div class="session-two">
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="co_teacher_code_second[]">
                                    <option value="null">អនុរក្ស២-១</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group-stacked">
                        <div class="mb-2 session-one">
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="co_teacher_code1[]">
                                    <option value="null">អនុរក្ស១-២</option>
                                </select>
                            </div>
                        </div>
                        <div class="session-two">
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="co_teacher_code1_second[]">
                                    <option value="null">អនុរក្ស២-២</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group-stacked">
                        <div class="mb-2 session-one">
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="subjects_code[]">
                                    <option value="">មុខវិជ្ជា១</option>
                                </select>
                            </div>
                        </div>
                        <div class="session-two">
                            <div class="session-content">
                                <select class="js-example-basic-single form-control" name="subjects_code_second[]">
                                    <option value="">មុខវិជ្ជា២</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <select class="js-example-basic-single form-control" name="date_name_code[]" readonly disabled style="background-color: #e9ecef; pointer-events: none;">
                        <option value="">ថ្ងៃប្រឡង</option>
                        @foreach ($date_name as $record)
                            <option value="{{ $record->code }}">{{ $record->name_2 }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <div class="input-group-stacked">
                        <div class="mb-2 session-one">
                            <div class="session-content">
                                <input type="time" name="start_time[]" class="form-control" value="${data ? data.start_time : ''}">
                            </div>
                        </div>
                        <div class="session-two">
                            <div class="session-content">
                                <input type="time" name="start_time_second[]" class="form-control" value="${data ? data.start_time_second : ''}">
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group-stacked">
                        <div class="mb-2 session-one">
                            <div class="session-content">
                                <input type="time" name="end_time[]" class="form-control" value="${data ? data.end_time : ''}">
                            </div>
                        </div>
                        <div class="session-two">
                            <div class="session-content">
                                <input type="time" name="end_time_second[]" class="form-control" value="${data ? data.end_time_second : ''}">
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group-stacked">
                        <div class="mb-2 session-one">
                            <div class="session-content">
                                <input type="text" name="room[]" class="form-control room-input" value="${data && data.room !== undefined && data.room !== 'undefined' ? data.room : ''}">
                            </div>
                        </div>
                        <div class="session-two">
                            <div class="session-content">
                                <input type="text" name="room_second[]" class="form-control room-input" value="${data && data.room_second !== undefined && data.room_second !== 'undefined' ? data.room_second : ''}">
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="mdi mdi-delete-forever"></i> លុបជួរ
                    </button>
                </td>
            </tr>`;

                // Convert HTML string to jQuery object
                const $newRow = $(newRowHtml);
                section.append($newRow);
                rowCount++;

                // Initialize Select2 for the new row's dropdowns
                $newRow.find('.js-example-basic-single').each(function() {
                    initializeSelect2($(this));
                });

                // Set default times based on section type if no data provided
                if (!data) {
                    const sectionText = $('#sections_code option:selected').text().toLowerCase();
                    const isEveningSection = sectionText.includes('យប់') ||
                        sectionText.includes('ល្ងាច') ||
                        /\b(evening|night)\b/i.test(sectionText);

                    if (isEveningSection) {
                        // Evening section defaults
                        $newRow.find('input[name="start_time[]"]').val('17:30');
                        $newRow.find('input[name="end_time[]"]').val('20:30');
                        $newRow.find('input[name="start_time_second[]"]').val('17:30');
                        $newRow.find('input[name="end_time_second[]"]').val('20:30');
                    } else {
                        // Morning section defaults
                        $newRow.find('input[name="start_time[]"]').val('07:30');
                        $newRow.find('input[name="end_time[]"]').val('12:00');
                        $newRow.find('input[name="start_time_second[]"]').val('07:30');
                        $newRow.find('input[name="end_time_second[]"]').val('12:00');
                    }
                }

                // Load all teachers for co-teacher dropdowns
                $.ajax({
                    url: '/exam-schedule/get-all-teachers',
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            const coTeacherSelects = $newRow.find(
                                'select[name="co_teacher_code[]"], select[name="co_teacher_code1[]"], select[name="co_teacher_code_second[]"], select[name="co_teacher_code1_second[]"]'
                            );

                            coTeacherSelects.each(function() {
                                const select = $(this);
                                // Keep the first default option
                                const defaultOption = select.find('option:first');
                                select.empty().append(defaultOption);

                                // Add teacher options
                                response.data.forEach(function(teacher) {
                                    select.append(
                                        `<option value="${teacher.code}" ${data && data[select.attr('name').slice(0,-2)] === teacher.code ? 'selected' : ''}>
                                            ${teacher.name}
                                        </option>`
                                    );
                                });




                                // Reinitialize Select2
                                select.select2({
                                    dropdownParent: $('#examScheduleModal')
                                });
                            });
                        }
                    }
                });

                // If this is a new row (not loaded from data), load available options
                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();

                if (classCode && year && sessionYear) {
                    const sectionCode = $('#sections_code').val();
                    const semester = $('#semester').val();
                    const level = $('#level').val();
                    const skills_code = $('#skills_code').val();
                    const department_code = $('#department_code').val();

                    $.ajax({
                        url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success') {
                                const teacherSelect = $newRow.find(
                                    'select[name="teacher_code_first[]"]');
                                const teacherSelectSecond = $newRow.find(
                                    'select[name="teacher_code_sed[]"]');
                                const subjectSelect = $newRow.find(
                                    'select[name="subjects_code[]"]');
                                const subjectSelectSecond = $newRow.find(
                                    'select[name="subjects_code_second[]"]');

                                // Clear existing options except first
                                teacherSelect.find('option:not(:first)').remove();
                                subjectSelect.find('option:not(:first)').remove();
                                teacherSelectSecond.find('option:not(:first)').remove();
                                subjectSelectSecond.find('option:not(:first)').remove();

                                // Add options
                                response.data.forEach(function(item) {
                                    teacherSelect.append(
                                        `<option value="${item.teachers_code}" ${data && data.teacher_code === item.teachers_code ? 'selected' : ''}>
                                            ${item.teacher_name}
                                        </option>`
                                    );
                                    teacherSelectSecond.append(
                                        `<option value="${item.teachers_code}" ${data && data.teacher_code_sed === item.teachers_code ? 'selected' : ''}>
                                            ${item.teacher_name}
                                        </option>`
                                    );
                                    subjectSelect.append(
                                        `<option value="${item.subjects_code}" ${data && data.subjects_code === item.subjects_code ? 'selected' : ''}>
                                            ${item.subject_name}
                                        </option>`
                                    );
                                    subjectSelectSecond.append(
                                        `<option value="${item.subjects_code}" ${data && data.subjects_code_second === item.subjects_code ? 'selected' : ''}>
                                            ${item.subject_name}
                                        </option>`
                                    );
                                });

                                // Reinitialize Select2
                                teacherSelect.select2({
                                    dropdownParent: $('#examScheduleModal')
                                });
                                teacherSelectSecond.select2({
                                    dropdownParent: $('#examScheduleModal')
                                });
                                subjectSelect.select2({
                                    dropdownParent: $('#examScheduleModal')
                                });
                                subjectSelectSecond.select2({
                                    dropdownParent: $('#examScheduleModal')
                                });

                                // If we have data, trigger change events to ensure proper initialization
                                if (data) {
                                    teacherSelect.trigger('change');
                                    teacherSelectSecond.trigger('change');
                                    subjectSelect.trigger('change');
                                    subjectSelectSecond.trigger('change');
                                }
                            }
                        }
                    });
                }

                // Initialize the date's day selection if no data provided
                if (!data) {
                    const dateInput = $newRow.find('input[name="date[]"]')[0];
                    handleDateChange(dateInput);
                }

                // Add this specific initialization for teacher dropdown
                const teacherSelect = $newRow.find('select[name="teacher_code_first[]"]');
                const teacherSelectSecond = $newRow.find('select[name="teacher_code_sed[]"]');

                // If we have data with teacher_code
                if (data && data.teacher_code) {
                    teacherSelect.val(data.teacher_code);
                    teacherSelectSecond.val(data.teacher_code_sed);
                }

                // Initialize Select2 and trigger change
                teacherSelect.select2({
                    dropdownParent: $('#examScheduleModal')
                }).trigger('change');
                teacherSelectSecond.select2({
                    dropdownParent: $('#examScheduleModal')
                }).trigger('change');
            }

            // First, let's modify the loadAssignedTeachersAndSubjects function
            function loadAssignedTeachersAndSubjects() {
                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();
                const sectionCode = $('#sections_code').val();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();

                if (!classCode || !year || !sessionYear || !sectionCode || !semester || !level || !skills_code || !
                    department_code) {
                    return;
                }

                $.ajax({
                    url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update all teacher and subject dropdowns in the modal
                            $('#schedule-section .schedule-row').each(function() {
                                const row = $(this);
                                const teacherSelect = row.find(
                                    'select[name="teacher_code_first[]"]');
                                const teacherSelectSecond = row.find(
                                    'select[name="teacher_code_sed[]"]');
                                const subjectSelect = row.find(
                                    'select[name="subjects_code[]"]');
                                const subjectSelectSecond = row.find(
                                    'select[name="subjects_code_second[]"]');

                                // Store currently selected values
                                const selectedTeacher = teacherSelect.val();
                                const selectedTeacherSecond = teacherSelectSecond.val();
                                const selectedSubject = subjectSelect.val();
                                const selectedSubjectSecond = subjectSelectSecond.val();

                                // Clear existing options except first
                                teacherSelect.find('option:not(:first)').remove();
                                teacherSelectSecond.find('option:not(:first)').remove();
                                subjectSelect.find('option:not(:first)').remove();
                                subjectSelectSecond.find('option:not(:first)').remove();

                                // Add check to convert undefined room values to empty string
                                row.find('input[name="room[]"]').val(function(_, val) {
                                    return val === '' ? '' : val;
                                });
                                row.find('input[name="room_second[]"]').val(function(_, val) {
                                    return val === '' ? '' : val;
                                });

                                // Create sets for unique values
                                const uniqueTeachers = new Set();
                                const uniqueSubjects = new Set();

                                // Add unique options
                                response.data.forEach(function(item) {
                                    const teacherKey = item.teachers_code + '_' + item
                                        .teacher_name;
                                    const subjectKey = item.subjects_code + '_' + item
                                        .subject_name;

                                    if (!uniqueTeachers.has(teacherKey)) {
                                        uniqueTeachers.add(teacherKey);
                                        const option =
                                            `<option value="${item.teachers_code}">${item.teacher_name}</option>`;
                                        teacherSelect.append(option);
                                        teacherSelectSecond.append(option);
                                    }

                                    if (!uniqueSubjects.has(subjectKey)) {
                                        uniqueSubjects.add(subjectKey);
                                        const option =
                                            `<option value="${item.subjects_code}">${item.subject_name}</option>`;
                                        subjectSelect.append(option);
                                        subjectSelectSecond.append(option);
                                    }
                                });

                                // Restore selected values if they still exist in options
                                if (selectedTeacher) teacherSelect.val(selectedTeacher);
                                if (selectedTeacherSecond) teacherSelectSecond.val(
                                    selectedTeacherSecond);
                                if (selectedSubject) subjectSelect.val(selectedSubject);
                                if (selectedSubjectSecond) subjectSelectSecond.val(
                                    selectedSubjectSecond);

                                // Trigger change events to update Select2
                                teacherSelect.trigger('change');
                                teacherSelectSecond.trigger('change');
                                subjectSelect.trigger('change');
                                subjectSelectSecond.trigger('change');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading teachers and subjects:', error);
                    }
                });
            }

            // Call loadAssignedTeachersAndSubjects when relevant fields change
            $('#class_code, #years, #school_year_code, #sections_code, #semester, #level, #skills_code, #department_code')
                .on('change', function() {
                    loadAssignedTeachersAndSubjects();
                });


            // Improved handleTeacherSelection function
            function handleTeacherSelection(teacherSelect) {
                const row = $(teacherSelect).closest('tr');
                const isSecondSession = $(teacherSelect).attr('name') === 'teacher_code_sed[]';

                // Get elements for the specific session
                const coTeacher1 = row.find(`select[name="co_teacher_code${isSecondSession ? '_second' : ''}[]"]`);
                const coTeacher2 = row.find(`select[name="co_teacher_code1${isSecondSession ? '_second' : ''}[]"]`);
                const subjectSelect = row.find(`select[name="subjects_code${isSecondSession ? '_second' : ''}[]"]`);

                // Get the selected value
                const selectedTeacher = $(teacherSelect).val();

                if (selectedTeacher) {
                    // When teacher is selected:
                    // 1. Disable and clear co-teachers
                    coTeacher1.prop('disabled', true).val('null').trigger('change');
                    coTeacher2.prop('disabled', true).val('null').trigger('change');
                    updateSelect2Style(coTeacher1, true);
                    updateSelect2Style(coTeacher2, true);

                    // 2. Disable subject selection and set it automatically
                    subjectSelect.prop('disabled', true);
                    updateSelect2Style(subjectSelect, true);

                    // 3. Get and set the correct subject for this teacher
                    const classCode = $('#class_code').val();
                    const year = $('#years').val();
                    const sessionYear = $('#school_year_code').val();
                    const sectionCode = $('#sections_code').val();
                    const semester = $('#semester').val();
                    const level = $('#level').val();
                    const skills_code = $('#skills_code').val();
                    const department_code = $('#department_code').val();

                    $.ajax({
                        url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success') {
                                const teacherData = response.data.find(item => item.teachers_code ===
                                    selectedTeacher);
                                if (teacherData) {
                                    // Set the subject value but keep it disabled
                                    subjectSelect.val(teacherData.subjects_code).trigger('change');
                                    subjectSelect.prop('disabled', true);
                                    updateSelect2Style(subjectSelect, true);
                                }
                            }
                        }
                    });

                    // 4. Disable all other subject fields in the row
                    row.find('select[name*="subjects_code"]').each(function() {
                        if (this !== subjectSelect[0]) {
                            $(this).prop('disabled', true);
                            updateSelect2Style($(this), true);
                        }
                    });
                } else {
                    // When no teacher is selected:
                    // 1. Enable co-teachers
                    coTeacher1.prop('disabled', false);
                    coTeacher2.prop('disabled', false);
                    updateSelect2Style(coTeacher1, false);
                    updateSelect2Style(coTeacher2, false);

                    // 2. Check if any co-teacher is selected
                    const hasCoTeacher = (coTeacher1.val() && coTeacher1.val() !== 'null') ||
                        (coTeacher2.val() && coTeacher2.val() !== 'null');

                    // 3. Enable/disable subject based on co-teacher selection
                    if (hasCoTeacher) {
                        subjectSelect.prop('disabled', false);
                        updateSelect2Style(subjectSelect, false);
                    } else {
                        subjectSelect.prop('disabled', true).val('').trigger('change');
                        updateSelect2Style(subjectSelect, true);
                    }
                }
            }

            // Improved handleCoTeacherSelection function
            function handleCoTeacherSelection(coTeacherSelect) {
                const row = $(coTeacherSelect).closest('tr');
                const isSecondSession = $(coTeacherSelect).attr('name').includes('_second');

                // Get elements for the current session
                const teacherSelect = row.find(
                    `select[name="teacher_code${isSecondSession ? '_sed' : '_first'}[]"]`);
                const coTeacher1 = row.find(`select[name="co_teacher_code${isSecondSession ? '_second' : ''}[]"]`);
                const coTeacher2 = row.find(`select[name="co_teacher_code1${isSecondSession ? '_second' : ''}[]"]`);
                const subjectSelect = row.find(`select[name="subjects_code${isSecondSession ? '_second' : ''}[]"]`);

                // Check if either co-teacher has a valid value
                const hasCoTeacher = (coTeacher1.val() && coTeacher1.val() !== 'null') ||
                    (coTeacher2.val() && coTeacher2.val() !== 'null');

                if (hasCoTeacher) {
                    // If co-teacher is selected:
                    // 1. Disable teacher
                    teacherSelect.prop('disabled', true);
                    updateSelect2Style(teacherSelect, true);

                    // 2. Enable subject selection
                    subjectSelect.prop('disabled', false);
                    updateSelect2Style(subjectSelect, false);

                    // Load available subjects
                    loadAvailableSubjects(row, isSecondSession);
                } else {
                    // If no co-teacher is selected:
                    // 1. Enable teacher
                    teacherSelect.prop('disabled', false);
                    updateSelect2Style(teacherSelect, false);

                    // 2. Disable subject if no teacher is selected
                    if (!teacherSelect.val()) {
                        subjectSelect.prop('disabled', true).val('').trigger('change');
                        updateSelect2Style(subjectSelect, true);
                    }
                }
            }

            // Function to load available subjects
            function loadAvailableSubjects(row, isSecondSession) {
                const subjectSelect = row.find(`select[name="subjects_code${isSecondSession ? '_second' : ''}[]"]`);
                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();
                const sectionCode = $('#sections_code').val();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();

                if (!classCode || !year || !sessionYear || !sectionCode || !semester || !level || !skills_code || !
                    department_code) {
                    return;
                }

                $.ajax({
                    url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Store current value
                            const currentValue = subjectSelect.val();

                            // Clear existing options except first
                            subjectSelect.find('option:not(:first)').remove();

                            // Add all available subjects
                            response.data.forEach(function(item) {
                                subjectSelect.append(
                                    `<option value="${item.subjects_code}">${item.subject_name}</option>`
                                );
                            });

                            // Restore previous value if it exists in new options
                            if (currentValue && subjectSelect.find(`option[value="${currentValue}"]`)
                                .length > 0) {
                                subjectSelect.val(currentValue);
                            }

                            // Initialize Select2
                            subjectSelect.select2({
                                dropdownParent: $('#examScheduleModal')
                            });

                            // Ensure subject select is enabled
                            subjectSelect.prop('disabled', false);
                            updateSelect2Style(subjectSelect, false);
                        }
                    }
                });
            }

            // Helper function to update Select2 styling
            function updateSelect2Style(element, disabled) {
                if (!element || !element.length) return; // Check if element exists

                const select2Container = element.next('.select2-container');
                if (!select2Container || !select2Container.length) return; // Check if Select2 container exists

                if (disabled) {
                    select2Container.css({
                        'pointer-events': 'none',
                        'background-color': '#e9ecef',
                        'opacity': '0.7'
                    });
                } else {
                    select2Container.css({
                        'pointer-events': 'auto',
                        'background-color': '',
                        'opacity': '1'
                    });
                }
            }

            // Initialize row state when adding new rows
            function initializeRowState(row) {
                // First session
                const teacherFirst = row.find('select[name="teacher_code_first[]"]');
                const coTeacher1First = row.find('select[name="co_teacher_code[]"]');
                const coTeacher2First = row.find('select[name="co_teacher_code1[]"]');
                const subjectFirst = row.find('select[name="subjects_code[]"]');

                // Second session
                const teacherSecond = row.find('select[name="teacher_code_sed[]"]');
                const coTeacher1Second = row.find('select[name="co_teacher_code_second[]"]');
                const coTeacher2Second = row.find('select[name="co_teacher_code1_second[]"]');
                const subjectSecond = row.find('select[name="subjects_code_second[]"]');

                // Initialize first session
                if (!teacherFirst.val() && (!coTeacher1First.val() || coTeacher1First.val() === 'null') &&
                    (!coTeacher2First.val() || coTeacher2First.val() === 'null')) {
                    subjectFirst.prop('disabled', true);
                }

                // Initialize second session
                if (!teacherSecond.val() && (!coTeacher1Second.val() || coTeacher1Second.val() === 'null') &&
                    (!coTeacher2Second.val() || coTeacher2Second.val() === 'null')) {
                    subjectSecond.prop('disabled', true);
                }
            }

            // Add event listeners
            $(document).ready(function() {
                // Teacher selection handlers
                $(document).on('change',
                    'select[name="teacher_code_first[]"], select[name="teacher_code_sed[]"]',
                    function() {
                        handleTeacherSelection(this);
                    });

                // Co-teacher selection handlers
                $(document).on('change',
                    'select[name="co_teacher_code[]"], select[name="co_teacher_code1[]"], ' +
                    'select[name="co_teacher_code_second[]"], select[name="co_teacher_code1_second[]"]',
                    function() {
                        handleCoTeacherSelection(this);
                    }
                );

                // Initialize existing rows
                $('#schedule-section tr.schedule-row').each(function() {
                    initializeRowState($(this));
                });
            });

            // Add event listeners for teacher selection
            $(document).on('change', 'select[name="teacher_code_first[]"], select[name="teacher_code_sed[]"]',
                function() {
                    handleTeacherSelection($(this));
                });

            // Initialize the handlers for existing rows
            $(document).ready(function() {
                $('select[name="co_teacher_code[]"], select[name="co_teacher_code1[]"], select[name="co_teacher_code_second[]"], select[name="co_teacher_code1_second[]"]')
                    .each(function() {
                        handleCoTeacherSelection(this);
                    });
            });

            // Single definition of validateTimeRange
            function validateTimeRange(startTime, endTime) {
                if (!startTime || !endTime) {
                    return {
                        isValid: false,
                        message: 'សូមបញ្ចូលម៉ោងចាប់ផ្តើម និងម៉ោងបញ្ចប់'
                    };
                }

                // Get the section text to determine if it's morning or evening
                const sectionText = $('#sections_code option:selected').text().toLowerCase();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();
                const isEveningSection = sectionText.includes('យប់') || // night in Khmer
                    sectionText.includes('ល្ងាច') || // evening in Khmer
                    /\b(evening|night)\b/i.test(sectionText);

                const start = convertTimeToMinutes(startTime);
                const end = convertTimeToMinutes(endTime);

                const morningStart = convertTimeToMinutes('07:30');
                const morningEnd = convertTimeToMinutes('12:00');
                const eveningStart = convertTimeToMinutes('17:30');
                const eveningEnd = convertTimeToMinutes('20:30');

                if (end <= start) {
                    return {
                        isValid: false,
                        message: 'ម៉ោងបញ្ចប់ត្រូវតែក្រោយម៉ោងចាប់ផ្តើម'
                    };
                }

                if (isEveningSection) {
                    // Evening class validation
                    if (start < eveningStart || end > eveningEnd) {
                        return {
                            isValid: false,
                            message: 'ថ្នាក់ល្ងាចត្រូវតែជ្រើសរើសម៉ោងចាប់ពី 5:30 PM ដល់ 8:30 PM'
                        };
                    }
                } else {
                    // Morning class validation
                    if (start < morningStart || end > morningEnd) {
                        return {
                            isValid: false,
                            message: 'ថ្នាក់ព្រឹកត្រូវតែជ្រើសរើសម៉ោងចាប់ពី 7:30 AM ដល់ 12:00 AM'
                        };
                    }
                }

                return {
                    isValid: true
                };
            }

            // Event handlers
            $('#class_code, #years, #school_year_code, #semester, #level, #skills_code, #department_code').on(
                'change', loadAssignedTeachersAndSubjects);
            $('#sections_code').on('change', loadAssignedTeachersAndSubjects);
            $('#examScheduleModal').on('show.bs.modal', loadAssignedTeachersAndSubjects);

            // Add handler for teacher selection to manage co-teachers
            $(document).on('change', 'select[name="teacher_code_first[]"]', function() {
                handleTeacherSelection(this);
            });

            $(document).on('change', 'input[name="start_time[]"], input[name="end_time[]"]', function() {
                const row = $(this).closest('tr');
                const startTime = row.find('input[name="start_time[]"]').val();
                const endTime = row.find('input[name="end_time[]"]').val();

                if (startTime && endTime) {
                    const validation = validateTimeRange(startTime, endTime);
                    if (!validation.isValid) {
                        notyf.error(validation.message);
                        $(this).val('');
                    }
                }
            });

            // Add section change handler
            $(document).on('change', '#sections_code', function() {
                loadAssignedTeachersAndSubjects();
            });

            // Load assigned data when class, year, or session year changes
            $('#class_code, #years, #school_year_code, #semester, #level, #skills_code, #department_code').on(
                'change',
                function() {
                    loadAssignedTeachersAndSubjects();
                });

            // Modify modal hide handler to save all rows
            $('#examScheduleModal').on('hide.bs.modal', function() {
                const scheduleData = [];
                $('#schedule-section tr.schedule-row').each(function() {
                    const row = $(this);
                    const rowData = {
                        date: row.find('input[name="date[]"]').val(),
                        teacher_code: row.find('select[name="teacher_code_first[]"]').val(),
                        co_teacher_code: row.find('select[name="co_teacher_code[]"]').val(),
                        co_teacher_code1: row.find('select[name="co_teacher_code1[]"]').val() ||
                            null,
                        subjects_code: row.find('select[name="subjects_code[]"]').val(),
                        date_name_code: row.find('select[name="date_name_code[]"]').val(),
                        start_time: row.find('input[name="start_time[]"]').val(),
                        end_time: row.find('input[name="end_time[]"]').val(),
                        room: row.find('input[name="room[]"]').val()
                    };
                    scheduleData.push(rowData);
                });
                localStorage.setItem('examScheduleTemp', JSON.stringify(scheduleData));
            });

            // Add handler for modal show event to properly initialize states
            $('#examScheduleModal').on('show.bs.modal', function(e) {
                const scheduleId = $('#examScheduleId').val();
                $('#schedule-section').empty(); // Clear existing rows

                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();
                const sectionCode = $('#sections_code').val();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();

                if (scheduleId) {
                    // Load database data
                    $.ajax({
                        url: '/exam-schedule/get-schedule/' + scheduleId,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success' && response.data && response.data
                                .length > 0) {
                                // Group schedules by date
                                const groupedSchedules = {};
                                response.data.forEach(function(item) {
                                    if (!groupedSchedules[item.date]) {
                                        groupedSchedules[item.date] = {
                                            first: null,
                                            second: null
                                        };
                                    }
                                    if (item.is_second_schedule) {
                                        groupedSchedules[item.date].second = item;
                                    } else {
                                        groupedSchedules[item.date].first = item;
                                    }
                                });

                                // Add rows for each date with combined schedules
                                Object.entries(groupedSchedules).forEach(function([date,
                                        schedules
                                    ])

                                    {
                                        const first = schedules.first || {};
                                        const second = schedules.second || {};

                                        // Add the row with all data
                                        addRow({
                                            date: date,
                                            teacher_code: first.teacher_code,
                                            co_teacher_code: first.co_teacher_code,
                                            co_teacher_code1: first
                                                .co_teacher_code1,
                                            subjects_code: first.subjects_code,
                                            date_name_code: first.date_name_code ||
                                                second.date_name_code,
                                            start_time: first.start_time,
                                            end_time: first.end_time,
                                            room: first.room,
                                            teacher_code_sed: second.teacher_code,
                                            co_teacher_code_second: second
                                                .co_teacher_code,
                                            co_teacher_code1_second: second
                                                .co_teacher_code1,
                                            subjects_code_second: second
                                                .subjects_code,
                                            start_time_second: second.start_time,
                                            end_time_second: second.end_time,
                                            room_second: second.room
                                        });

                                        // Get the newly added row
                                        const row = $(
                                            '#schedule-section tr.schedule-row:last');

                                        // Handle session visibility based on data
                                        const hasFirstSessionData = first.teacher_code ||
                                            first.co_teacher_code || first
                                            .co_teacher_code1 || first.subjects_code;
                                        const hasSecondSessionData = second.teacher_code ||
                                            second.co_teacher_code || second
                                            .co_teacher_code1 || second.subjects_code;

                                        // Show/hide sessions based on data availability
                                        if (!hasFirstSessionData) {
                                            const firstSessionContent = row.find(
                                                '.session-one .session-content');
                                            const firstToggleBtn = row.find(
                                                '.session-one .toggle-session');
                                            firstSessionContent.hide();
                                            firstToggleBtn.find('i').removeClass('mdi-eye')
                                                .addClass('mdi-eye-off');
                                            firstToggleBtn.removeClass(
                                                'btn-outline-secondary').addClass(
                                                'btn-outline-danger');
                                        }

                                        if (!hasSecondSessionData) {
                                            const secondSessionContent = row.find(
                                                '.session-two .session-content');
                                            const secondToggleBtn = row.find(
                                                '.session-two .toggle-session');
                                            secondSessionContent.hide();
                                            secondToggleBtn.find('i').removeClass('mdi-eye')
                                                .addClass('mdi-eye-off');
                                            secondToggleBtn.removeClass(
                                                'btn-outline-secondary').addClass(
                                                'btn-outline-danger');
                                        }

                                        // Force update the date_name_code display after row is added
                                        const daySelect = row.find(
                                            'select[name="date_name_code[]"]');
                                        if (first.date_name_code || second.date_name_code) {
                                            const dayCode = first.date_name_code || second
                                                .date_name_code;
                                            daySelect.val(dayCode);
                                            const selectedText = daySelect.find(
                                                'option:selected').text();
                                            daySelect.next('.select2-container').find(
                                                    '.select2-selection__rendered')
                                                .text(selectedText)
                                                .removeClass(
                                                    'select2-selection__placeholder');
                                        }

                                        // Handle first session state
                                        if (first.teacher_code) {
                                            // If first session has teacher, disable conflicting selections
                                            row.find('select[name="teacher_code_sed[]"]')
                                                .find('option[value="' + first
                                                    .teacher_code + '"]')
                                                .prop('disabled', true);

                                            // Allow co-teachers for first session but prevent same teacher selection
                                            row.find(
                                                    'select[name="co_teacher_code[]"], select[name="co_teacher_code1[]"]'
                                                )
                                                .find('option[value="' + first
                                                    .teacher_code + '"]')
                                                .prop('disabled', true);
                                        } else if (first.co_teacher_code || first
                                            .co_teacher_code1) {
                                            // If first session has co-teachers, only disable those specific teachers
                                            const coTeachers = [first.co_teacher_code, first
                                                .co_teacher_code1
                                            ].filter(Boolean);
                                            coTeachers.forEach(function(teacherCode) {
                                                row.find(
                                                        'select[name="teacher_code_first[]"], select[name="teacher_code_sed[]"]'
                                                    )
                                                    .find('option[value="' +
                                                        teacherCode + '"]')
                                                    .prop('disabled', true);
                                            });
                                        }

                                        // Handle second session state
                                        if (second.teacher_code) {
                                            // If second session has teacher, only disable conflicting selections
                                            row.find('select[name="teacher_code_first[]"]')
                                                .find('option[value="' + second
                                                    .teacher_code + '"]')
                                                .prop('disabled', true);

                                            // Allow co-teachers for second session but prevent same teacher selection
                                            row.find(
                                                    'select[name="co_teacher_code_second[]"], select[name="co_teacher_code1_second[]"]'
                                                )
                                                .find('option[value="' + second
                                                    .teacher_code + '"]')
                                                .prop('disabled', true);
                                        } else if (second.co_teacher_code || second
                                            .co_teacher_code1) {
                                            // If second session has co-teachers, only disable those specific teachers
                                            const coTeachers = [second.co_teacher_code,
                                                second.co_teacher_code1
                                            ].filter(Boolean);
                                            coTeachers.forEach(function(teacherCode) {
                                                row.find(
                                                        'select[name="teacher_code_first[]"], select[name="teacher_code_sed[]"]'
                                                    )
                                                    .find('option[value="' +
                                                        teacherCode + '"]')
                                                    .prop('disabled', true);
                                            });
                                        }

                                        // Add validation to prevent same teacher in both sessions
                                        row.find('select').on('change', function() {
                                            const selectedTeacher = $(this).val();
                                            if (selectedTeacher &&
                                                selectedTeacher !== 'null') {
                                                row.find('select').not(this)
                                                    .find('option[value="' +
                                                        selectedTeacher + '"]')
                                                    .prop('disabled', true);
                                            }
                                        });

                                        // Update Select2 styling for all disabled fields
                                        row.find('select:disabled').each(function() {
                                            updateSelect2Style($(this), true);
                                        });

                                        // Handle subject fields
                                        if (first.teacher_code || first.co_teacher_code ||
                                            first.co_teacher_code1) {
                                            const firstSubject = row.find(
                                                'select[name="subjects_code[]"]');
                                            firstSubject.prop('disabled', first
                                                .teacher_code ? true : false);
                                            updateSelect2Style(firstSubject, first
                                                .teacher_code ? true : false);
                                        }

                                        if (second.teacher_code || second.co_teacher_code ||
                                            second.co_teacher_code1) {
                                            const secondSubject = row.find(
                                                'select[name="subjects_code_second[]"]');
                                            secondSubject.prop('disabled', second
                                                .teacher_code ? true : false);
                                            updateSelect2Style(secondSubject, second
                                                .teacher_code ? true : false);
                                        }
                                    });
                            }
                        }
                    });
                } else {
                    addRow(); // Add empty row for new schedule
                }
            });

            // Add this new function to check save button state
            function checkSaveButtonState() {
                const hasNewRows = $('#schedule-section tr.schedule-row:not(.existing-row)').length > 0;
                $('#saveSchedule').prop('disabled', !hasNewRows);
            }


            // Modify addRow click handler
            $(document).on('click', '#addRow', function() {
                const currentRowCount = $('#schedule-section tr.schedule-row').length;
                const maxRows = 6;

                if (currentRowCount >= maxRows) {
                    notyf.error('អ្នកអាចបន្ថែមបានត្រឹមតែ 6 ជួរប៉ុណ្ណោះ');
                    return;
                }

                // Add new row with default times based on section
                addRow();

                // Enable save button when new row is added
                $('#saveSchedule').prop('disabled', false);

                // Set default times based on section type
                const newRow = $('#schedule-section tr.schedule-row:last');
                if (isEveningSection) {
                    newRow.find('input[name="start_time[]"]').val('17:30');
                    newRow.find('input[name="end_time[]"]').val('20:30');
                } else {
                    newRow.find('input[name="start_time[]"]').val('07:30');
                    newRow.find('input[name="end_time[]"]').val('12:00');
                }
            });

            // Modify remove-row click handler
            $(document).on('click', '.remove-row', function() {
                const row = $(this).closest('tr');
                const allRows = $('#schedule-section tr.schedule-row');
                const totalRows = allRows.length;
                const examScheduleId = $('#examScheduleId').val();
                const isExistingRow = row.hasClass('existing-row');
                const date = row.find('input[name="date[]"]').val();

                // For new schedule (no examScheduleId), require at least one row
                if (!examScheduleId && totalRows <= 1) {
                    notyf.error('អ្នកត្រូវតែមានយ៉ាងហោចណាស់ជួរមួយ');
                    return false;
                }

                if (examScheduleId && date) {
                    // Delete both sessions for this date
                    $.ajax({
                        url: '/exam-schedule/delete-both-sessions',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            exam_schedule_id: examScheduleId,
                            date: date
                        },
                        success: function(response) {
                            if (response.success) {
                                row.fadeOut(300, function() {
                                    $(this).remove();
                                    if (isExistingRow) {
                                        $('#saveSchedule').prop('disabled', false);
                                    }
                                    notyf.success('ជួរត្រូវបានលុបដោយជោគជ័យ');
                                    updateDatesAfterDeletion();
                                });
                            }
                        },
                        error: function() {
                            notyf.error('មានបញ្ហាក្នុងការលុបជួរ');
                        }
                    });
                } else {
                    // Remove unsaved row
                    row.fadeOut(300, function() {
                        $(this).remove();
                        $('#saveSchedule').prop('disabled', false);
                        updateDatesAfterDeletion();
                    });
                }
            });

            // Function to update dates after row deletion
            function updateDatesAfterDeletion() {
                const rows = $('#schedule-section tr.schedule-row');
                if (!rows.length) return;

                let currentDate = new Date(rows.first().find('input[name="date[]"]').val());

                rows.each(function(index) {
                    if (index === 0) return; // Skip first row

                    // Get next valid date (skipping Sunday)
                    do {
                        currentDate.setDate(currentDate.getDate() + 1);
                    } while (currentDate.getDay() === 0); // Skip Sunday

                    // Update row date
                    $(this).find('input[name="date[]"]').val(currentDate.toISOString().split('T')[0]);
                    handleDateChange($(this).find('input[name="date[]"]')[0]);
                });
            }

            // Save handler - replaced with new session-aware validation in the document ready section below

            // Validation function - replaced with new session-aware validation in the document ready section below

            // Track form changes for validation messages
            let formHasChanges = false;
            let initialFormState = {};

            // Function to capture initial form state
            function captureInitialFormState() {
                initialFormState = {};
                $('#schedule-section').find('input, select').each(function() {
                    const $field = $(this);
                    const fieldName = $field.attr('name');
                    if (fieldName) {
                        let value = $field.val() || '';
                        if ($field.hasClass('select2-hidden-accessible')) {
                            value = $field.select2('val') || $field.val() || '';
                        }
                        initialFormState[fieldName] = value;
                    }
                });
                console.log('Initial form state captured');
            }

            // Function to check if form has changes
            function hasFormChanges() {
                let hasChanges = false;
                $('#schedule-section').find('input, select').each(function() {
                    const $field = $(this);
                    const fieldName = $field.attr('name');
                    if (fieldName && initialFormState.hasOwnProperty(fieldName)) {
                        let currentValue = $field.val() || '';
                        if ($field.hasClass('select2-hidden-accessible')) {
                            currentValue = $field.select2('val') || $field.val() || '';
                        }
                        const initialValue = initialFormState[fieldName] || '';

                        if (currentValue !== initialValue) {
                            hasChanges = true;
                            return false; // Break the loop
                        }
                    }
                });
                return hasChanges;
            }

            // Monitor form changes
            $(document).on('change input', '#schedule-section input, #schedule-section select', function() {
                formHasChanges = hasFormChanges();
            });

            // Monitor select2 changes
            $(document).on('select2:select select2:unselect', '#schedule-section select', function() {
                setTimeout(function() {
                    formHasChanges = hasFormChanges();
                }, 100);
            });

            // Initialize form state tracking
            $('#examScheduleModal').on('shown.bs.modal', function() {
                setTimeout(function() {
                    captureInitialFormState();
                }, 500);
            });

            // Add data-id to rows when loading existing data
            $('#examScheduleModal').on('show.bs.modal', function() {
                const examScheduleId = $('#examScheduleId').val();
                if (examScheduleId) {
                    $.ajax({
                        url: '/exam-schedule/get-schedule/' + examScheduleId,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success' && response.data) {
                                response.data.forEach(function(item) {
                                    const row = $('#schedule-section tr.schedule-row')
                                        .eq(item.row_index);
                                    row.attr('data-id', item.id);
                                });
                            }
                        }
                    });
                }
            });

            $(document).on('click', '#prints', function() {
                $("#ModelPrints").modal('show');
            });

            $(document).on('click', '#YesPrints', function() {
                let code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";
                let date_khmer = $('input[name="date_khmer"]').val();
                let url = '/exam-schedule-print?code=' + code;

                // First save the date_khmer
                $.ajax({
                    type: 'POST',
                    url: '/save-exam-date-khmer',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        date_khmer: date_khmer,
                        code: code
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // After saving date_khmer, proceed with printing
                            $.ajax({
                                type: 'get',
                                url: url,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
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
                                error: function(xhr, ajaxOptions, thrownError) {
                                    $('.loader').hide();
                                    notyf.error("Error occurred while printing");
                                }
                            });
                        } else {
                            notyf.error("Error saving date");
                        }
                    },
                    error: function() {
                        notyf.error("Error saving date");
                    }
                });
            });

            function convertTimeToMinutes(timeStr) {
                const [hours, minutes] = timeStr.split(':').map(Number);
                return hours * 60 + minutes;
            }


            // Add event listeners for all co-teacher selections
            $(document).on('change',
                'select[name="co_teacher_code[]"], select[name="co_teacher_code1[]"], select[name="co_teacher_code_second[]"], select[name="co_teacher_code1_second[]"]',
                function() {
                    handleCoTeacherSelection($(this));
                });

            // Add event listeners for teacher selection
            $(document).on('change', 'select[name="teacher_code_first[]"], select[name="teacher_code_sed[]"]',
                function() {
                    handleTeacherSelection($(this));
                });

            // Get the section type when modal opens
            const sectionText = $('#sections_code option:selected').text().toLowerCase();
            const semester = $('#semester').val();
            const level = $('#level').val();
            const skills_code = $('#skills_code').val();
            const department_code = $('#department_code').val();
            const isEveningSection = sectionText.includes('យប់') ||
                sectionText.includes('ល្ងាច') ||
                /\b(evening|night)\b/i.test(sectionText);

            // Set default times for all rows
            $('.schedule-row').each(function() {
                if (isEveningSection) {
                    $(this).find('input[name="start_time[]"]').val('17:30');
                    $(this).find('input[name="end_time[]"]').val('20:30');
                } else {
                    $(this).find('input[name="start_time[]"]').val('07:00');
                    $(this).find('input[name="end_time[]"]').val('12:00');
                }
            });

            // Enable save button on any change to any field
            $(document).on('change input select2:select', '#schedule-section input, #schedule-section select',
                function() {
                    const originalValue = $(this).data('original-value');
                    const currentValue = $(this).val();

                    if (!$(this).data('original-value')) {
                        $(this).data('original-value', currentValue);
                        return;
                    }

                    if (originalValue !== currentValue) {
                        $('#saveSchedule').prop('disabled', false);

                    }
                });

            // Add event handler for teacher selection to auto-select subject
            $(document).on('change select2:select', 'select[name="teacher_code_first[]"]', function() {
                const row = $(this).closest('tr');
                const teacherCode = $(this).val();
                const subjectSelect = row.find('select[name="subjects_code[]"]');

                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();
                const sectionCode = $('#sections_code').val();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();

                if (teacherCode) {
                    $.ajax({
                        url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success') {
                                const teacherData = response.data.find(item => item
                                    .teachers_code === teacherCode);
                                if (teacherData) {
                                    subjectSelect.val(teacherData.subjects_code).trigger(
                                        'change');
                                }
                            }
                        }
                    });
                }
            });

            // ... existing code ...
            $('#examScheduleModal').on('hide.bs.modal', function() {
                // Clear temporary data when modal is closed
                localStorage.removeItem('examScheduleTemp');

                // Clear the schedule section
                $('#schedule-section').empty();
            });
            // ... existing code ...

            // Add event handlers for both first and second session teacher selections
            $(document).on('change select2:select', 'select[name="teacher_code_first[]"]', function() {
                handleTeacherSubjectSelection(this, false);
            });

            $(document).on('change select2:select', 'select[name="teacher_code_sed[]"]', function() {
                handleTeacherSubjectSelection(this, true);
            });

            // Function to handle teacher-subject selection for both sessions
            function handleTeacherSubjectSelection(element, isSecondSession) {
                const row = $(element).closest('tr');
                const teacherCode = $(element).val();
                const subjectSelect = row.find(`select[name="subjects_code${isSecondSession ? '_second' : ''}[]"]`);

                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();
                const sectionCode = $('#sections_code').val();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();

                if (teacherCode && classCode && year && sessionYear && sectionCode && semester && level &&
                    skills_code && department_code) {
                    $.ajax({
                        url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success') {
                                const teacherData = response.data.find(item => item.teachers_code ===
                                    teacherCode);
                                if (teacherData) {
                                    subjectSelect.val(teacherData.subjects_code).trigger('change');
                                }
                            }
                        }
                    });
                }
            }

            // Add event handlers for co-teacher selection for both sessions
            $(document).on('change select2:select',
                'select[name="co_teacher_code[]"], select[name="co_teacher_code1[]"], select[name="co_teacher_code_second[]"], select[name="co_teacher_code1_second[]"]',
                function() {
                    const isSecondSession = $(this).attr('name').includes('_second');
                    handleCoTeacherSubjectSelection(this, isSecondSession);
                }
            );

            // Function to handle co-teacher subject selection
            function handleCoTeacherSubjectSelection(element, isSecondSession) {
                const row = $(element).closest('tr');
                const coTeacherText = $(element).find('option:selected').text();
                const subjectSelect = row.find(`select[name="subjects_code${isSecondSession ? '_second' : ''}[]"]`);

                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();
                const sectionCode = $('#sections_code').val();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();

                if (coTeacherText && coTeacherText !== 'អនុរក្ស១-១' && coTeacherText !== 'អនុរក្ស១-២' &&
                    coTeacherText !== 'អនុរក្ស២-១' && coTeacherText !== 'អនុរក្ស២-២') {
                    $.ajax({
                        url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success') {
                                const teacherData = response.data.find(item => item.teacher_name ===
                                    coTeacherText);
                                if (teacherData) {
                                    subjectSelect.val(teacherData.subjects_code).trigger('change');
                                }



                            }
                        }
                    });
                }
            }


            // ... existing code ...
            function validateForm() {
                let isValid = true;
                const errors = [];

                // Function to check if a row's professor or supervisors are selected
                function validateTeacherRow(row, sessionNum) {
                    const teacherSelect = row.find(
                        `select[name="teacher_code${sessionNum === 2 ? '_second' : ''}[]"]`);
                    const coTeacher1 = row.find(
                        `select[name="co_teacher_code${sessionNum === 2 ? '_second' : ''}[]"]`);
                    const coTeacher2 = row.find(
                        `select[name="co_teacher_code1${sessionNum === 2 ? '_second' : ''}[]"]`);

                    // Skip validation if the professor field is disabled (meaning supervisors are selected)
                    if (teacherSelect.prop('disabled')) {
                        return true;
                    }

                    // If professor field is enabled but empty, and no supervisors are selected, show error
                    if ((!teacherSelect.val() || teacherSelect.val() === '') &&
                        (!coTeacher1.val() || coTeacher1.val() === 'null') &&
                        (!coTeacher2.val() || coTeacher2.val() === 'null')) {
                        errors.push(`ជួរទី ${row.index() + 1} (វេនទី${sessionNum}): សូមជ្រើសរើសសាស្ត្រាចារ្យ`);
                        return false;
                    }
                    return true;
                }

                // Validate each row
                $('#schedule-section tr.schedule-row').each(function() {
                    const row = $(this);

                    // Validate first session
                    isValid = validateTeacherRow(row, 1) && isValid;

                    // Validate second session
                    isValid = validateTeacherRow(row, 2) && isValid;
                });

                // Display errors if any
                if (errors.length > 0) {
                    errors.forEach(error => {
                        notyf.error(error);
                    });
                }

                return isValid;
            }



            // Add this to your save button click handler
            $('#saveButton').on('click', function(e) {
                e.preventDefault();
                if (!validateForm()) {
                    return;
                }
                // ... rest of your save logic ...
            });

            // Add form validation function
            function validateExamSchedule() {
                let isValid = true;
                const errors = [];

                $('#schedule-section tr.schedule-row').each(function(index) {
                    const row = $(this);
                    const rowNum = index + 1;

                    // First session checks
                    const teacherFirst = row.find('select[name="teacher_code_first[]"]');
                    const coTeacher1First = row.find('select[name="co_teacher_code[]"]');
                    const coTeacher2First = row.find('select[name="co_teacher_code1[]"]');

                    // Second session checks
                    const teacherSecond = row.find('select[name="teacher_code_sed[]"]');
                    const coTeacher1Second = row.find('select[name="co_teacher_code_second[]"]');
                    const coTeacher2Second = row.find('select[name="co_teacher_code1_second[]"]');

                    // First session validation
                    if (!teacherFirst.prop('disabled')) {
                        // Only check if professor is not disabled
                        if (!teacherFirst.val() &&
                            (!coTeacher1First.val() || coTeacher1First.val() === 'null') &&
                            (!coTeacher2First.val() || coTeacher2First.val() === 'null')) {
                            errors.push(`ជួរទី ${rowNum} (វេនទី១): សូមជ្រើសរើសសាស្ត្រាចារ្យ`);
                            isValid = false;
                        }
                    } else {
                        // When professor is disabled, check if at least one supervisor is selected
                        if ((!coTeacher1First.val() || coTeacher1First.val() === 'null') &&
                            (!coTeacher2First.val() || coTeacher2First.val() === 'null')) {
                            errors.push(`ជួរទី ${rowNum} (វេនទី១): សូមជ្រើសរើសអនុរក្ស`);
                            isValid = false;
                        }
                    }

                    // Second session validation
                    if (!teacherSecond.prop('disabled')) {
                        // Only check if professor is not disabled
                        if (!teacherSecond.val() &&
                            (!coTeacher1Second.val() || coTeacher1Second.val() === 'null') &&
                            (!coTeacher2Second.val() || coTeacher2Second.val() === 'null')) {
                            errors.push(`ជួរទី ${rowNum} (វេនទី២): សូមជ្រើសរើសសាស្ត្រាចារ្យ`);
                            isValid = false;
                        }
                    } else {
                        // When professor is disabled, check if at least one supervisor is selected
                        if ((!coTeacher1Second.val() || coTeacher1Second.val() === 'null') &&
                            (!coTeacher2Second.val() || coTeacher2Second.val() === 'null')) {
                            errors.push(`ជួរទី ${rowNum} (វេនទី២): សូមជ្រើសរើសអនុរក្ស`);
                            isValid = false;
                        }
                    }
                });

                // Display all errors if any
                if (!isValid) {
                    errors.forEach(error => {
                        notyf.error(error);
                    });
                }

                return isValid;
            }

            // Add save button click handler
            $('#saveButton').on('click', function(e) {
                e.preventDefault();

                // Validate before saving
                if (!validateExamSchedule()) {
                    return;
                }

                // Continue with your existing save logic
                saveExamSchedule();
            });

            function saveExamSchedule() {
                // Your existing save logic here
                const scheduleData = [];
                $('#schedule-section tr.schedule-row').each(function() {
                    const row = $(this);
                    // ... rest of your existing save logic ...
                });
                // ... rest of your save code ...
            }
            // ... existing code ...

            // ... existing code ...
            // Add event handlers for teacher selection changes
            $(document).on('change', 'select[name="teacher_code_first[]"], select[name="teacher_code_sed[]"]',
                function() {
                    const row = $(this).closest('tr');
                    const isSecondSession = $(this).attr('name') === 'teacher_code_sed[]';
                    const teacherCode = $(this).val();

                    // Determine which subject select to update based on which teacher field changed
                    const subjectSelectName = isSecondSession ? 'subjects_code_second[]' : 'subjects_code[]';
                    const subjectSelect = row.find(`select[name="${subjectSelectName}"]`);

                    // Log for debugging
                    console.log('Teacher changed:', {
                        isSecondSession: isSecondSession,
                        teacherCode: teacherCode,
                        subjectSelectName: subjectSelectName
                    });

                    // Clear subject when teacher is cleared
                    if (!teacherCode) {
                        subjectSelect.val('').trigger('change');
                        return;
                    }

                    const classCode = $('#class_code').val();
                    const year = $('#years').val();
                    const sessionYear = $('#school_year_code').val();
                    const sectionCode = $('#sections_code').val();
                    const semester = $('#semester').val();
                    const level = $('#level').val();
                    const skills_code = $('#skills_code').val();
                    const department_code = $('#department_code').val();

                    // Validate required fields before proceeding
                    if (!classCode || !year || !sessionYear || !sectionCode || !semester || !level || !
                        skills_code || !department_code) {
                        notyf.error('សូមបំពេញព័ត៌មានចាំបាច់ទាំងអស់មុននឹងជ្រើសរើសសាស្ត្រាចារ្យ');
                        $(this).val('').trigger('change');
                        return;
                    }

                    // Proceed with teacher-subject association
                    $.ajax({
                        url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                        type: 'GET',
                        success: function(response) {
                            if (response.status === 'success') {
                                const teacherData = response.data.find(item => item
                                    .teachers_code === teacherCode);
                                if (teacherData) {
                                    // Set value to the correct subject select based on session
                                    subjectSelect.val(teacherData.subjects_code).trigger('change');

                                    // Log successful subject update
                                    console.log('Subject updated:', {
                                        subject: teacherData.subjects_code,
                                        selectName: subjectSelectName
                                    });
                                } else {
                                    subjectSelect.val('').trigger('change');
                                }
                            } else {
                                notyf.error('មានបញ្ហាក្នុងការទាញយកព័ត៌មានមុខវិជ្ជា');
                                subjectSelect.val('').trigger('change');
                            }
                        },
                        error: function() {
                            notyf.error('មានបញ្ហាក្នុងការទាញយកព័ត៌មានមុខវិជ្ជា');
                            subjectSelect.val('').trigger('change');
                        }
                    });

                    // Handle teacher selection for co-teachers
                    handleTeacherSelection(this);
                });

            // Add event handlers for co-teacher selection changes
            $(document).on('change',
                'select[name="co_teacher_code[]"], select[name="co_teacher_code1[]"], select[name="co_teacher_code_second[]"], select[name="co_teacher_code1_second[]"]',
                function() {
                    const row = $(this).closest('tr');
                    const isSecondSession = $(this).attr('name').includes('_second');
                    const subjectSelectName = isSecondSession ? 'subjects_code_second[]' : 'subjects_code[]';
                    const subjectSelect = row.find(`select[name="${subjectSelectName}"]`);
                    const coTeacherCode = $(this).val();

                    // Handle co-teacher selection
                    handleCoTeacherSelection(this);

                    // Clear subject if no co-teacher is selected
                    if (!coTeacherCode || coTeacherCode === 'null') {
                        const otherCoTeacher = row.find(
                                `select[name="co_teacher_code${isSecondSession ? '_second' : ''}[]"], select[name="co_teacher_code1${isSecondSession ? '_second' : ''}[]"]`
                            )
                            .not(this)
                            .filter(function() {
                                const val = $(this).val();
                                return val && val !== 'null';
                            });

                        const mainTeacher = row.find(
                            `select[name="teacher_code${isSecondSession ? '_sed' : '_first'}[]"]`).val();

                        if (!otherCoTeacher.length && !mainTeacher) {
                            subjectSelect.val('').trigger('change');
                        }
                    }
                }
            );

            // Add this function to handle subject loading and selection
            function loadAndSetSubjects(row, firstSchedule, secondSchedule) {
                if (!row) {
                    console.error('Row element is undefined');
                    return;
                }

                const classCode = $('#class_code').val();
                const year = $('#years').val();
                const sessionYear = $('#school_year_code').val();
                const sectionCode = $('#sections_code').val();
                const semester = $('#semester').val();
                const level = $('#level').val();
                const skills_code = $('#skills_code').val();
                const department_code = $('#department_code').val();

                // Add null checks for selects
                const subjectSelect = row.find('select[name="subjects_code[]"]');
                const subjectSelectSecond = row.find('select[name="subjects_code_second[]"]');

                if (!subjectSelect.length || !subjectSelectSecond.length) {
                    console.error('Subject select elements not found');
                    return;
                }

                // Store current values with null checks
                const firstSubject = firstSchedule && firstSchedule.subjects_code ? firstSchedule.subjects_code :
                    null;
                const secondSubject = secondSchedule && secondSchedule.subjects_code ? secondSchedule
                    .subjects_code : null;

                // Clear existing options except first
                subjectSelect.find('option:not(:first)').remove();
                subjectSelectSecond.find('option:not(:first)').remove();

                // Validate required parameters
                if (!classCode || !year || !sessionYear || !sectionCode || !semester || !level || !skills_code || !
                    department_code) {
                    console.error('Missing required parameters for subject loading');
                    return;
                }

                $.ajax({
                    url: `/exam-schedule/get-assigned-teachers-subjects/${classCode}/${year}/${sessionYear}/${sectionCode}/${semester}/${level}/${skills_code}/${department_code}`,
                    type: 'GET',
                    success: function(response) {
                        if (response && response.status === 'success' && Array.isArray(response.data)) {
                            // Add subject options
                            response.data.forEach(function(item) {
                                if (item && item.subjects_code && item.subject_name) {
                                    const option =
                                        `<option value="${item.subjects_code}">${item.subject_name}</option>`;
                                    subjectSelect.append(option);
                                    subjectSelectSecond.append(option);
                                }
                            });

                            // Set values after options are added
                            if (firstSubject) {
                                subjectSelect.val(firstSubject).trigger('change');
                            }
                            if (secondSubject) {
                                subjectSelectSecond.val(secondSubject).trigger('change');
                            }

                            // Initialize Select2 with null check for modal
                            const examScheduleModal = $('#examScheduleModal');
                            if (examScheduleModal.length) {
                                subjectSelect.select2({
                                    dropdownParent: examScheduleModal
                                });
                                subjectSelectSecond.select2({
                                    dropdownParent: examScheduleModal
                                });
                            }
                        } else {
                            console.error('Invalid response format:', response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading subjects:', error);
                        notyf.error('មានបញ្ហាក្នុងការទាញយកព័ត៌មានមុខវិជ្ជា');
                    }
                });
            }

            // Modify the modal show event handler
            $('#examScheduleModal').on('show.bs.modal', function(e) {
                const scheduleId = $('#examScheduleId').val();
                const scheduleSection = $('#schedule-section');

                if (!scheduleSection.length) {
                    console.error('Schedule section not found');
                    return;
                }

                scheduleSection.empty(); // Clear existing rows

                if (scheduleId) {
                    $.ajax({
                        url: '/exam-schedule/get-schedule/' + scheduleId,
                        type: 'GET',
                        success: function(response) {
                            if (response && response.status === 'success' && Array.isArray(
                                    response.data) && response.data.length > 0) {
                                // Group schedules by date
                                const groupedSchedules = {};
                                response.data.forEach(function(item) {
                                    if (item && item.date) {
                                        if (!groupedSchedules[item.date]) {
                                            groupedSchedules[item.date] = {
                                                first: null,
                                                second: null
                                            };
                                        }
                                        if (item.is_second_schedule) {
                                            groupedSchedules[item.date].second = item;
                                        } else {
                                            groupedSchedules[item.date].first = item;
                                        }
                                    }
                                });


                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error loading schedule:', error);
                            notyf.error('មានបញ្ហាក្នុងការទាញយកព័ត៌មានកាលវិភាគ');
                        }
                    });
                } else {
                    try {
                        const row = addRow();
                        if (row && row.find) { // Add null check for row
                            loadAndSetSubjects(row);
                        } else {
                            console.error('Invalid row element returned from addRow()');
                        }
                    } catch (error) {
                        console.error('Error adding initial row:', error);
                    }
                }
            });

            // Prevent subject change when teacher changes
            $(document).off('change', 'select[name="teacher_code_first[]"], select[name="teacher_code_sed[]"]');

            // Add room value handler
            $(document).ready(function() {
                // Handle room input changes
                $(document).on('change', 'input[name="room[]"], input[name="room_second[]"]', function() {
                    if ($(this).val() === 'undefined' || $(this).val() === undefined) {
                        $(this).val('');
                    }
                });

                // Initial cleanup of room values
                $('input[name="room[]"], input[name="room_second[]"]').each(function() {
                    if ($(this).val() === 'undefined' || $(this).val() === undefined) {
                        $(this).val('');
                    }
                });
            });

            // Add event handler for subject changes to ensure proper enabling/disabling
            $(document).on('change', 'select[name="subjects_code[]"], select[name="subjects_code_second[]"]',
                function() {
                    const row = $(this).closest('tr');
                    const isSecondSession = $(this).attr('name').includes('_second');

                    // Get relevant elements
                    const teacherSelect = row.find(
                        `select[name="teacher_code${isSecondSession ? '_sed' : '_first'}[]"]`);
                    const coTeacher1 = row.find(
                        `select[name="co_teacher_code${isSecondSession ? '_second' : ''}[]"]`);
                    const coTeacher2 = row.find(
                        `select[name="co_teacher_code1${isSecondSession ? '_second' : ''}[]"]`);

                    // Check if teacher is selected
                    const hasTeacher = teacherSelect.val() && teacherSelect.val() !== '';

                    // Check if any co-teacher has value
                    const hasCoTeacher = (coTeacher1.val() && coTeacher1.val() !== 'null') ||
                        (coTeacher2.val() && coTeacher2.val() !== 'null');

                    // If subject has a value, check conditions
                    if ($(this).val()) {
                        if (hasTeacher) {
                            // If teacher is selected, disable subject
                            $(this).prop('disabled', true);
                            updateSelect2Style($(this), false);
                        } else if (hasCoTeacher) {
                            // If co-teacher is selected, keep subject enabled
                            $(this).prop('disabled', false);
                            updateSelect2Style($(this), false);
                        } else {
                            // If neither teacher nor co-teacher, disable subject
                            $(this).prop('disabled', true);
                            updateSelect2Style($(this), false);
                        }
                    }
                });
        });

        var header = "{{ $records->class_code ?? '' }}"

        $(document).ready(function() {
            // Variables to track row deletion status
            var rowDeleted = false;
            var hasDeletedSavedData = false;

            // Handle row deletion using event delegation
            $(document).on('click', '.remove-row', function() {

                var row = $(this).closest('tr');

                // Check if this row has any selected values in dropdowns or input values
                var hasSelectedTeacher = row.find('select[name="teacher_code_first[]"]').val() ||
                    row.find('select[name="teacher_code_sed[]"]').val();
                var hasSelectedSubject = row.find('select[name="subjects_code[]"]').val() ||
                    row.find('select[name="subjects_code_second[]"]').val();
                var hasRoom = row.find('input[name="room[]"]').val() ||
                    row.find('input[name="room_second[]"]').val();

                // If any data is filled in, consider it as saved data
                if (hasSelectedTeacher || hasSelectedSubject || hasRoom) {
                    hasDeletedSavedData = true;
                }

                row.remove();
                rowDeleted = true;
                // Don't close modal - let user continue working

            });

            // Handle modal close event using event delegation
            $(document).on('hidden.bs.modal', '.modal', function() {
                // Only refresh if saved data was deleted
                if (rowDeleted && hasDeletedSavedData) {
                    location.reload();
                }
                // Reset flags
                rowDeleted = false;
                hasDeletedSavedData = false;
            });

            // Setup CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle main form save button
            $('#BtnSave').on('click', function() {
                var formData = $('#frmDataCard').serialize();
                var type = $('#type').val();
                var url;

                if (!type) {
                    if (FieldRequired()) return;
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
                    success: function(response) {
                        if (response.status == 'success') {
                            notyf.success('ការរក្សាទុកទិន្នន័យជោគជ័យ!');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        } else if (response.store == 'yes') {
                            notyf.success('ការរក្សាទុកទិន្នន័យជោគជ័យ!');
                            setTimeout(function() {
                                window.location.href = response.url;
                            }, 1500);
                        } else {
                            notyf.error(response.msg || 'មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ');
                        }
                    },
                    error: function(xhr) {
                        notyf.error('មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ');
                    }
                });
            });

            // Handle Add Exam Schedule button
            $("#AddExamSchedule").on('click', function() {
                if (!header) {
                    notyf.error("សូមបំពេញ ព៏តមានថ្នាក់និងឆ្នាំសិក្សាខាងលើ");
                    return;
                }

                // Reset form and initialize select2
                $('#frmDataSublist').find('input, select').val('').trigger('change');
                $('.js-example-basic-single').select2();
                $("#ModalExamSchedule").modal('show');

                // Initialize select2 dropdowns within modal
                $('#teachers_code, #subjects_code, #date_name, #co_teacher_code, #co_teacher_code1')
                    .select2({
                        dropdownParent: $('#ModalExamSchedule')
                    });

                // Reset form
                jQuery(function() {
                    $('#frmDataSublist')[0].reset();
                });

                // Initialize default options for dropdowns
                $("#subjects_code").append(new Option("មុខវិជ្ជា", "", true, true));
                $("#teachers_code").append(new Option("សាស្រ្តាចារ្យ", "", true, true));
                $("#co_teacher_code").append(new Option("សាស្រ្តាចារ្យរង", "", true, true));
                $("#co_teacher_code1").append(new Option("សាស្រ្តាចារ្យរង", "", true, true));
            });

            // Handle Save Exam Schedule button
            $("#SaveExamSchedule").on('click', function() {
                var frmDataSublist = $('#frmDataSublist').serialize();
                var code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";
                var dataId = $(this).attr('data-id');
                var url = `/exam-schedule/save-schedule?code=${code}&dataId=${dataId}`;

                $.ajax({
                    type: "POST",
                    url: url,
                    data: frmDataSublist,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            notyf.success('ការរក្សាទុកកាលវិភាគប្រឡងជោគជ័យ!');
                            $('#examScheduleContainer').html(response.view);
                            setTimeout(function() {
                                $("#ModalExamSchedule").modal('hide');
                            }, 1500);
                        } else if (response.status == "error") {
                            notyf.error(response.msg ||
                                'មានបញ្ហាក្នុងការរក្សាទុកកាលវិភាគប្រឡង');
                        }
                    },
                    error: function(xhr) {
                        notyf.error('មានបញ្ហាក្នុងការរក្សាទុកកាលវិភាគប្រឡង');
                    }
                });
            });

            // Handle form field changes
            $(".formSublista").on('change', function() {
                var name = $(this).attr('name');
                var value = $(this).val();
                var date_name = $(this).attr('date-name');
                var date_type = $(this).attr('date-type');
                var date_room = $(this).attr('date-room');
                var code = "{{ isset($_GET['code']) ? addslashes($_GET['code']) : '' }}";

                url =
                    `/exam-schedule/save-schedule?name=${name}&value=${value}&date_name=${date_name}&date_type=${date_type}&date_room=${date_room}&code=${code}`;

                $.ajax({
                    type: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            notyf.success('ការរក្សាទុកទិន្នន័យជោគជ័យ!');
                        } else if (response.status == "error") {
                            notyf.error(response.msg || 'មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ');
                        }
                    },
                    error: function(xhr) {
                        notyf.error('មានបញ្ហាក្នុងការរក្សាទុកទិន្នន័យ');
                    }
                });
            });

            // Function to validate required fields
            function FieldRequired() {
                var required = false;
                $('.required').each(function() {
                    if ($(this).val() == '') {
                        var label = $(this).parent().find('label').text();
                        notyf.error(label + " ត្រូវបំពេញ!");
                        required = true;
                        return false;
                    }
                });
                return required;
            }

            // Session toggle functionality
            $(document).on('click', '.toggle-session', function() {
                const button = $(this);
                const session = button.data('session');
                const row = button.closest('tr');
                const sessionContainer = session === 'first' ? row.find('.session-one') : row.find(
                    '.session-two');
                const sessionContent = sessionContainer.find('.session-content');
                const icon = button.find('i');

                // Toggle session visibility
                if (sessionContent.is(':visible')) {
                    // Hide session
                    sessionContent.slideUp(200);
                    icon.removeClass('mdi-eye').addClass('mdi-eye-off');
                    button.removeClass('btn-outline-secondary').addClass('btn-outline-danger');

                    // Clear session data when hiding
                    clearSessionData(row, session);
                } else {
                    // Show session
                    sessionContent.slideDown(200);
                    icon.removeClass('mdi-eye-off').addClass('mdi-eye');
                    button.removeClass('btn-outline-danger').addClass('btn-outline-secondary');
                }
            });

            // Function to clear session data when hiding
            function clearSessionData(row, session) {
                const isSecondSession = session === 'second';
                const suffix = isSecondSession ? '_second' : '';
                const sedSuffix = isSecondSession ? '_sed' : '_first';

                // Clear all form fields for the session
                row.find(`select[name="teacher_code${sedSuffix}[]"]`).val('').trigger('change');
                row.find(`select[name="co_teacher_code${suffix}[]"]`).val('null').trigger('change');
                row.find(`select[name="co_teacher_code1${suffix}[]"]`).val('null').trigger('change');
                row.find(`select[name="subjects_code${suffix}[]"]`).val('').trigger('change');
                row.find(`input[name="start_time${suffix}[]"]`).val('');
                row.find(`input[name="end_time${suffix}[]"]`).val('');
                row.find(`input[name="room${suffix}[]"]`).val('');
            }

            // Function to check if session is visible
            function isSessionVisible(row, session) {
                const sessionContainer = session === 'first' ? row.find('.session-one') : row.find('.session-two');
                return sessionContainer.find('.session-content').is(':visible');
            }

            // Update validation to only validate visible sessions
            function validateScheduleData(scheduleData) {
                let isValid = true;
                scheduleData.forEach((data, index) => {
                    const sessionType = data.is_second_schedule ? '(វេនទី២)' : '(វេនទី១)';
                    const rowNum = data.rowNum || Math.floor(index / 2) + 1;
                    const row = $(`#schedule-section tr.schedule-row:eq(${rowNum - 1})`);
                    const session = data.is_second_schedule ? 'second' : 'first';

                    // Skip validation if session is not visible
                    if (!isSessionVisible(row, session)) {
                        return;
                    }

                    // Required field validations
                    if (!data.date) {
                        notyf.error(`ជួរទី ${rowNum} ${sessionType}: សូមបញ្ចូលកាលបរិច្ឆេទ *`);
                        isValid = false;
                    }

                    // Check if either professor or at least one supervisor is selected
                    const hasTeacher = data.teacher_code && data.teacher_code !== '';
                    const hasSupervisor = (data.co_teacher_code && data.co_teacher_code !== 'null') ||
                        (data.co_teacher_code1 && data.co_teacher_code1 !== 'null');

                    if (!hasTeacher && !hasSupervisor) {
                        notyf.error(`ជួរទី ${rowNum} ${sessionType}: សូមជ្រើសរើសសាស្ត្រាចារ្យ * ឬ អនុរក្ស`);
                        isValid = false;
                    }

                    if (!data.subjects_code) {
                        notyf.error(`ជួរទី ${rowNum} ${sessionType}: សូមជ្រើសរើសមុខវិជ្ជា`);
                        isValid = false;
                    }

                    if (!data.start_time || !data.end_time) {
                        notyf.error(`ជួរទី ${rowNum} ${sessionType}: សូមបញ្ចូលម៉ោង * និងដល់ *`);
                        isValid = false;
                    }

                    if (!data.room) {
                        notyf.error(`ជួរទី ${rowNum} ${sessionType}: សូមបញ្ចូលលេខបន្ទប់ *`);
                        isValid = false;
                    }
                });
                return isValid;
            }

            // Update data collection to only include visible sessions
            function collectScheduleData() {
                const rows = $('#schedule-section tr.schedule-row');
                const examScheduleId = $('#examScheduleId').val();
                let scheduleData = [];
                let hasAnyData = false;

                rows.each(function(index) {
                    const row = $(this);
                    const rowId = row.data('id');
                    const date_name_code = row.find('select[name="date_name_code[]"]').val();
                    const rowNum = index + 1;

                    // Check if first session is visible and has data
                    const firstSessionVisible = isSessionVisible(row, 'first');
                    const firstSessionHasData = firstSessionVisible && (
                        row.find('select[name="teacher_code_first[]"]').val() ||
                        row.find('select[name="subjects_code[]"]').val() ||
                        row.find('input[name="start_time[]"]').val() ||
                        row.find('input[name="end_time[]"]').val() ||
                        row.find('input[name="room[]"]').val()
                    );

                    // Check if second session is visible and has data
                    const secondSessionVisible = isSessionVisible(row, 'second');
                    const secondSessionHasData = secondSessionVisible && (
                        row.find('select[name="teacher_code_sed[]"]').val() ||
                        row.find('select[name="subjects_code_second[]"]').val() ||
                        row.find('input[name="start_time_second[]"]').val() ||
                        row.find('input[name="end_time_second[]"]').val() ||
                        row.find('input[name="room_second[]"]').val()
                    );

                    // If either session has data, validate the row
                    if (firstSessionHasData || secondSessionHasData) {
                        hasAnyData = true;

                        // Validate first session if it has data and is visible
                        if (firstSessionHasData) {
                            const firstSession = {
                                id: rowId,
                                exam_schedule_id: examScheduleId,
                                date: row.find('input[name="date[]"]').val(),
                                teacher_code: row.find('select[name="teacher_code_first[]"]').val(),
                                co_teacher_code: row.find('select[name="co_teacher_code[]"]').val(),
                                co_teacher_code1: row.find('select[name="co_teacher_code1[]"]').val(),
                                subjects_code: row.find('select[name="subjects_code[]"]').val(),
                                date_name_code: date_name_code,
                                start_time: row.find('input[name="start_time[]"]').val(),
                                end_time: row.find('input[name="end_time[]"]').val(),
                                room: row.find('input[name="room[]"]').val(),
                                is_second_schedule: 0,
                                rowNum: rowNum
                            };
                            scheduleData.push(firstSession);
                        }

                        // Validate second session if it has data and is visible
                        if (secondSessionHasData) {
                            const secondSession = {
                                id: rowId ? `${rowId}_second` : null,
                                exam_schedule_id: examScheduleId,
                                date: row.find('input[name="date[]"]').val(),
                                teacher_code: row.find('select[name="teacher_code_sed[]"]').val(),
                                co_teacher_code: row.find('select[name="co_teacher_code_second[]"]')
                                    .val(),
                                co_teacher_code1: row.find('select[name="co_teacher_code1_second[]"]')
                                    .val(),
                                subjects_code: row.find('select[name="subjects_code_second[]"]').val(),
                                date_name_code: date_name_code,
                                start_time: row.find('input[name="start_time_second[]"]').val(),
                                end_time: row.find('input[name="end_time_second[]"]').val(),
                                room: row.find('input[name="room_second[]"]').val(),
                                is_second_schedule: 1,
                                rowNum: rowNum
                            };
                            scheduleData.push(secondSession);
                        }
                    }
                });

                return {
                    scheduleData,
                    hasAnyData
                };
            }

            // Update the save button click handler to use new data collection
            $(document).on('click', '#saveSchedule', function() {
                const {
                    scheduleData,
                    hasAnyData
                } = collectScheduleData();
                const examScheduleId = $('#examScheduleId').val();

                // Check if any data exists
                if (!hasAnyData) {
                    notyf.error('សូមបញ្ចូលទិន្នន័យយ៉ាងហោចណាស់មួយវេន');
                    return;
                }

                // Validate data
                if (!validateScheduleData(scheduleData)) {
                    return;
                }

                // Save to database
                $.ajax({
                    url: '{{ route('save.exam.schedule') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        exam_schedule_id: examScheduleId,
                        schedule: JSON.stringify(scheduleData)
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#examScheduleModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                            notyf.success('កាលវិភាគត្រូវបានរក្សាទុកដោយជោគជ័យ');
                            // Reset form state after successful save
                            formHasChanges = false;
                            captureInitialFormState();
                       
                            
                        } else {
                            notyf.error(response.msg || 'មានបញ្ហាក្នុងការរក្សាទុកកាលវិភាគ');
                        }
                    },
                    error: function(xhr) {
                        notyf.error('មានបញ្ហាក្នុងការរក្សាទុកកាលវិភាគ');
                    }
                });
            });
        });
    </script>
@endsection
