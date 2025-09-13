<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
    .attendance-link {
        display: inline-block;
        margin: 3px 0;
        padding: 6px 14px;
        font-size: 13px;
        border-radius: 20px;
        transition: 0.3s;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
    }

    .margin-top {
        margin: 8rem 0 8rem 0 !important;
    }

    .attendance-link.btn-success {
        background-color: #00d284;
        border-color: #00d284;
        color: #fff;
    }

    .attendance-link.btn-info {
        background-color: #0dcaf0;
        border-color: #0dcaf0;
        color: #fff;
    }

    .attendance-link:hover {
        opacity: 0.85;
        transform: translateY(-2px);
    }

    .text-center td {
        vertical-align: middle;
    }

    .subject-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .subject-card:hover {
        transform: scale(1.05);
        border: solid #0dcaf0 1px !important;
        z-index: 2;
    }
</style>
@php $index = 1; @endphp
@foreach ($records as $record)
    @php
        $lines = App\Models\General\AssingClasses::select('subjects_code', 'class_code', 'teachers_code', 'assing_no')
            ->where('semester', $record->semester)
            ->where('class_code', $record->class_code)
            ->groupBy('subjects_code', 'teachers_code', 'assing_no', 'class_code')
            ->get();
        $subjectNames = $lines->pluck('subjects_code')->unique()->toArray();
    @endphp
    <tr class="text-center align-middle table-light">
        <td><strong>{{ $record->class_code ?? '' }}</strong></td>
        <td>ឆ្នាំទី{{ $record->years }} ឆមាសទី{{ $record->semester }}</td>
        <td>{{ $record->skill->name_2 ?? '' }}</td>
        <td>{{ $record->section->name_2 ?? '' }}</td>
        <td>{{ $record->qualification ?? '' }}</td>
        <td>{{ \App\Service\Service::formatSessionYearToKhmer($record->session_year_code ?? '') }}</td>
        <td>
            <a href="{{ url('exam-credit/attendance-list') }}" class="btn btn-sm btn-success attendance-link mb-1"
                data-class="{{ $record->class_code }}" data-semester="{{ $record->semester }}"
                data-years="{{ $record->years }}" data-attmonth="{{ $record->att_month }}"
                data-attyear="{{ $record->att_year }}">
                វត្តមានប្រចាំឆមាស
            </a>

            <a href="{{ url('exam-credit/attendance-list-monthly') }}" class="btn btn-sm btn-info attendance-link"
                data-class="{{ $record->class_code }}" data-semester="{{ $record->semester }}"
                data-years="{{ $record->years }}" data-attmonth="{{ $record->att_month }}"
                data-attyear="{{ $record->att_year }}">
                វត្តមានប្រចាំខែ
            </a>
        </td>
    </tr>
    <tr>
        <td colspan="12">
            <div class="p-3">
                <h6 class="fw-bold mb-3">📝 មុខវិជ្ជា:</h6>
                @if ($lines->count())
                    <div class="row">
                        @foreach ($lines as $line)
                            @php
                                $assing_line = App\Models\General\AssingClassesStudentLine::where(
                                    'assing_line_no',
                                    $line->assing_no,
                                )->get();
                            @endphp
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3 ">
                                <a href="javascript:void(0)" class="text-decoration-none d-block h-100 detailStudent"
                                    data-code="{{ $line->assing_no ?? '' }}"
                                    data-teacher="{{ $line->teacher->gender == 'ប្រុស' ? 'លោកគ្រូៈ' : 'អ្នកគ្រូៈ' }} {{ $line->teacher->name_2 ?? 'គ្មានគ្រូបង្រៀន' }}"
                                    data-subject="{{ $line->subject->name_2 ?? $line->subjects_code }}"
                                    data-bs-toggle="modal" data-bs-target="#mdiveStudetdetail">
                                    <div class="border rounded-3 p-3 bg-white h-100 subject-card">
                                        <h6 class="text-muted mb-2">
                                            {{ $line->teacher->gender == 'ប្រុស' ? 'លោកគ្រូៈ' : 'អ្នកគ្រូៈ' }}
                                            {{ $line->teacher->name_2 ?? 'គ្មានគ្រូបង្រៀន' }}
                                        </h6>
                                        <div class="fw-semibold text-dark">
                                            <i class="bi bi-book me-1 text-success"></i>
                                            {{ $line->subject->name_2 ?? $line->subjects_code }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-muted">គ្មានមុខវិជ្ជា</div>
                @endif
            </div>
        </td>
    </tr>
@endforeach

<!-- Student Detail Modal -->
<div class="modal fade" id="mdiveStudetdetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="modal-teacher-subject"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="studentDetailContent">
                <!-- Content from controller will be injected here -->
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.attendance-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const classCode = this.getAttribute('data-class');
            const semester = this.getAttribute('data-semester');
            const years = this.getAttribute('data-years');
            const attMonth = this.getAttribute('data-attmonth');
            const attYear = this.getAttribute('data-attyear');

            const url = new URL(this.href, window.location.origin);
            if (classCode) url.searchParams.set('class_code', classCode);
            if (semester) url.searchParams.set('semester', semester);
            if (years) url.searchParams.set('years', years);
            if (attMonth) url.searchParams.set('att_month', attMonth);
            if (attYear) url.searchParams.set('att_year', attYear);

            window.location.href = url.toString();
        });
    });
    $(document).on('click', '.detailStudent', function() {
        var code = $(this).data('code');
        var teacher = $(this).data('teacher');
        var subject = $(this).data('subject');

        $('#modal-teacher-subject').html(`${teacher} | ${subject}`);
        $('#studentDetailContent').html('<p class="text-muted">កំពុងទាញ...</p>');

        $.ajax({
            url: '{{ route('get-student-detail') }}',
            type: 'GET',
            data: {
                code: code
            },
            success: function(res) {
                if (res.status === 'success') {
                    $('#studentDetailContent').html(res.html);
                } else {
                    $('#studentDetailContent').html(
                        '<div class="alert alert-warning">មិនមានទិន្នន័យ</div>');
                }
            },
            error: function() {
                $('#studentDetailContent').html(
                    '<div class="alert alert-danger">បរាជ័យក្នុងការទាញទិន្នន័យ</div>');
            }
        });
    });
</script>
