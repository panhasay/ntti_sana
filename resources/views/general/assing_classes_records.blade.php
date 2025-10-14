@php
    $shownTeachers = []; // array to track which teacher_code already shown
@endphp

@if(count($records) > 0)
    @foreach($records as $record)
        @if(!in_array($record->teacher_code, $shownTeachers) && !empty($record->sessions_type))
            @php
                $shownTeachers[] = $record->teacher_code; // mark as shown
            @endphp
            <tr id="row">
                <td class="text-center">
                    {{-- <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                        href="{{ '/assign-classes/transaction?type=ed&code=' . App\Service\service::Encr_string($record->id) }}&years={{ $record->years ?? '' }}&type={{ $record->qualification ?? '' }}&assing_no={{ $record->assing_no ?? '' }}">
                        <i class="mdi mdi-border-color"></i> 
                    </a> --}}
                    ម៉ោងទី​ {{  $record->sessions_type ?? '' }}
                </td>
                <td>{{ str_replace('_', ' - ', $record->session_year_code) }}</td>
                <td>{{ str_replace('.', '', $record->class_code) }}</td>
                <td>{{ $record->section->name_2 ?? '' }}</td>
                <td>{{ $record->skill->name_2 ?? '' }}</td>
                <td>{{ $record->department->name_2 ?? '' }}</td>
                <td>{{ $record->teacher->name_2 ?? '' }}</td>
                <td>{{ $record->subject->name ?? '' }}</td>
                <td>{{ $record->semester == '1' ? 'ឆមាសទី ១' : ($record->semester == '2' ? 'ឆមាសទី ២' : '') }}</td>
                <td>{{ $record->years == '1' ? 'ឆ្នាំទី ១' : ($record->years == '2' ? 'ឆ្នាំទី ២' : '') }}</td>
                <td>
                    @if($record->exam_type == 'Yes')
                        <label class="badge badge-success btn-sm mb-2 mb-md-0 me-2" id="exam_type">បានប្រលងបញ្ចាប់</label>
                    @else
                        <label class="badge badge-danger btn-sm mb-2 mb-md-0 me-2">&nbsp;&nbsp;មិនទាន់ប្រលង&nbsp;&nbsp;</label>
                    @endif
                </td>
            </tr>
        @else
        <tr id="row">
                <td class="">
                    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2"
                        href="{{ '/assign-classes/transaction?type=ed&code=' . App\Service\service::Encr_string($record->id) }}&years={{ $record->years ?? '' }}&type={{ $record->qualification ?? '' }}&assing_no={{ $record->assing_no ?? '' }}">
                        <i class="mdi mdi-border-color"></i> បើក
                    </a>
                </td>
                <td>{{ str_replace('_', ' - ', $record->session_year_code) }}</td>
                <td>{{ str_replace('.', '', $record->class_code) }}</td>
                <td>{{ $record->section->name_2 ?? '' }}</td>
                <td>{{ $record->skill->name_2 ?? '' }}</td>
                <td>{{ $record->department->name_2 ?? '' }}</td>
                <td>{{ $record->teacher->name_2 ?? '' }}</td>
                <td>{{ $record->subject->name ?? '' }}</td>
                <td>{{ $record->semester == '1' ? 'ឆមាសទី ១' : ($record->semester == '2' ? 'ឆមាសទី ២' : '') }}</td>
                <td>{{ $record->years == '1' ? 'ឆ្នាំទី ១' : ($record->years == '2' ? 'ឆ្នាំទី ២' : '') }}</td>
                <td>
                    @if($record->exam_type == 'Yes')
                        <label class="badge badge-success btn-sm mb-2 mb-md-0 me-2" id="exam_type">បានប្រលងបញ្ចាប់</label>
                    @else
                        <label class="badge badge-danger btn-sm mb-2 mb-md-0 me-2">&nbsp;&nbsp;មិនទាន់ប្រលង&nbsp;&nbsp;</label>
                    @endif
                </td>
            </tr>
        @endif

    @endforeach
@else
    <tr>
        <td colspan="10" class="text-center p-3">មិនមានទិន្ន័យ</td>
    </tr>
@endif
