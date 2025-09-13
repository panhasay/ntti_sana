<?php $index = 1; ?>
@foreach ($records as $record)
<?php 
    Carbon\Carbon::setLocale('km');
    $department = App\Models\SystemSetup\Department::where('code', $record->department_code ?? '')->value('name_2');
    $sections = \DB::table('sections')->where('code', $record->sections_code ?? '')->value('name_2');
    $skills = \DB::table('skills')->where('code', $record->skills_code ?? '')->value('name_2');
    $date = Carbon\Carbon::create($record->start_date);
    $formattedDate = 'ថ្ងៃទី ' . $date->day . ' ខែ ' . $date->translatedFormat('F') . ' ឆ្នាំ ' . $date->year;
    $totals_student = \DB::table('student')
        ->where('class_code', $record->code)
        ->where('skills_code', $record->skills_code)
        ->where('qualification', $record->level)
        ->where('department_code', $record->department_code)
        ->where('study_type', 'new student')
        ->where('sections_code', $record->sections_code)
        ->count();

    $new_student = \DB::table('student')
                    ->where('skills_code', $record->skills_code)
                    ->where('qualification', $record->level)
                    ->where('department_code', $record->department_code)
                  
                    ->where('study_type', 'new student')
                    ->where('sections_code', $record->sections_code)
                    ->count();
    
    // dd($new_student);
   

?>  
    <tr id="row{{$record->code ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                target="_blank" href="{{'/class-new/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code ?? '') }}">
                <i class="mdi mdi-border-color"></i>បើក
            </a>
        </td>
        <td class="">{{ $record->code ?? '' }}</td>
        <td class="">
            {{ $totals_student ?? '' }} នាក់ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span>
                @if($totals_student >= 50)
                    <label class="badge badge-danger btn-sm mb-2 mb-md-0 me-2">
                        ពេញ 50 នាក់
                    </label>
                @elseif($new_student != $new_student)
                    <label class="badge badge-success btn-sm mb-2 mb-md-0 me-2">
                        មាននិស្សឹតថ្មី
                    </label>
                @else
                   
                @endif
            </span>
        </td>
        <td class="">{{ $sections ?? '' }}</td>
        <td class="">{{ $skills ?? '' }}</td>
        <td class="">{{ $record->level ?? '' }}</td>
        <td class="">{{ $department ?? '' }}</td>
        <td class="">{{ $record->school_year_code ? \Illuminate\Support\Str::replace('_', '-', $record->school_year_code) : '' }}
        </td>
    </tr>
@endforeach