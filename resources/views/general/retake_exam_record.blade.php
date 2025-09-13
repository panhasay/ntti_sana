@php $i = 1; @endphp

@if (count($studentsByClass) > 0)
    @foreach ($studentsByClass as $classCode => $students)
        @foreach ($students as $student)
            <tr>
                <td class="text-center">{{ $i++ }}</td>
                <td class="{{ $student['gender'] == 'ស្រី' ? 'fw-bold' : '' }}">
                    {{ $student['student_name'] }}
                </td>
                <td class="text-center {{ $student['gender'] == 'ស្រី' ? 'fw-bold' : '' }}">
                    {{ $student['gender'] }}
                </td>
                <td class="text-center">Y{{ $student['year'] }}S{{ $student['semester'] }}</td>
                <td class="text-center">{{ $student['class_code'] }}</td>
                <td class="text-center align-middle">
                    <div class="d-flex justify-content-start align-items-center gap-2">
                        <span class="badge bg-danger fs-6">{{ $student['failed_subjects_count'] }}</span>
                        @if (!empty($student['failed_subjects']))
                            <select class="form-select form-select-sm w-auto shadow-sm rounded-3">
                                @foreach ($student['failed_subjects'] as $subject)
                                    <option>{{ $subject }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </td>
                <td class="text-center">{{ $student['average_score'] }}</td>
            </tr>
        @endforeach
    @endforeach
@else
    <div class="marginTop">
        <tr class="no-border-row py-5 mt-5">
            <td colspan="6" class="text-center py-5">
                <h4 class="text-muted fw-bold mb-0">មិនមានសិស្សនៅក្នុងថ្នាក់ទេ!</h4>
            </td>
        </tr>
    </div>
@endif
<style>
    .no-border-row>td {
        border: solid 1px white !important;
        border-bottom: none !important;
    }

    .marginTop {
        margin-top: 7rem;
    }
</style>
