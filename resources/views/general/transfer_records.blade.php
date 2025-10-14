<?php $index = 1; ?>
@foreach ($records as $record)
    <?php
        $hang_of_student = App\Models\General\HangOfStudent::where('student_code', $record->student_code)->first();
    ?>
    <tr id="row{{$record->student_code ?? ''}}" class="{{ $hang_of_student->student_code ?? '' == $record->student_code ? 'bg-warning text-white' : '' }}">
        <td class="">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">ស្នើរសុំ</button>
                <div class="dropdown-menu" style="">
                <a class="dropdown-item" data-type="transfer" data-code="{{ $record->student_code ?? '' }}" id="student_change_class" href="javascript:;">ប្ដូរក្រុម/ប្ដូរវេនសិក្សា</a>
                <a class="dropdown-item" id="hang_of_study" data-code="{{ $record->student_code ?? '' }}" data-type="hang_of_study" href="javascript:;">ព្យួរកាសិក្សា</a>
                <a class="dropdown-item">ឈប់ </a>
                </div>
            </div>
            
            {{-- <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/transfer/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">
                <i class="mdi mdi-border-color"></i> ស្នើសុំប្ដូរ
            </a> --}}

        </td>
        <td class="text-center">{{ $record->student_code }}</td>
        <td class="">{{ $record->student->name_2 ?? '' }}</td>
        <td class="">{{ $record->student->name ?? '' }}</td>
        <td class="">{{ $record->student->gender }}</td>
        <td class="">{{ $record->student->phone_student }}</td>
        <td class="">{{ str_replace('.', '', $record->class_code) }}</td>
        <td class="">{{ $record->skill->name_2 ?? '' }}</td>
        <td class="">{{ $record->qualification ?? '' }}</td>
        <td class="">{{ $record->section->name_2 ?? '' }}</td>
        <td class="">{{ $record->semester ?? '' }}</td>
        <td class="">{{ $record->years ?? '' }}</td>
    </tr>
@endforeach