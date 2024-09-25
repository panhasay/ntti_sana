<?php $index = 1; ?>
@foreach ($records as $record)
    <tr id="row{{ $record->code ?? '' }}">
        <td class="">
            <a class="btn btn-success btn-icon-text btn-sm mb-2 mb-md-0 me-2 ExamResults" data-class="{{ $record->class_code ?? ''}}"
                href="javascript:void(0)">
                <i class="mdi mdi-border-color"></i>សរុបពិន្ទុ
            </a>
        </td>
        <td class="text-center">{{ $record->class_code }}</td>
        <td class="text-center">{{ $record->section->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->skill->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->department->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->semester == '1' ? 'ឆមាសទី ១' : ($record->semester == '2' ? 'ឆមាសទី ២' : '') }}</td>
        <td class="text-center">{{ $record->teacher->name_2 ?? '' }}</td>
        <td class="text-center">{{ $record->session_year_code }}</td>
    </tr>
@endforeach
