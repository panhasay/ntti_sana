
@foreach ($records as $record)
  <tr id="row{{$record->code}}">
    <td>
      <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'registration/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code) }}"><i class="mdi mdi-border-color"></i> Edit</a>
      <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->code ?? '' }}"><i class="mdi mdi-delete-forever"></i>  Delete</button>
    </td>
    <td class="text-center"> {{ $record->code ?? '' }}</td>
    <td>{{ $record->name_2 ?? ''}}</td>
    <td> {{ $record->name ?? ''}}</td>
    <td>{{ $record->gender ?? ''}}</td>
    <td >{{ App\Service\service::DateYearKH($record->date_of_birth) ?? '' }}</td>
    <td>{{ $record->student_address ?? ''}}</td>
    <td >{{ $record->phone_student ?? ''}}</td>
    <td>{{ $classes ?? ''}}</td>
    <td>{{ $record->skill->name_2 ?? ''}}</td>
    <td>{{ $record->qualification ?? ''}}</td>
    <td>{{ $record->section->name_2 ?? ''}}</td>
    
    <td>{{ $record->mother_name ?? ''}}</td>
    <td>{{ $record->father_name ?? ''}}</td>
    <td>{{ $record->session_year->name ?? ''}}</td>
  </tr>
@endforeach

 

