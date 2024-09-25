<?php $index = 1; ?>
@foreach ($records as $record)
<?php 
    $department = App\Models\SystemSetup\Department::where('code', $record->department_code)->value('name_2');
    // this function for date khmer 
    $date = $record->date_of_joining;
    $date_of_joining = App\Service\service::convertToKhmerDate($date);
    $date_of_birth = App\Service\service::convertToKhmerDate($record->date_of_birth);
?>
    <tr id="row{{$record->code ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/teachers/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">
                <i class="mdi mdi-border-color"></i> Edit
            </a>
            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->code ?? '' }}"><i class="mdi mdi-delete-forever"></i> Delete</button>
            <img src="asset/NTTI/images/faces/default_User.jpg" alt="image">
        </td>
        <td class="text-center">{{ $record->code }}</td>
        <td class="">{{ $record->name_2 }}</td>
        <td class="">{{ $record->name }}</td>
        <td class="">{{ $record->gender }}</td>
        <td class="">{{ $record->phone_no }}</td>
        <td class="text-center">{{ $record->id_card }}</td>
        <td class="">{{ $date_of_birth }}</td>
        <td class="">{{ $record->address }}</td>
        <td class="">{{ $record->email }}</td>
        <td class="">{{ $department }}</td>
        <td class="">{{ $date_of_joining }}</td>
        <td class="">{{ $record->mother_name }}</td>
        <td class="">{{ $record->father_name }}</td>
        <td class="">{{ $record->marital_status }}</td>
        <td class="">{{ $record->work_exp }}</td>
        <td class="">{{ $record->qualification }}</td>
        <td class="text-center">
            <label class="badge {{ $record->status == 'no' ? 'badge-danger' : 'badge-success' }} btn-sm mb-2 mb-md-0 me-2">
                {{ $record->status ?? '' }}
            </label>
        </td>
    </tr>
@endforeach