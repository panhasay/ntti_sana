<style>
    .pagination {
        margin-top: 20px;
        margin-bottom: 20px;
        justify-content: center;
    }

    .page-link {
        border-radius: 4px;
        margin: 0 8px;
        transition: background-color 0.3s ease;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    table td,
    th {
        padding: 12px !important;
    }
</style>
<div id="exam-credit-wrapper" class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-bordered table-striped">
        <thead>
            <tr class="general-data text-center">
                <th>ក្រុម</th>
                <th>ឆ្នាំសិក្សា</th>
                <th>ជំនាញ</th>
                <th>វេន</th>
                <th>កម្រិត</th>
                <th>ជំនាញ</th>
                <th>សកម្មភាព</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($isSearch) && $isSearch)
                @forelse ($records as $record)
                    <tr class="text-center align-middle table-light">
                        <td><strong>{{ $record->class_code ?? '' }}</strong></td>
                        <td>ឆ្នាំទី{{ $record->years }} ឆមាស{{ $record->semester }}</td>
                        <td>{{ $record->skill_name ?? '' }}</td>
                        <td>{{ $record->section_name ?? '' }}</td>
                        <td>{{ $record->qualification ?? '' }}</td>
                        <td>
                            <a href="{{ url('exam-credit/attendance-list') }}"
                                class="btn btn-sm btn-success attendance-link mb-1" data-class="{{ $record->class_code }}"
                                data-semester="{{ $record->semester }}" data-years="{{ $record->years }}">
                                វត្តមានប្រចាំឆមាស
                            </a>
                            <a href="{{ url('exam-credit/attendance-list-monthly') }}"
                                class="btn btn-sm btn-info attendance-link" data-class="{{ $record->class_code }}"
                                data-semester="{{ $record->semester }}" data-years="{{ $record->years }}">
                                វត្តមានប្រចាំខែ
                            </a>
                        </td>
                        <td>{{ \App\Service\Service::formatSessionYearToKhmer($record->session_year_code ?? '') }}</td>
                    </tr>
                    @php
                        $lines = App\Models\General\AssingClasses::with(['teacher', 'subject'])
                            ->select('subjects_code', 'class_code', 'teachers_code', 'assing_no')
                            ->where('semester', $record->semester)
                            ->where('class_code', $record->class_code)
                            ->groupBy('subjects_code', 'teachers_code', 'assing_no', 'class_code')
                            ->get();
                    @endphp
                    <tr>
                        <td colspan="12">
                            <div class="p-3">
                                <h6 class="fw-bold mb-3">📝 មុខវិជ្ជា:</h6>
                                @if ($lines->count())
                                    <div class="row">
                                        @foreach ($lines as $line)
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                                <a href="javascript:void(0)"
                                                    class="text-decoration-none d-block h-100 detailStudent"
                                                    data-code="{{ $line->assing_no ?? '' }}"
                                                    data-teacher="{{ $line->teacher?->gender == 'ប្រុស' ? 'លោកគ្រូៈ' : 'អ្នកគ្រូៈ' }} {{ $line->teacher->name_2 ?? 'គ្មានគ្រូបង្រៀន' }}"
                                                    data-subject="{{ $line->subject->name_2 ?? $line->subjects_code }}"
                                                    data-bs-toggle="modal" data-bs-target="#mdiveStudetdetail">
                                                    <div class="border rounded-3 p-3 bg-white h-100 subject-card">
                                                        <h6 class="text-muted mb-2">
                                                            {{ $line->teacher?->gender == 'ប្រុស' ? 'លោកគ្រូៈ' : 'អ្នកគ្រូៈ' }}
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
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">មិនមានទិន្នន័យ</td>
                    </tr>
                @endforelse
            @else
                @include('general.exam_credit_record')
            @endif
        </tbody>
    </table>

    {{ $records->links('pagination::bootstrap-4') ?? '' }}
</div><br><br>
