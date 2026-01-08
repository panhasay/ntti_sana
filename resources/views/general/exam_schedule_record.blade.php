<?php $index = 1; ?>
@foreach ($records as $record)
<?php
    Carbon\Carbon::setLocale('km');
    $department = App\Models\SystemSetup\Department::where('code', $record->department_code ?? '')->value('name_2');
    $sections = \DB::table('sections')
        ->where('code', $record->sections_code ?? '')
        ->value('name_2');
    $skills = \DB::table('skills')
        ->where('code', $record->skills_code ?? '')
        ->value('name_2');
    $date = Carbon\Carbon::create($record->start_date);
    $formattedDate = 'ថ្ងៃទី ' . $date->day . ' ខែ ' . $date->translatedFormat('F') . ' ឆ្នាំ ' . $date->year;
    ?>
<tr id="row{{ $record->code ?? '' }}">
    <td class="">
        {{-- <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
            href="{{ '/exam-schedule/transaction?type=ed&code=' . \App\Service\service::Encr_string($record->id ?? '') }}">
            <i class="mdi mdi-border-color"></i>
        </a> --}}
        <button
            id="btnUpddateExamSchedule"
            class="btn btn-sm {{ $record->exam_status == 'Yes' ? 'btn-success' : 'btn-danger' }}"
            data-code="{{ $record->class_code }}"
            data-status="{{ $record->exam_status }}"
        >
            {{ $record->exam_status == 'Yes' ? 'កំពុងប្រឡង' : 'ចាប់ផ្ដើមប្រឡង' }}
        </button>
    </td>

    <td class="text-center">{{ $record->class_code ?? '' }}</td>
    <td class="text-center">{{ $sections ?? '' }}</td>
    <td class="text-center">{{ $skills ?? '' }}</td>
    <td class="text-center">{{ $record->qualification ?? '' }}</td>
    <td class="text-center">ឆមាសទី{{ $record->semester ?? '' }}</td>
    <td class="text-center">{{ $department ?? '' }}</td>
    <td class="text-center">{{ $formattedDate ?? '' }}</td>
    <td class="text-center">{{ $record->session_year_code ?? '' }}</td>
    <td class="text-center">ឆ្នាំទី​ {{ $record->years ?? '' }}​</td>
</tr>
@endforeach

<style>
    .print-checkbox {
        transform: scale(1.2);
        cursor: pointer;
    }
</style>

<div class="modal fade" id="divConfirmation" tabindex="-1" role="dialog" aria-labelledby="divConfirmation"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-m-header">
                <h5 class="modal-title" id="divConfirmation">Confirmation</h5>
            </div>
            <div class="modal-body">
                <h4 class="modal-confirmation-text text-center p-4"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnYes" data-code="" class="btn btn-primary">Yes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
       $(document).on('click', '#btnUpddateExamSchedule', function () {

        let btn = $(this);
        let class_code = btn.data('code');
        let current_status = btn.attr('data-status');

        let new_status = (current_status === 'Yes') ? 'No' : 'Yes';

        $.ajax({
            url: "{{ route('exam.schedule.update.date.ExamSchedule') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                class_code: class_code,
                exam_status: new_status
            },
            success: function (res) {

                if (res.success === true) {

                    // ✅ update status for next click
                    btn.attr('data-status', new_status);

                    if (new_status === 'Yes') {
                        btn
                            .removeClass('btn-danger')
                            .addClass('btn-success')
                            .text('កំពុងប្រឡង');
                    } else {
                        btn
                            .removeClass('btn-success')
                            .addClass('btn-danger')
                            .text('ចាប់ផ្ដើមប្រឡង');
                    }
                }
            },
            error: function () {
                alert('Update failed!');
            }
        });
    });

    });
</script>