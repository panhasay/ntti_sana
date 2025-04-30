@foreach ($records as $record)
  <tr id="row_line{{ $record->code }}">
    <?php $picture =  App\Models\General\Picture::where('code', $record->code)->value('picture_ori'); ?>
    <td>
        <button type="button" id="prints" data-code="{{ $record->code ?? '' }}" class="btn btn-outline-info btn-icon-text btn-sm mb-2 mb-md-0 me-2"> បោះពុម្ព
          <i class="mdi mdi-printer btn-icon-append"></i>
        </button>
        <button data-page="student" id="BtnPriview" data-code="{{ $record->code ?? '' }}" data-name="{{ $record->name_2 ?? '' }}" type="button" class="btn btn-outline-primary btn-icon-text btn-sm">
          <i class="mdi mdi-eye"></i> ក្រែសម្រួល 
        </button>
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
@endforeach
