<tr id="row_line{{ $record->code }}">
    <td>
        <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'class-new/transaction/update-student?type=ed&code='.\App\Service\service::Encr_string($record->code) }}"><i class="mdi mdi-border-color"></i> Edit</a>
        <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDeleteLine" data-code="{{ $record->code ?? '' }}">
            <i class="mdi mdi-delete-forever"></i> Delete
        </button>
    </td>
    <td class="text-center"> {{ $record->code ?? '' }}</td>
    <td>{{ $record->name_2 ?? '' }}</td>
    <td>{{ $record->name ?? '' }}</td>
    <td>{{ $record->gender ?? '' }}</td>
    <td>{{ App\Service\service::DateYearKH($record->date_of_birth) ?? '' }}</td>
    <td>{{ $record->phone_student ?? '' }}</td>
    <td>{{ $record->class_code ?? '' }}</td>
    <td>{{ DB::table('skills')->where('code', $record->skills_code)->value('name_2') ?? '' }}</td>
    <td>{{ $record->qualification ?? '' }}</td>
    <td>{{ DB::table('sections')->where('code', $record->sections_code)->value('name_2') ?? '' }}</td>
    <td>{{ DB::table('department')->where('code', $record->department_code)->value('name_2') ?? '' }}</td>
    <td>{{ $record->session_year_code ? str_replace('_', '-', $record->session_year_code) : '' }}</td>
    <td></td>
</tr>
