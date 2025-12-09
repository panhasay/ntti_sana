@if(count($records) > 0)
  @foreach ($records as $record)
    <?php 
        // $gender = ($record->gender == 'male') ? 'ប្រុស' : 'ស្រី';
        $khmerDate = !empty($record->date_of_birth) ? App\Service\service::DateYearKH($record->date_of_birth) : '';
        $student_picture = App\Models\General\Picture::where('code', $record->code)->value('picture_ori');	
    ?>
    <tr id="row{{$record->code}}">
      <td>
        <a class="btn btn-primary btn-icon-text btn-sm" href="{{ 'registration/transaction?type=ed&code=' . \App\Service\service::Encr_string($record->code) }}">
          <i class="mdi mdi-border-color"></i> កែប្រែ
        </a>
        <button class="btn btn-danger btn-icon-text btn-sm" id="btnDelete" data-code="{{ $record->code ?? '' }}">
          <i class="mdi mdi-delete-forever"></i> លុប
        </button>
        @if($student_picture)
          <img class="btn-Image" id="btn-Image" data-code="{{ $record->code ?? '' }}" src="/uploads/student/{{ $student_picture ?? '' }}" width="100" height="100">
        @else
          <img class="btn-Image" id="btn-Image" data-code="{{ $record->code ?? '' }}" src="/asset/NTTI/images/faces/default_User.jpg" width="100" height="100">
        @endif
      </td>
      <td class="text-center">{{ $record->code ?? '' }}</td>
      <td>{{ $record->name_2 ?? '' }}</td>
      <td>{{ ucwords(strtolower($record->name ?? '')) }}</td>
      <td>{{ $record->gender }}</td>
      <td>{{ $khmerDate }}</td>
      <td>{{ $record->student_address ?? '' }}</td>
      <td>{{ $record->phone_student ?? '' }}</td>
      <td>{{ preg_replace('/[^a-zA-Z0-9]/', '', $record->class_code ?? '') }}</td>
      <td>{{ $record->skill->name_2 ?? '' }}</td>
      <td>{{ $record->qualification ?? '' }}</td>
      <td>{{ $record->section->name_2 ?? '' }}</td>
      <td>{{ $record->mother_name ?? '' }}</td>
      <td>{{ $record->father_name ?? '' }}</td>
      <td>{{ str_replace('_', ' - ', $record->session_year_code ?? '') }}</td>
    </tr>
  @endforeach
@endif
