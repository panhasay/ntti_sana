<?php $index = 1; ?>
@foreach ($records as $record)
    <tr id="row{{$record->no ?? ''}}">

        <td class="">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">ស្នើរសុំ</button>
                <div class="dropdown-menu" style="">
                <a class="dropdown-item" data-type="transfer" href="{{'/transfer/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">ប្ដូរក្រុម/ប្ដូរវេនសិក្សា</a>
                <a class="dropdown-item" id="hang_of_study" data-type="hang_of_study" href="javascript:;">ព្យួរកាសិក្សា</a>
                <a class="dropdown-item">ឈប់ </a>
                </div>
            </div>
            
            {{-- <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/transfer/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">
                <i class="mdi mdi-border-color"></i> ស្នើសុំប្ដូរ
            </a> --}}

        </td>
        <td class="text-center">{{ $record->code }}</td>
        <td class="">{{ $record->name_2 }}</td>
        <td class="">{{ $record->name }}</td>
        <td class="">{{ $record->gender }}</td>
        <td class="">{{ $record->phone_student }}</td>
        <td class="">{{ str_replace('.', '', $record->class_code) }}</td>
        <td class="">{{ $record->skill->name_2 ?? '' }}</td>
        <td class="">{{ $record->qualification ?? '' }}</td>
        <td class="">{{ $record->section->name_2 ?? '' }}</td>
    </tr>
@endforeach