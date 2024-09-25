<?php $index = 1; ?>
@foreach ($records as $record)
<?php 
    $department = App\Models\SystemSetup\Department::where('code', $record->department_code)->value('name_2');
    $skills = App\Models\General\Skills::where('code', $record->skills_code)->value('name_2');
    if($record->type == 'practical'){
        $timeType = 'ម៉ោងអនុវត្ត ជាក់ស្តែង';
    }else {
        $timeType = 'ម៉ោង ទ្រឹស្តី';
    }
?>
    <tr id="row{{$record->code ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/subjects/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">
                <i class="mdi mdi-border-color"></i> Edit
            </a>
            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->code ?? '' }}"><i class="mdi mdi-delete-forever"></i> Delete</button>
        </td>
        <td class="text-center">{{ $record->code }}</td>
        <td class="">{{ $record->name }}</td>
        <td class="">{{ $record->name_2 }}</td>
        <td class="text-center">{{ $skills }}</td>
        <td class="text-center">
            {{ $timeType }}
        </td>
        <td class="text-center">{{ $department }}</td>
        <td class="text-center">@if(($record->year_type) > 0) ឆ្នាំទី {{ $record->year_type }} @endif</td>
        <td class="text-center">
            <label class="badge {{ $record->is_active == 'no' ? 'badge-danger' : 'badge-success' }} btn-sm mb-2 mb-md-0 me-2">
                {{ $record->is_active ?? '' }}
            </label>
        </td>
    </tr>
@endforeach