<div class="control-table table-responsive custom-data-table-wrapper2 ">
    <div class="scroll-buttons">
        <button class="scroll-btn scroll-left" title="Scroll Left">
            <i class="mdi mdi-chevron-left"></i>
        </button>
        <button class="scroll-btn scroll-right" title="Scroll Right">
            <i class="mdi mdi-chevron-right"></i>
        </button>
    </div>
    <table class="table table-styles" style="margin-bottom: 4rem;">
        <thead>
            <tr>
                <th class="first-column" rowspan="2">ល.រ</th>
                <th class="second-column" rowspan="2">ក្រុម</th>
                <!-- Loop through date_name to display day name and date -->
                @foreach ($date_name as $dataZ)
                    @php
                        // Get first and second schedule records for this day
                        $firstRecord = $record_sub_lines
                            ->where('date_name_code', strtolower($dataZ->code))
                            ->where('is_second_schedule', 0)
                            ->first();
                        $secondRecord = $record_sub_lines
                            ->where('date_name_code', strtolower($dataZ->code))
                            ->where('is_second_schedule', 1)
                            ->first();

                        $scheduleDate = $firstRecord
                            ? $firstRecord->date
                            : ($secondRecord
                                ? $secondRecord->date
                                : null);
                    @endphp
                    <th colspan="2">
                        {{ $dataZ->name_2 }} ({{ $scheduleDate ?? 'N/A' }})
                    </th>
                @endforeach
            </tr>
            <tr>
                <!-- Loop to display schedule times -->
                @foreach ($date_name as $dataZ)
                    @php
                        // Get first and second schedule records for this day
                        $firstRecord = $record_sub_lines
                            ->where('date_name_code', strtolower($dataZ->code))
                            ->where('is_second_schedule', 0)
                            ->first();
                        $secondRecord = $record_sub_lines
                            ->where('date_name_code', strtolower($dataZ->code))
                            ->where('is_second_schedule', 1)
                            ->first();

                        // Format first schedule times
                        $first_schedule_time = '';
                        if ($firstRecord && !empty($firstRecord->start_time) && !empty($firstRecord->end_time)) {
                            // Format start time
                            $start_hour = (int) substr($firstRecord->start_time, 0, 2);
                            $start_minutes = substr($firstRecord->start_time, 3, 2);
                            $start_display_hour =
                                $start_hour > 12 ? $start_hour - 12 : ($start_hour == 0 ? 12 : $start_hour);
                            $start_period = $start_hour < 12 ? 'AM' : 'PM';
                            $formatted_start = $start_display_hour . ':' . $start_minutes . $start_period;

                            // Format end time
                            $end_hour = (int) substr($firstRecord->end_time, 0, 2);
                            $end_minutes = substr($firstRecord->end_time, 3, 2);
                            $end_display_hour = $end_hour > 12 ? $end_hour - 12 : ($end_hour == 0 ? 12 : $end_hour);
                            $end_period = $end_hour < 12 ? 'AM' : 'PM';
                            $formatted_end = $end_display_hour . ':' . $end_minutes . $end_period;

                            $first_schedule_time = $formatted_start . '-' . $formatted_end;
                        }

                        // Format second schedule times
                        $second_schedule_time = '';
                        if ($secondRecord && !empty($secondRecord->start_time) && !empty($secondRecord->end_time)) {
                            // Format start time
                            $start_hour = (int) substr($secondRecord->start_time, 0, 2);
                            $start_minutes = substr($secondRecord->start_time, 3, 2);
                            $start_display_hour =
                                $start_hour > 12 ? $start_hour - 12 : ($start_hour == 0 ? 12 : $start_hour);
                            $start_period = $start_hour < 12 ? 'AM' : 'PM';
                            $formatted_start = $start_display_hour . ':' . $start_minutes . $start_period;

                            // Format end time
                            $end_hour = (int) substr($secondRecord->end_time, 0, 2);
                            $end_minutes = substr($secondRecord->end_time, 3, 2);
                            $end_display_hour = $end_hour > 12 ? $end_hour - 12 : ($end_hour == 0 ? 12 : $end_hour);
                            $end_period = $end_hour < 12 ? 'AM' : 'PM';
                            $formatted_end = $end_display_hour . ':' . $end_minutes . $end_period;

                            $second_schedule_time = $formatted_start . '-' . $formatted_end;
                        }
                    @endphp
                    <th>
                        វេនទី១<br>
                        <small>{{ $first_schedule_time }}</small>
                    </th>
                    <th>
                        វេនទី២<br>
                        <small>{{ $second_schedule_time }}</small>
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            <?php $index = 1; ?>
            @php
                $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                $grouped_records = $record_sub_lines->groupBy('class_code');
            @endphp

            @foreach ($grouped_records as $class_code => $lines)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>
                        ឆ្នាំទី {{ $records->years ?? '' }}<br>
                        ក្រុម {{ $records->class_code }}
                    </td>

                    @foreach ($days as $day)
                        @php
                            $dayCode = strtolower($day);
                            $daySchedules = $lines->where('date_name_code', $dayCode);

                            $firstRecord = $daySchedules->where('is_second_schedule', 0)->first();
                            $secondRecord = $daySchedules->where('is_second_schedule', 1)->first();

                            $scheduleDate = $firstRecord
                                ? $firstRecord->date
                                : ($secondRecord
                                    ? $secondRecord->date
                                    : null);
                        @endphp

                        <!-- First Schedule -->
                        <td>
                            @if ($firstRecord)
                                <div class="schedule-info">
                                    <strong>{{ $firstRecord->teacher->name_2 ?? '' }}</strong>
                                    @if ($firstRecord->co_teacher_code || $firstRecord->co_teacher_code1)
                                        <small class="co-teacher-text"
                                            style="color: black; font-size: 12px; font-weight: 700;">
                                            @if ($firstRecord->co_teacher_code && $firstRecord->coTeacher)
                                                {{ $firstRecord->coTeacher->name_2 ?? '' }}
                                            @endif
                                            @if (
                                                $firstRecord->co_teacher_code &&
                                                    $firstRecord->coTeacher &&
                                                    $firstRecord->co_teacher_code1 &&
                                                    $firstRecord->coTeacher1)
                                                ,
                                            @endif
                                            @if ($firstRecord->co_teacher_code1 && $firstRecord->coTeacher1)
                                                {{ $firstRecord->coTeacher1->name_2 ?? '' }}
                                            @endif
                                        </small>
                                    @endif
                                    @if ($firstRecord->subject)
                                        <div class="subject-info1">{{ $firstRecord->subject->name_2 ?? '' }}</div>
                                        @if ($firstRecord->room)
                                            <div class="room-info">
                                                <i class="mdi mdi-door btn-icon-prepend"></i>
                                                លេខបន្ទប់ {{ $firstRecord->room }}
                                            </div>
                                            <div class="action-buttons">
                                                <button class="btn btn-outline-danger btn-sm delete-schedule"
                                                    data-id="{{ $firstRecord->id }}"
                                                    data-exam-schedule-id="{{ $firstRecord->exam_schedule_id }}"
                                                    data-day-code="{{ $dayCode }}" data-is-second="0">
                                                    <i class="mdi mdi-delete btn-icon-prepend"></i>
                                                    លុបវេនទី១
                                                </button>
                                                <div class="document-actions">
                                                    <button class="btn btn-outline-danger upload-document"
                                                        data-code="{{ $firstRecord->id }}">
                                                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                                                        <span>Upload</span>
                                                    </button>
                                                    @if ($firstRecord->document_exam)
                                                        <button
                                                            onclick="viewFile('{{ asset('storage/' . $firstRecord->document_exam) }}')"
                                                            type="button" class="btn btn-outline-success">
                                                            <i class="mdi mdi-file-pdf-box btn-icon-prepend"></i>
                                                            <span>View</span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-outline-dark">
                                                            <i class="mdi mdi-file-remove btn-icon-prepend"></i>
                                                            <span>No File</span>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </td>

                        <!-- Second Schedule -->
                        <td>
                            @if ($secondRecord)
                                <div class="schedule-info">
                                    <strong>{{ $secondRecord->teacher->name_2 ?? '' }}</strong>
                                    @if ($secondRecord->co_teacher_code || $secondRecord->co_teacher_code1)
                                        <small style="color: black; font-size: 13px; font-weight: bold;">
                                            @if ($secondRecord->co_teacher_code && $secondRecord->coTeacher)
                                                {{ $secondRecord->coTeacher->name_2 ?? '' }}
                                            @endif
                                            @if (
                                                $secondRecord->co_teacher_code &&
                                                    $secondRecord->coTeacher &&
                                                    $secondRecord->co_teacher_code1 &&
                                                    $secondRecord->coTeacher1)
                                                ,
                                            @endif
                                            @if ($secondRecord->co_teacher_code1 && $secondRecord->coTeacher1)
                                                {{ $secondRecord->coTeacher1->name_2 ?? '' }}
                                            @endif
                                        </small>
                                    @endif
                                    @if ($secondRecord->subject)
                                        <div class="subject-info1">{{ $secondRecord->subject->name_2 ?? '' }}</div>
                                        @if ($secondRecord->room)
                                            <div class="room-info">
                                                <i class="mdi mdi-door btn-icon-prepend"></i>
                                                លេខបន្ទប់ {{ $secondRecord->room }}
                                            </div>
                                            <div class="action-buttons">
                                                <button class="btn btn-outline-danger btn-sm delete-schedule"
                                                    data-id="{{ $secondRecord->id }}"
                                                    data-exam-schedule-id="{{ $secondRecord->exam_schedule_id }}"
                                                    data-day-code="{{ $dayCode }}" data-is-second="1">
                                                    <i class="mdi mdi-delete btn-icon-prepend"></i>
                                                    លុបវេនទី២
                                                </button>
                                                <div class="document-actions">
                                                    <button class="btn btn-outline-danger upload-document"
                                                        data-code="{{ $secondRecord->id }}">
                                                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                                                        <span>Upload</span>
                                                    </button>
                                                    @if ($secondRecord->document_exam)
                                                        <button
                                                            onclick="viewFile('{{ asset('storage/' . $secondRecord->document_exam) }}')"
                                                            type="button" class="btn btn-outline-success">
                                                            <i class="mdi mdi-file-pdf-box btn-icon-prepend"></i>
                                                            <span>View</span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-outline-dark">
                                                            <i class="mdi mdi-file-remove btn-icon-prepend"></i>
                                                            <span>No File</span>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="uploadFileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black">Upload PDF File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="uploadFileForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="upload-record-id" name="code">
                    <input type="hidden" id="upload-schedule-type" name="schedule">
                    <input type="file" name="document_exam" id="document_exam" accept=".pdf" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnUploadPdf" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black">កែប្រែ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="col-md-12 mt-3">
                        <div class="form-group row">
                            <span class="labels col-sm-3 col-form-label text-end">កាលបរិច្ឆេទ<strong
                                    style="color:red; font-size:15px;">*</strong></span>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="edit-date" name="date"
                                    style="width: 349px;">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <span class="labels col-sm-3 col-form-label text-end">មុខវិជ្ជា<strong
                                    style="color:red; font-size:15px;">*</strong></span>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" id="edit-subject" name="subjects_code"
                                    style="width: 349px;">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->code }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                            <span class="labels col-sm-3 col-form-label text-end">សាស្ត្រាចារ្យ<strong
                                    style="color:red; font-size:15px;">*</strong></span>
                            <div class="col-sm-9">
                                <select class="js-example-basic-single" id="edit-teacher" name="teacher_code"
                                    style="width: 349px;">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->code }}">{{ $teacher->name_2 ?? '' }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                <button type="button" class="btn btn-primary save-changes">រក្សាទុក</button>
            </div>
        </div>
    </div>
</div>

<style>
    input,
    button,
    select,
    optgroup,
    textarea {
        padding-left: 12px;
        !important;
        font-size: 12px;
        !important;
        padding-top: 12px;
        !important;

    }

    .checkbox_ids {
        transform: scale(1.2);
        cursor: pointer;
    }

    #select_all_ids {
        transform: scale(1.2);
        cursor: pointer;
    }

    table,
    tr,
    th {
        text-align: center;
    }

    /* Apply styles to table cells */
    .table-styles th,
    .table-styles td {
        font-size: 12px;
        padding: 12px 8px;
        text-align: center;
        border: 0.1px solid black;
        word-wrap: break-word;
        white-space: normal;
        overflow-wrap: break-word;
        vertical-align: middle;
    }

    /* Button styling */
    .table-styles .btn-sm {
        padding: 2px 8px;
        font-size: 11px;
        min-width: 85px;
        margin: 0;
        white-space: nowrap;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }

    /* Icon styling */
    .btn-icon-prepend {
        margin: 0;
        font-size: 14px;
    }

    /* Button container styling */
    .table-styles td .mt-2 {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
        margin-top: 12px !important;
    }

    /* Hover effects for buttons */
    .btn-outline-danger:hover,
    .btn-outline-success:hover,
    .btn-outline-dark:hover {
        color: white !important;
    }

    /* Button text and icon alignment */
    .btn-sm span {
        display: inline-block;
        vertical-align: middle;
    }

    /* Adjust cell heights */
    .table-styles tbody td {
        min-height: 90px;
        padding: 12px 8px;
    }

    /* Teacher name styling */
    .table-styles tbody td {
        line-height: 1.4;
    }

    /* Room information styling */
    .table-styles tbody td i.mdi-door {
        color: #6c757d;
        font-size: 14px;
        margin-right: 4px;
        vertical-align: middle;
    }

    /* Adjust cell heights for three rows */
    .table-styles tbody td {
        min-height: 60px;
        padding: 6px 4px;
    }

    /* Different background for room cells */
    .table-styles tbody tr:nth-child(3n) td {
        background-color: #f8f9fa;
    }

    /* Teacher name styling */
    .table-styles tbody td {
        line-height: 1.4;
    }

    /* Teacher information spacing */
    .teacher-info {
        margin-bottom: 8px;
    }

    /* Update styles for single row display */
    .table-styles tbody td {
        min-height: 90px;
        padding: 12px 8px;
        vertical-align: middle;
    }

    .table-styles td small {
        display: block;
        margin-top: 4px;
        color: #666;
    }

    .table-styles td .room-info {
        margin-top: 8px;
        font-size: 11px;
        color: #666;
    }

    /* Adjust cell widths */
    .table-styles th,
    .table-styles td {
        width: auto;
        min-width: 150px;
    }

    /* First and second columns */
    .table-styles .first-column {
        width: 50px;
        min-width: 50px;
    }

    .table-styles .second-column {
        width: 100px;
        min-width: 100px;
    }

    .schedule-info {
        text-align: left;
        margin: 5px 0;
    }

    .schedule-info strong {
        display: block;
        margin-bottom: 3px;
    }

    .schedule-info small {
        display: block;
        color: #666;
        font-size: 11px;
        margin-bottom: 3px;
    }

    .subject-info1 {
        margin: 5px 0;
        color: #333;
    }

    .room-info {
        font-size: 11px;
        color: #666;
        margin-top: 3px;
    }

    .room-info i {
        margin-right: 3px;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 8px;
        align-items: center;
        margin-top: 8px;
    }

    .action-buttons .btn-sm {
        width: 100%;
        max-width: 120px;
    }

    /* Scroll Buttons Styling */
    .custom-data-table-wrapper2 {
        position: relative;
        overflow-x: auto;
        padding: 0 30px;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }

    .scroll-buttons {
        position: absolute;
        z-index: 1000;
        pointer-events: none;
        width: 100%;
        height: 0;
    }

    .scroll-btn {
        position: fixed;
        width: 2px;
        height: 40px;
        background: rgba(33, 150, 243, 0.8);
        border: none;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: auto;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        opacity: 0;
        visibility: hidden;
        user-select: none;
        -webkit-user-select: none;
    }

    .scroll-btn.visible {
        opacity: 0.7;
        visibility: visible;
    }

    .scroll-btn:hover {
        background: rgba(33, 150, 243, 0.9);
        opacity: 1;
        width: 24px;
    }

    .scroll-btn.scroll-left {
        left: 0;
        border-radius: 0 3px 3px 0;
    }

    .scroll-btn.scroll-right {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    .scroll-btn i {
        font-size: 18px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        margin: 0;
        margin-bottom: 5px;
    }

    /* Add styles for table wrapper to ensure proper positioning */
    .table-responsive {
        position: relative;
        margin: 1rem 0;
    }

    /* Document management buttons styling */
    .document-actions {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin-top: 8px;
    }

    .document-actions .btn {
        min-width: 90px;
        padding: 4px 12px;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .document-actions .btn-outline-danger {
        color: #dc3545;
        border-color: #dc3545;
    }

    .document-actions .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .document-actions .btn-outline-success {
        color: #28a745;
        border-color: #28a745;
    }

    .document-actions .btn-outline-success:hover {
        background-color: #28a745;
        color: white;
    }

    .document-actions .btn-outline-dark {
        color: #343a40;
        border-color: #343a40;
    }

    .document-actions .btn-outline-dark:hover {
        background-color: #343a40;
        color: white;
    }

    .document-actions .btn i {
        font-size: 14px;
    }

    .document-actions .btn span {
        font-weight: 500;
    }
</style>

<script>
    $(document).ready(function() {
        // Handle Upload Document button click
        $(document).on('click', '.upload-document', function() {
            const code = $(this).data('code');
            const schedule = $(this).data('schedule');
            $('#upload-record-id').val(code);
            $('#upload-schedule-type').val(schedule);
            $('#uploadFileModal').modal('show');
        });

        // File size validation
        $('#document_exam').on('change', function() {
            const file = this.files[0];
            if (file && file.size > 10 * 1024 * 1024) {
                notyf.error("The file size exceeds the maximum limit of 10 MB.");
                $(this).val('');
            }
        });

        // Handle file upload
        $(document).off('click', '#btnUploadPdf').on('click', '#btnUploadPdf', function() {
            const formData = new FormData($('#uploadFileForm')[0]);
            const recordId = $('#upload-record-id').val();
            const scheduleType = $('#upload-schedule-type').val();
            const url = `/exam-schedule/upload-document?code=${recordId}&schedule=${scheduleType}`;

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $('#btnUploadPdf').prop('disabled', true).text('Uploading...');
                },
                success: function(response) {
                    $('#btnUploadPdf').prop('disabled', false).text('Upload');
                    if (response.status === 'success') {
                        $('#uploadFileModal').modal('hide');
                        notyf.success(response.message);
                        location.reload();
                    } else {
                        notyf.error(response.message || 'Upload failed');
                    }
                },
                error: function(xhr, status, error) {
                    $('#btnUploadPdf').prop('disabled', false).text('Upload');
                    notyf.error(xhr.responseJSON?.message || 'Upload failed');
                }
            });
        });

        // Function to view file
        window.viewFile = function(url) {
            window.open(url, '_blank');
        };

        // Handle delete schedule
        $(document).on('click', '.delete-schedule', function(e) {
            e.preventDefault();
            const scheduleId = $(this).data('id');
            const examScheduleId = $(this).data('exam-schedule-id');
            const dayCode = $(this).data('day-code');
            const isSecondSchedule = $(this).data('is-second');
            const scheduleCell = $(this).closest('td');

            // Get the table and current cell index
            const table = scheduleCell.closest('table');
            const cellIndex = scheduleCell.index();

            // Calculate the correct day index (accounting for the first two columns)
            const dayStartIndex = 2; // Skip the first two columns (ល.រ and ក្រុម)
            const currentDayIndex = Math.floor((cellIndex - dayStartIndex) / 2);

            // Get the exact header cells for this day
            const dayHeaderCell = table.find('thead tr:first-child th').eq(currentDayIndex + 2);
            const timeHeaderCell = table.find('thead tr:last-child th').eq(cellIndex - dayStartIndex);

            // Get both session cells for this specific day
            const dayBaseIndex = currentDayIndex * 2 + dayStartIndex;
            const firstSessionCell = table.find('tbody tr').first().find('td').eq(dayBaseIndex);
            const secondSessionCell = table.find('tbody tr').first().find('td').eq(dayBaseIndex + 1);

            // Function to check if all days are empty
            function checkAllDaysEmpty() {
                const totalDays = 6; // Monday to Saturday
                let emptyDays = 0;

                for (let day = 0; day < totalDays; day++) {
                    const dayFirstCell = table.find('tbody tr').first().find('td').eq(day * 2 +
                        dayStartIndex);
                    const daySecondCell = table.find('tbody tr').first().find('td').eq(day * 2 +
                        dayStartIndex + 1);

                    if (dayFirstCell.find('.schedule-info').length === 0 && daySecondCell.find(
                            '.schedule-info').length === 0) {
                        emptyDays++;
                    }
                }

                // If all days are empty, refresh the page
                if (emptyDays === totalDays) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }

                return emptyDays === totalDays;
            }

            $.ajax({
                url: '/exam-schedule/delete-session',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    exam_schedule_id: examScheduleId,
                    date_name_code: dayCode,
                    is_second_schedule: isSecondSchedule
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // Remove the schedule content from the cell
                        scheduleCell.find('.schedule-info').fadeOut(200, function() {
                            $(this).remove();

                            // Update the time header for this session
                            const sessionLabel = isSecondSchedule ? 'វេនទី២' :
                                'វេនទី១';
                            timeHeaderCell.html(
                                `${sessionLabel}<br><small></small>`);

                            // Check if both sessions of current day are empty
                            const firstEmpty = firstSessionCell.find(
                                '.schedule-info').length === 0;
                            const secondEmpty = secondSessionCell.find(
                                '.schedule-info').length === 0;

                            if (firstEmpty && secondEmpty) {
                                const dayName = dayHeaderCell.text().split('(')[0]
                                    .trim();
                                dayHeaderCell.html(`${dayName} (N/A)`);
                            }

                            // Get day name for the message
                            const dayNames = {
                                'monday': 'ថ្ងៃច័ន្ទ',
                                'tuesday': 'ថ្ងៃអង្គារ',
                                'wednesday': 'ថ្ងៃពុធ',
                                'thursday': 'ថ្ងៃព្រហស្បតិ៍',
                                'friday': 'ថ្ងៃសុក្រ',
                                'saturday': 'ថ្ងៃសៅរ៍'
                            };
                            const dayName = dayNames[dayCode] || dayCode;
                            const sessionName = isSecondSchedule ? 'វេនទី២' :
                                'វេនទី១';

                            notyf.success(
                                `បានលុបកាលវិភាគ ${sessionName} នៅ${dayName} ដោយជោគជ័យ`
                                );

                            // Check if all days are empty
                            checkAllDaysEmpty();
                        });
                    } else {
                        notyf.error(response.message || 'មានបញ្ហាក្នុងការលុបកាលវិភាគ');
                    }
                },
                error: function(xhr, status, error) {
                    notyf.error('មានបញ្ហាក្នុងការលុបកាលវិភាគ: ' + (xhr.responseJSON
                        ?.message || error));
                }
            });

            return false;
        });

        const scrollContainer = $('.custom-data-table-wrapper2');
        const scrollLeftBtn = $('.scroll-left');
        const scrollRightBtn = $('.scroll-right');
        let isScrolling = false;

        // Optimized scroll parameters
        const scrollConfig = {
            initialSpeed: 300,
            maxSpeed: 800,
            acceleration: 1.5,
            scrollDuration: 200,
            jumpPercentage: 0.4
        };

        // Function to update button positions relative to visible table area
        function updateButtonPositions() {
            const tableRect = scrollContainer.find('table')[0].getBoundingClientRect();
            const visibleHeight = window.innerHeight;
            const tableTop = Math.max(0, tableRect.top);
            const tableBottom = Math.min(visibleHeight, tableRect.bottom);
            const visibleTableHeight = tableBottom - tableTop;
            const middlePosition = tableTop + (visibleTableHeight / 2);

            // Position buttons vertically centered relative to visible table area
            scrollLeftBtn.css({
                'top': middlePosition - (scrollLeftBtn.height() / 2) + 'px',
                'left': scrollContainer.offset().left + 'px'
            });
            scrollRightBtn.css({
                'top': middlePosition - (scrollRightBtn.height() / 2) + 'px',
                'right': ($(window).width() - (scrollContainer.offset().left + scrollContainer
                    .outerWidth())) + 'px'
            });
        }

        // Function to check if scrollable
        function isScrollable() {
            return scrollContainer[0].scrollWidth > scrollContainer[0].clientWidth;
        }

        // Function to update button visibility
        function updateScrollButtons() {
            const maxScroll = scrollContainer[0].scrollWidth - scrollContainer[0].clientWidth;
            const currentScroll = scrollContainer.scrollLeft();

            if (!isScrollable()) {
                scrollLeftBtn.removeClass('visible');
                scrollRightBtn.removeClass('visible');
                return;
            }

            // Update button visibility
            if (currentScroll <= 0) {
                scrollLeftBtn.removeClass('visible');
            } else {
                scrollLeftBtn.addClass('visible');
            }

            if (currentScroll >= maxScroll - 1) {
                scrollRightBtn.removeClass('visible');
            } else {
                scrollRightBtn.addClass('visible');
            }

            // Update button positions
            updateButtonPositions();
        }

        // Calculate scroll distance based on container width
        function getScrollDistance() {
            const containerWidth = scrollContainer.width();
            return Math.max(300, containerWidth * scrollConfig.jumpPercentage);
        }

        // Quick scroll function for single clicks
        function quickScroll(direction) {
            const distance = getScrollDistance();
            scrollContainer.stop().animate({
                scrollLeft: '+=' + (direction * distance)
            }, {
                duration: scrollConfig.scrollDuration,
                easing: 'easeOutQuad',
                complete: updateScrollButtons
            });
        }

        // Continuous scroll function for long press
        function startContinuousScroll(direction) {
            if (isScrolling) return;
            isScrolling = true;
            let currentSpeed = scrollConfig.initialSpeed;

            function scroll() {
                if (!isScrolling) return;

                const maxScroll = scrollContainer[0].scrollWidth - scrollContainer[0].clientWidth;
                const currentScroll = scrollContainer.scrollLeft();

                if ((direction === 1 && currentScroll >= maxScroll) ||
                    (direction === -1 && currentScroll <= 0)) {
                    stopScrolling();
                    return;
                }

                currentSpeed = Math.min(currentSpeed * scrollConfig.acceleration, scrollConfig.maxSpeed);

                scrollContainer.stop().animate({
                    scrollLeft: '+=' + (direction * currentSpeed)
                }, {
                    duration: scrollConfig.scrollDuration,
                    easing: 'easeOutQuad',
                    complete: function() {
                        if (isScrolling) {
                            scroll();
                            updateButtonPositions();
                        }
                    }
                });
            }

            scroll();
        }

        function stopScrolling() {
            isScrolling = false;
            scrollContainer.stop();
            updateScrollButtons();
        }

        // Click events for quick scroll
        scrollLeftBtn.on('click', function(e) {
            if (e.type === 'click') {
                quickScroll(-1);
            }
        });

        scrollRightBtn.on('click', function(e) {
            if (e.type === 'click') {
                quickScroll(1);
            }
        });

        // Long press events
        scrollLeftBtn.on('mousedown touchstart', function(e) {
            e.preventDefault();
            const longPressTimer = setTimeout(() => {
                startContinuousScroll(-1);
            }, 250);
            $(this).data('longPressTimer', longPressTimer);
        });

        scrollRightBtn.on('mousedown touchstart', function(e) {
            e.preventDefault();
            const longPressTimer = setTimeout(() => {
                startContinuousScroll(1);
            }, 250);
            $(this).data('longPressTimer', longPressTimer);
        });

        // Handle mouse/touch end
        $(document).on('mouseup mouseleave touchend', function() {
            clearTimeout(scrollLeftBtn.data('longPressTimer'));
            clearTimeout(scrollRightBtn.data('longPressTimer'));
            if (isScrolling) {
                stopScrolling();
            }
        });

        // Add easing function if not available
        if (typeof $.easing.easeOutQuad === 'undefined') {
            $.easing.easeOutQuad = function(x) {
                return 1 - (1 - x) * (1 - x);
            };
        }

        // Update on scroll with throttle
        let scrollTimeout;
        scrollContainer.on('scroll', function() {
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(updateScrollButtons, 50);
        });

        // Update on window scroll
        $(window).on('scroll', function() {
            updateButtonPositions();
        });

        // Update on window resize with debounce
        let resizeTimeout;
        $(window).on('resize', function() {
            if (resizeTimeout) clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                updateScrollButtons();
                updateButtonPositions();
            }, 150);
        });

        // Initial setup
        setTimeout(function() {
            updateScrollButtons();
            updateButtonPositions();
        }, 100);

        // Show initial state if scrollable
        if (isScrollable()) {
            scrollRightBtn.addClass('visible');
        }
    });
</script>
