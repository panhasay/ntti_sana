<?php $index = 1; ?>
@foreach ($records as $record)
    <tr id="row{{$record->id}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{ 'departments/transaction?type=ed&code='.\App\Service\service::Encr_string($record->id) }}"><i class="mdi mdi-border-color"></i> Edit</a>
            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->id ?? '' }}"><i class="mdi mdi-delete-forever"></i> Delete</button>
        </td>
        <td class="">{{ $index++ }}</td>
        <td class="">{{ $record->code }}</td>
        <td class="">{{ $record->name }}</td>
        <td class="">{{ $record->name_2 }}</td>
        <td class="text-center">
            <label class="badge {{ $record->is_active == 'no' ? 'badge-danger' : 'badge-success' }} btn-sm mb-2 mb-md-0 me-2">
                {{ $record->is_active ?? '' }}
            </label>
        </td>
    </tr>
@endforeach