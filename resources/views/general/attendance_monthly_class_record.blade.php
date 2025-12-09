@php
    $index = 1;
@endphp
@foreach ($records as $record)
    @php
        // dd($record);
        $teachers = collect($records)
            ->filter(fn($r) => $r->subjects_code == $record->subjects_code)
            ->map(
                fn($r) => [
                    'teacher_code' => $r->teachers_code,
                    'teacher_name' => DB::table('teachers')->where('code', $r->teachers_code)->value('name_2'),
                    'gender' => DB::table('teachers')->where('code', $r->teachers_code)->value('gender'),
                ],
            )
            ->unique('teacher_code');

        $skill = DB::table('skills')->where('code', $record->skills_code)->value('name_2');
        $department = DB::table('department')->where('code', $record->department_code)->value('name_2');
        $section = DB::table('sections')->where('code', $record->sections_code)->value('name_2');
        $teacher = DB::table('teachers')->where('code', $record->teachers_code)->value('name_2');
        $teacher_gender = DB::table('teachers')->where('code', $record->teachers_code)->value('gender');
        $subject = DB::table('subjects')->where('code', $record->subjects_code)->value('name_2');
        $session = $record->sessions_type ?? '';
    @endphp
    <tr>
        <td>
            <button class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2 openSubjectModal"
                data-assign="{{ $record->assing_no ?? '' }}">
                វត្តមានតាមមុខវិជ្ជា
            </button>
        </td>
        <td>{{ $index++ }}</td>
        <td class="text-start">
            {{ $teacher_gender == 'ស្រី' ? 'លោកស្រី' : 'លោក' }} {{ $teacher ?? '' }}</td>
        <td class="text-start" style=" font-family: system-ui, sans-serif !important;">{{ $subject }}</td>
        <td>{{ $department ?? '' }}</td>
        <td>{{ $skill ?? '' }}</td>
        <td>{{ $record->qualification ?? '' }}</td>
        <td>{{ $section ?? '' }}</td>
        <td>
            {{ $session == 3 ? 'ពេញម៉ោង' : ($session == 2 ? 'ម៉ោងទីពីរ' : 'ម៉ោងទីមួយ') }}
        </td>
    </tr>
@endforeach
