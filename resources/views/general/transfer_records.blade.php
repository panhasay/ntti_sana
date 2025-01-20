<?php $index = 1; ?>
@foreach ($records as $record)
    <tr id="row{{$record->no ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/transfer/transaction?type=ed&code='.\App\Service\service::Encr_string($record->no ?? '') }}">
                <i class="mdi mdi-border-color"></i> Edit
            </a>
            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->no ?? '' }}"><i class="mdi mdi-delete-forever"></i> Delete</button>
        </td>
        <td class="text-center">{{ $record->no }}</td>
        <td class="">{{ $record->class_code }}</td>
        <td class="">{{ $record->transfer_to_class_code }}</td>
        <td class="">{{ $record->skill->name_2 }}</td>
        <td class="">{{ $record->department->name_2 ?? '' }}</td>
        <td class="text-center">
            <label class="badge {{ $record->status == 'no' ? 'badge-danger' : 'badge-success' }} btn-sm mb-2 mb-md-0 me-2">
                {{ $record->status ?? '' }}
            </label>
        </td>
    </tr>
@endforeach