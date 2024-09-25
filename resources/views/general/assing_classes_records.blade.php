<?php $index = 1; ?>
@foreach ($records as $record)
    <tr id="row{{ $record->code ?? '' }}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{ '/assign-classes/transaction?type=ed&code=' . App\Service\service::Encr_string($record->id) }}&years={{ $record->years ?? '' }}&type={{ $record->qualification ?? '' }}&assing_no={{ $record->assing_no ?? '' }}">
                <i class="mdi mdi-border-color"></i> Open
            </a>
        </td>
        <td class="text-center">{{ $record->session_year_code }}</td>
        <td class="text-center">{{ $record->class_code }}</td>
        <td class="text-center">{{ $record->section->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->skill->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->department->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->teacher->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->subject->name ?? '' }}</td>
        <td class="text-center">{{ $record->semester == '1' ? 'ឆមាសទី ១' : ($record->semester == '2' ? 'ឆមាសទី ២' : '') }}</td>
        <td class="text-center">
            @if($record->exam_type == 'Yes')
                <label class="badge badge-success btn-sm mb-2 mb-md-0 me-2" id="exam_type">បានប្រលងបញ្ចាប់</label>
            @else
                <label class="badge badge-danger btn-sm mb-2 mb-md-0 me-2">&nbsp;&nbsp;មិនទាន់ប្រលង&nbsp;&nbsp;</label>
            @endif
        </td>

        
    </tr>
@endforeach
