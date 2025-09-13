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
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{ '/exam-schedule/transaction?type=ed&code=' . \App\Service\service::Encr_string($record->id ?? '') }}">
                <i class="mdi mdi-border-color">បើក</i>
            </a>
            {{-- <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDeleteExamSchedule"
                data-code="{{ $record->id ?? '' }}"><i class="mdi mdi-delete-forever"></i>លុប
            </button> --}}
        </td>
        <td class="text-center">
            <input type="checkbox" class="print-checkbox" value="{{ $record->id }}">
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
        $(document).on('click', '#btnDeleteExamSchedule', function() {
            var code = $(this).attr('data-code');
            alert(code);
        });

    });
</script>
