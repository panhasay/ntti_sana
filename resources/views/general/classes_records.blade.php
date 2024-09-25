<?php $index = 1; ?>
@foreach ($records as $record)
<?php 
    $department = App\Models\SystemSetup\Department::where('code', $record->department_code)->value('name_2');
    $sections = \DB::table('sections')->where('code', $record->sections_code)->value('name_2');
    $skills = \DB::table('skills')->where('code', $record->skills_code)->value('name_2');
?>  
    <tr id="row{{$record->code ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/classes/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">
                <i class="mdi mdi-border-color"></i> Edit
            </a>
            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->code ?? '' }}"><i class="mdi mdi-delete-forever"></i> Delete</button>
        </td>
        <td class="text-center">{{ $record->code }}</td>
        <td class="text-center">{{ $record->name }}</td>
        <td class="text-center">{{ $sections ?? '' }}</td>
        <td class="text-center">{{ $skills ?? '' }}</td>
        <td class="text-center">{{ $record->level ?? '' }}</td>
        <td class="text-center">{{ $department ?? '' }}</td>
        <td class="text-center">{{ $record->school_year_code }}</td>
        <td class="text-center">
            <label class="badge {{ $record->is_active == 'no' ? 'badge-danger' : 'badge-success' }} btn-sm mb-2 mb-md-0 me-2">
                {{ $record->is_active ?? '' }}
            </label>
        </td>
    </tr>
@endforeach