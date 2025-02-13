<?php $index = 1; ?>
@foreach ($records as $record)
    <tr id="row{{$record->code ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/student-sana/transaction?type=ed&code='.\App\Service\service::Encr_string($record->no ?? '') }}">
                <i class="mdi mdi-border-color"></i>Open
            </a>
            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->no ?? '' }}"><i class="mdi mdi-delete-forever"></i> Delete</button>
        </td>
        <td class="text-center">{{ $record->no }}</td>
        <td class="">{{ $record->class_code }}</td>
        <td class="">ជំនាន់{{ $record->index_class ?? '' }}</td>
        <td class="">{{ App\Service\service::DateYearKH($record->starting_date) ?? '' }}</td>
        <td class="">{{ App\Service\service::DateYearKH($record->ending_date) ?? '' }}</td>
        <td class="">{{ $record->class->department->name_2 ?? '' }}</td>
        <td class="">{{ $record->class->skill->name_2 ?? '' }}</td>
        <td class="">{{ $record->class->section->name_2 ?? '' }}</td>
    </tr>
@endforeach