@if(count($records) > 0)
  @foreach ($records as $record)
    <?php 
        $gender = ($record->gender == 'male') ? 'ប្រុស' : 'ស្រី';
        $khmerDate = !empty($record->date_of_birth) ? App\Service\service::DateYearKH($record->date_of_birth) : '';
    ?>
    <tr id="row{{$record->code}}">
      <td>
        <a class="btn btn-primary btn-icon-text btn-sm" href="{{ 'registration/transaction?type=ed&code=' . \App\Service\service::Encr_string($record->code) }}">
          <i class="mdi mdi-border-color"></i> កែប្រែ
        </a>
        <button class="btn btn-danger btn-icon-text btn-sm" id="btnDelete" data-code="{{ $record->code ?? '' }}">
          <i class="mdi mdi-delete-forever"></i> លុប
        </button>
        @if($record->student_picture)
          <img class="btn-Image" id="btn-Image" data-code="{{ $record->code ?? '' }}" src="/uploads/student/{{ $record->student_picture }}" width="100" height="100">
        @else
          <img class="btn-Image" id="btn-Image" data-code="{{ $record->code ?? '' }}" src="/asset/NTTI/images/faces/default_User.jpg" width="100" height="100">
        @endif
      </td>
      <td class="text-center">{{ $record->code ?? '' }}</td>
      <td>{{ $record->name_2 ?? '' }}</td>
      <td>{{ ucwords(strtolower($record->name ?? '')) }}</td>
      <td>{{ $gender }}</td>
      <td>{{ $khmerDate }}</td>
      <td>{{ $record->student_address ?? '' }}</td>
      <td>{{ $record->phone_student ?? '' }}</td>
      <td>{{ $record->class_code ?? '' }}</td>
      <td>{{ $record->skills_name ?? '' }}</td>
      <td>{{ $record->qualification ?? '' }}</td>
      <td>{{ $record->section_name ?? '' }}</td>
      <td>{{ $record->mother_name ?? '' }}</td>
      <td>{{ $record->father_name ?? '' }}</td>
      <td>{{ $record->session_year_name ?? '' }}</td>
    </tr>
  @endforeach
@endif
