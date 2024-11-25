<?php $index = 1; ?>
@foreach ($records as $record)
<?php 
    Carbon\Carbon::setLocale('km');
    $department = App\Models\SystemSetup\Department::where('code', $record->department_code ?? '')->value('name_2');
    $sections = \DB::table('sections')->where('code', $record->sections_code ?? '')->value('name_2');
    $skills = \DB::table('skills')->where('code', $record->skills_code ?? '')->value('name_2');
    $date = Carbon\Carbon::create($record->start_date);
    $formattedDate = 'ថ្ងៃទី ' . $date->day . ' ខែ ' . $date->translatedFormat('F') . ' ឆ្នាំ ' . $date->year;
?>  
    <tr id="row{{$record->code ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/class-new/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">
                <i class="mdi mdi-border-color"></i> Open
            </a>
        </td>
        <td class="">{{ $index++ }}</td>
        <td class="">{{ $record->code ?? '' }}</td>
        <td class="">{{ $sections ?? '' }}</td>
        <td class="">{{ $skills ?? '' }}</td>
        <td class="">{{ $record->level ?? '' }}</td>
        <td class="">{{ $department ?? '' }}</td>
        <td class="">{{ $record->school_year_code ? \Illuminate\Support\Str::replace('_', '-', $record->school_year_code) : '' }}
        </td>
    </tr>
@endforeach