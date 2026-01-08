@extends('app_layout.app_layout')
@section('content')
    <style>
        table {
            border-collapse: collapse !important;
            width: 100% !important;
            border: 1px solid #000 !important;
        }

        table tr td {
            padding: 8px !important;
            border: 1px solid #000 !important;
        }

        table tr th {
            border: 1px solid #000 !important;
            background: transparent !important;
            padding: 8px !important;
        }

        .margin-bottom {
            margin-bottom: 5rem !important;
            padding-left: 0 !important;
        }

        .text-center {
            text-align: center;
        }

        td.position-relative {
            position: relative;
        }

        td .action-icons {
            position: absolute;
            top: 33px;
            right: 2px;
            display: flex;
            gap: 3px;
        }

        td .action-icons i {
            font-size: 18px;
        }

        .g-3,
        .gy-3 {
            --bs-gutter-y: 1px !important;
        }
    </style>
    <div class="page-title py-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <div class="title-page">
                    តារាងបែងចែកម៉ោងបង្រៀនក្រុម <span class="fw-bold">{{ $headers->class_code ?? '' }}</span>
                </div>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/class-schedule-index') }}">តារាងបែងចែកម៉ោងបង្រៀន</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ម៉ោងបង្រៀន</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    {{-- input data modal schedule --}}
    <div class="mb-2">
        <form id="classScheduleForm" action="{{ route('class.schedule.store.v2') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ចាប់ផ្តើមអនុវត្ត <span class="text-danger">*</span></label>
                    <input type="date" name="start_date" disabled class="form-control"
                        value="{{ $headers->start_date ?? '' }}" required>
                </div>

                <div class="col-md-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="text-primary fw-semibold">ថ្នាក់/ក្រុម</label>
                        <span class="error-text" id="class_code_error"></span>
                    </div>
                    <select name="class_code" class="class-select text-dark form-control"
                        {{ $headers->class_code ?? '' ? 'disabled' : '' }} required>
                        @foreach ($classs as $class)
                            <option value="{{ $class->code }}"
                                {{ $headers->class_code == $class->code ? 'selected' : '' }}>
                                {{ $class->name ?? $class->code }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ឆ្នាំសិក្សា</label>
                    <input type="text" value="{{ $headers->session_year_code ?? '' }}" id="session_year"
                        class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ឆមាស</label>
                    <input type="text" id="semester" value="{{ $headers->semester ?? '' }}" class="form-control"
                        disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ឆ្នាំ</label>
                    <input type="text" id="year" value="{{ $headers->years ?? '' }}" class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ជំនាញ</label>
                    <input type="text" id="skill_name" value="{{ $headers->skill_name ?? '' }}" class="form-control"
                        disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">ដេប៉ាតឺម៉ង់</label>
                    <input type="text" id="department_name" value="{{ $headers->department_name ?? '' }}"
                        class="form-control" disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">វេនសិក្សា</label>
                    <input type="text" id="section_name" value="{{ $headers->section_name ?? '' }}" class="form-control"
                        disabled>
                </div>

                <div class="col-md-4">
                    <label class="text-primary fw-semibold">បរិញ្ញាបត្រ</label>
                    <input type="text" id="qualification" value="{{ $headers->qualification ?? '' }}"
                        class="form-control" disabled>
                </div>
            </div>
        </form>
    </div>
    {{-- end input data modal schedule --}}
    <div class="container-fluid p-2">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-6">
                <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="AddTeacherSchedule"
                    href="javascript:void(0);"><i class="mdi mdi-account-plus"></i>បន្ថែមថ្មី</a>
                <button type="button" id="prints" data-id="{{ $headers->id ?? '' }}"
                    class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2">Print
                    <i class="mdi mdi-printer btn-icon-append"></i>
                </button>
            </div>
            <div class="col-md-5 col-sm-7 col-7 khmer_os_b title-page text-center">
                កាលវិភាគបង្រៀន ចាប់ផ្តើមអនុវត្តថ្ងៃទី {{ App\Service\service::DateYearKH($headers->start_date ?? '') }}
            </div>
        </div>
    </div>
    <iframe id="printFrame" style="display:none;"></iframe>
    {{-- table schedule --}}
    <div class="table-responsive margin-bottom">
        <table class="table table-bordered bg-white mt-4">
            <thead>
                <tr id="day">
                    <th width='10' class="text-center fw-bold" rowspan="2">ល.រ</th>
                    <th width="45" class="text-center fw-bold" rowspan="2">សាស្រ្តាចារ្យ</th>
                    @foreach ($days as $dayCode => $dayName)
                        <th class="text-center fw-bold p-2" colspan="{{ count($sessions[$dayCode] ?? []) }}">
                            {{ trim($dayName) }}
                        </th>
                    @endforeach
                </tr>
                <tr id="session">
                    @foreach ($days as $dayCode => $dayName)
                        @foreach ($sessions[$dayCode] ?? [] as $time => $data)
                            <th class="text-center">{{ $time }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>
            <tbody id="body-data">
                @php
                    $index = 1;
                    $teacherGroups = [];
                    foreach ($sessions as $day => $daySessions) {
                        foreach ($daySessions as $time => $details) {
                            $key = $details['teacher_name'];
                            $teacherGroups[$key]['teacher_name'] = $details['teacher_name'];
                            $teacherGroups[$key]['teacher_gender'] = $details['teacher_gender'];
                            $teacherGroups[$key]['data'][$day][$time] = $details;
                        }
                    }
                @endphp
                @foreach ($teacherGroups as $teacher)
                    <tr>
                        <td width='20' class="text-center">{{ $index++ }}
                        </td>
                        <td width='40' class="{{ $teacher['teacher_gender'] === 'ស្រី' ? 'fw-bold ' : '' }}">
                            {{ $teacher['teacher_gender'] === 'ស្រី' ? 'លោកស្រី' : 'លោក' }}
                            {{ $teacher['teacher_name'] ?? '' }}
                        </td>
                        @foreach ($days as $dayCode => $dayName)
                            @foreach ($sessions[$dayCode] ?? [] as $time => $data)
                                @if (isset($teacher['data'][$dayCode][$time]))
                                    <td width='90' class="text-center position-relative">
                                        <p class="mb-0 fw-bold">
                                            {{ $teacher['data'][$dayCode][$time]['subject_name'] }}
                                        </p>
                                        <p class="mb-0">
                                            {{ $teacher['data'][$dayCode][$time]['room'] }}
                                        </p>
                                        <div class="action-icons">
                                            <a href="javascript:void(0)" class="edit-icon"
                                                data-id="{{ $teacher['data'][$dayCode][$time]['id'] }}">
                                                <i class="mdi mdi-border-color text-primary" title="កែប្រែ"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="delete-icon"
                                                data-id="{{ $teacher['data'][$dayCode][$time]['id'] }}">
                                                <i class="mdi mdi-delete-forever text-danger" title="លុប"></i>
                                            </a>
                                        </div>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- end table schedule --}}
    <!-- Modal -->
    <div class="modal fade" id="modalClassScheduleV2" tabindex="-1" aria-labelledby="ModalTeacherSchedule"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="ModalTeacherSchedule">កាលវិភាគបង្រៀន</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-3">
                    <form id="frmDataSublist" class="form-sample">
                        <input type="hidden" id="class_schedule_id" name="class_schedule_id">
                        <div class="mb-2">
                            <label for="teachers_code">សាស្រ្តាចារ្យ</label>
                            <select id="teachers_code" name="teachers_code" class="form-control"
                                style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="subjects_code">មុខវិជ្ជា</label>
                            <select id="subjects_code" name="subjects_code" class="form-control"
                                style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="date_name">ថ្ងៃបង្រៀន</label>
                            <select id="date_name" name="date_name" class="form-control" style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="time_start">ម៉ោងចាប់ផ្ដើម</label>
                            <select id="time_start" name="time_start" class="form-control" style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="time_end">ម៉ោងបញ្ចប់</label>
                            <select id="time_end" name="time_end" class="form-control" style="width:100%"></select>
                        </div>
                        <div class="mb-2">
                            <label for="sessions_type">ម៉ោងទី</label>
                            <select id="sessions_type" name="sessions_type" class="form-control" style="width:100%">
                                <option value="">-- ជ្រើសរើស --</option>
                                <option value="3">ពេញម៉ោង</option>
                                <option value="1">ម៉ោងទី១</option>
                                <option value="2">ម៉ោងទី២</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="room">បន្ទាប់លេខ</label>
                            <input type="text" id="room" name="room" class="form-control">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                    <button type="button" id="SaveTeacherSchedule" class="btn btn-primary">រក្សាទុក</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="ModalTeacherSchedule" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="ModalTeacherSchedule">កែប្រែកាលវិភាគបង្រៀន</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-3">
                    <form id="updateForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id" name="id">
                        <input type="hidden" id="edit_class_code" name="class_code">
                        <div class="mb-2">
                            <label for="teachers_code">សាស្រ្តាចារ្យ</label>
                            <select id="edit_teachers" name="teachers_code" class="form-control"
                                style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="subjects_code">មុខវិជ្ជា</label>
                            <select id="edit_subjects" name="subjects_code" class="form-control"
                                style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="date_name">ថ្ងៃបង្រៀន</label>
                            <select value="" id="edit_date" name="date_name" class="form-control"
                                style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="edit_time_start">ម៉ោងចាប់ផ្ដើម</label>
                            <select id="edit_time_start" name="start_time" class="form-control"
                                style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="edit_time_end">ម៉ោងបញ្ចប់</label>
                            <select id="edit_time_end" name="end_time" class="form-control" style="width:100%"></select>
                        </div>

                        <div class="mb-2">
                            <label for="sessions_type">ម៉ោងទី</label>
                            <select id="edit_sessions_type" name="sessions_type" class="form-control text-dark"
                                style="width:100%">
                                <option value="">-- ជ្រើសរើស --</option>
                                <option value="3">ពេញម៉ោង</option>
                                <option value="1">ម៉ោងទី១</option>
                                <option value="2">ម៉ោងទី២</option>
                                {{-- <option value="3">ម៉ោងទី៣</option> --}}
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="room">បន្ទាប់លេខ</label>
                            <input type="text" id="edit_room" name="room" class="form-control">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បិទ</button>
                    <button type="button" id="SaveUpdateSchedule" class="btn btn-primary">រក្សាទុក</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit modal --}}
    <script>
        $('#AddTeacherSchedule').click(function() {
            let classCode = $('.class-select').val();
            if (!classCode) {
                Swal.fire('សូមជ្រើសរើសថ្នាក់', 'សូមជ្រើសរើសថ្នាក់ពីបញ្ជី មុនពេលបន្ថែម។', 'warning');
                return;
            }
            let modal = new bootstrap.Modal($('#modalClassScheduleV2')[0]);
            modal.show();

            $('#teachers_code, #subjects_code, #date_name, #time_start, #time_end')
                .empty();
            $('#class_schedule_id').val('');

            $.ajax({
                url: "{{ route('class.schedule.getData') }}",
                type: "GET",
                data: {
                    class_code: classCode
                },
                success: function(response) {
                    if (response.success) {
                        $('#modalClassScheduleV2').data('class-schedule-id', response
                            .class_schedule_id);
                        $('#modalClassScheduleV2').data('classInfo', response.classInfo);
                        $.each(response.teachers, function(code, teacher) {
                            $('#teachers_code').append(
                                `<option value="${teacher.code}">${teacher.name_2}</option>`
                            );
                        });
                        $.each(response.subjects, function(code, name) {
                            $('#subjects_code').append(
                                `<option value="${code}">${name}</option>`);
                        });

                        $.each(response.days, function(code, name_2) {
                            $('#date_name').append(
                                `<option value="${code}">${name_2}</option>`);
                        });

                        $.each(response.sessions, function(idx, session) {
                            $('#time_start').append(
                                `<option 
                                    value="${session.start_time}" 
                                    data-end="${session.end_time}">
                                    ${session.start_time} (${session.name})
                                </option>`
                            );
                            $('#time_end').append(
                                `<option value="${session.end_time}">
                                        ${session.end_time} (${session.name})
                                </option>`
                            );
                        });

                        $('#teachers_code, #subjects_code, #date_name, #time_start, #time_end, #sessions_type')
                            .select2({
                                dropdownParent: $('#modalClassScheduleV2'),
                                width: '100%'
                            });
                        $('#time_start').on('change', function() {
                            let selectedEndTime = $(this).find(':selected').data('end');

                            $('#time_end').val(selectedEndTime).trigger('change');
                        });

                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error', 'មិនអាចទាញទិន្នន័យបាន', 'error');
                    console.log(xhr.responseText);
                }
            });
        });

        $('#SaveTeacherSchedule').on('click', function() {
            let classInfo = $('#modalClassScheduleV2').data('classInfo');
            let formData = {
                class_schedule_id: classInfo.id,
                class_code: classInfo.class_code,
                years: classInfo.years,
                session_year_code: classInfo.session_year_code,
                sections_code: classInfo.sections_code,
                department_code: classInfo.department_code,
                skills_code: classInfo.skills_code,
                qualification: classInfo.qualification,
                semester: classInfo.semester,
                teachers_code: $('#teachers_code').val(),
                subjects_code: $('#subjects_code').val(),
                date_name: $('#date_name').val(),
                time_start: $('#time_start').val(),
                time_end: $('#time_end').val(),
                room: $('#room').val(),
                sessions_type: $('#sessions_type').val()
            };

            $.ajax({
                url: "{{ route('assign.class.store') }}",
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.counter_add){
                        Swal.fire({
                            icon:'warning',
                            title:"សូមពិនិត្យមើលម្ដងទៀត",
                            timer:4000,
                            text: response.message,
                            showConfirmButton: false
                        });
                        return;
                    }

                    if (response.duplicate) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'មិនអនុញ្ញាត!',
                            html: `
                                <p>${response.message}</p>
                                <hr>
                                <p><b>ថ្ងៃ:</b> ${response.conflict_day}</p>
                                <p><b>ម៉ោង:</b> ${response.conflict_start} - ${response.conflict_end}</p>
                            `,
                            confirmButtonText: 'យល់ព្រម'
                        });
                        return;
                    }

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ជោគជ័យ!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                        $('#modalClassScheduleV2').modal('hide');
                        $('#modalClassScheduleV2').find('input, select, textarea').val('');
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'កំហុស!',
                        text: 'មានបញ្ហាក្នុងការផ្ញើទិន្នន័យ។'
                    });
                }
            });
        });

        $(document).on('click', '.delete-icon', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'តើអ្នកប្រាកដថាចង់លុបទិន្នន័យនេះមែនទេ?',
                text: "ការលុបនេះមិនអាចត្រឡប់វិញបានទេ។",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'បាទ/ចាស លុប',
                cancelButtonText: 'បោះបង់',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/assign-class/delete/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'លុបដោយជោគជ័យ!',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                });

                                setTimeout(() => {
                                    location.reload();
                                }, 2000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'បរាជ័យ!',
                                    text: response.message,
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'មានបញ្ហា!',
                                text: 'មានបញ្ហា ក្នុងការលុបទិន្នន័យ',
                            });
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#edit_teachers').select2({
                width: '100%',
                dropdownParent: $('#editModal')
            });
            $('#edit_subjects').select2({
                width: '100%',
                dropdownParent: $('#editModal')
            });
            $('#edit_date').select2({
                width: '100%',
                dropdownParent: $('#editModal')
            });
            $('#edit_time_start').select2({
                width: '100%',
                dropdownParent: $('#editModal')
            });
            $('#edit_time_end').select2({
                width: '100%',
                dropdownParent: $('#editModal')
            });
        });

        $(document).on('click', '.edit-icon', function() {
            let id = $(this).data('id');
            editRecord(id);
        });

        function editRecord(id) {
            $.ajax({
                url: `/assign-class/${id}/edit`,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        const record = response.record;
                        $('#edit_id').val(record.id);
                        $('#edit_class_code').val(record.class_code);
                        $('#edit_teachers').empty();
                        $.each(response.teachers, function(index, teacher) {
                            $('#edit_teachers').append(
                                $('<option>', { value: teacher.code, text: teacher.name_2 })
                            );
                        });
                        $('#edit_teachers').val(record.teachers_code).trigger('change');
                        $('#edit_subjects').empty();
                        $.each(response.subjects, function(code, name) {
                            $('#edit_subjects').append(
                                $('<option>', { value: code, text: name })
                            );
                        });
                        $('#edit_subjects').val(record.subjects_code).trigger('change');
                        $('#edit_date').empty();
                        $.each(response.days, function(code, name) {
                            $('#edit_date').append(
                                $('<option>', { value: code, text: name })
                            );
                        });
                        $('#edit_date').val(record.date_name).trigger('change');
                        $('#edit_time_start').empty();
                        $('#edit_time_end').empty();
                        $.each(response.sessions, function(index, session) {
                            $('#edit_time_start').append(
                                $('<option>', {
                                    value: session.start_time,
                                    text: `${session.start_time} (${session.name})`
                                })
                            );
                            $('#edit_time_end').append(
                                $('<option>', {
                                    value: session.end_time,
                                    text: `${session.end_time} (${session.name})`
                                })
                            );
                        });
                        $('#edit_time_start').val(record.start_time).trigger('change');
                        $('#edit_time_end').val(record.end_time).trigger('change');
                        $('#edit_room').val(record.room);
                        $('#edit_sessions_type').val(record.sessions_type);

                        $('#editModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'បរាជ័យ!',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }

        $('#SaveUpdateSchedule').on('click', function() {
            let id = $('#edit_id').val();
            let formData = $('#updateForm').serialize();

            $.ajax({
                url: `/assign-class/${id}`,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ជោគជ័យ!',
                            text: response.message,
                            timer: 3000,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                        $('#editModal').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'កំហុស!',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'កំហុស!',
                        text: 'មានបញ្ហា ក្នុងការកែប្រែទិន្នន័យ។ សូមព្យាយាមម្តងទៀត។', 
                    });
                }
            });
        });

        $('#prints').on('click', function() {
            Swal.fire({
                title: 'តើអ្នកពិតជាចង់បោះពុម្ពមែនទេ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'បោះពុម្ព',
                cancelButtonText: 'បោះបង់',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).data('id');
                    $.ajax({
                        url: `/assign-class/print-line/${id}`, // dynamically use id
                        type: 'GET',
                        success: function(response) {
                            // ✅ Load response HTML into a hidden iframe
                            let iframe = document.getElementById('printFrame');
                            let doc = iframe.contentWindow || iframe.contentDocument;
                            if (doc.document) doc = doc.document;
                            doc.open();
                            doc.write(response);
                            doc.close();

                            // ✅ Trigger print
                            iframe.contentWindow.focus();
                            iframe.contentWindow.print();
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'កំហុស!',
                                text: 'មានបញ្ហាក្នុងការ​បោះពុម្ពទិន្នន័យ។ សូមព្យាយាម​ម្តងទៀត។',
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
