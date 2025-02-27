<tr id="row_line{{ $record->code }}">
    <?php $picture =  App\Models\General\Picture::where('code', $record->code)->value('picture_ori'); ?>
    <td>
        <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'student/registration/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code) }}"><i class="mdi mdi-border-color"></i> Edit</a>
        {{-- <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDeleteLine" data-code="{{ $record->code ?? '' }}">
            <i class="mdi mdi-delete-forever"></i> Delete
        </button> --}}
        @if($picture != null)
            <img class="btn-Image" id="btn-Image" data-code ='{{$record->code ?? ''}}' src="{{ $picture ?? '' }}" width="1000" height="1000">
        @else
            <img class="btn-Image" id="btn-Image" data-code ='{{$record->code ?? ''}}' src="asset/NTTI/images/faces/default_User.jpg" width="1000" height="1000">
        @endif
    </td>
    <td class="text-center"> {{ $record->code ?? '' }}</td>
    <td>{{ $record->name_2 ?? '' }}</td>
    <td>{{ ucwords(strtolower($record->name ?? '')) }}</td>
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
