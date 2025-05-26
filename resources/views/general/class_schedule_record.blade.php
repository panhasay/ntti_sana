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
    <tr id="row{{$record->id ?? ''}}">
        <td class="">
            <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                href="{{'/class-schedule/transaction?type=ed&code='.\App\Service\service::Encr_string($record->id ?? '') }}">
                <i class="mdi mdi-border-color"></i> បើក
            </a>
            <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->id ?? '' }}"><i class="mdi mdi-delete-forever"></i> លុប</button>
        </td>
        <td class="text-center">{{ $index++ }}</td>
        <td class="text-center">{{ $record->class_code ?? '' }}</td>
        <td class="text-center">{{ $sections ?? '' }}</td>
        <td class="text-center">{{ $skills ?? '' }}</td>
        <td class="text-center">{{ $record->qualification ?? '' }}</td>
        <td class="text-center">{{ $department ?? '' }}</td>
        <td class="text-center">{{ $formattedDate  ?? '' }}</td>
        <td class="text-center">{{ str_replace('_', ' - ', $record->session_year_code ?? "") }}</td>
        <td class="text-center">ឆ្នាំទី​ {{ $record->years ?? '' }}​</td>
    </tr>
@endforeach