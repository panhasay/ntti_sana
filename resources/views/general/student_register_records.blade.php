
@foreach ($records as $record)
  <?php 
      $skills = DB::table('skills')->where('code',$record->skills_code)->value('name_2');
      $classes = DB::table('student')->where('code',$record->code)->value('class_code');
      $section =  DB::table('sections')->where('code',$record->sections_code)->value('name_2');
      $gender = ($record->gender == 'male') ? 'ប្រុស' : 'ស្រី';
      $department = DB::table('department')->where('code',$record->department_code)->value('name_2');
      $date = $record->date_of_birth;
      $khmerDate = App\Service\service::DateYearKH($date);
      $postingDate = $record->posting_date;
      $year_student = App\Service\service::calculateDateDifference($postingDate);
      $picture =  App\Models\General\Picture::where('code', $record->code)->where('type','student')->value('picture_ori');
    

  ?>
  <tr id="row{{$record->code}}">
    <td>
      <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'registration/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code) }}"><i class="mdi mdi-border-color"></i> Edit</a>
      <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->code ?? '' }}"><i class="mdi mdi-delete-forever"></i>  Delete</button>
    </td>
    <td class="text-center"> {{ $record->code ?? '' }}</td>
    <td>{{ $record->name_2 ?? ''}}</td>
    <td>{{ ucwords(strtolower($record->name ?? '')) }} </td>
    <td>{{ $record->gender ?? ''}}</td>
    <td >{{ $khmerDate ?? ''}}</td>
    <td>{{ $record->student_address ?? ''}}</td>
    <td >{{ $record->phone_student ?? ''}}</td>
    <td>{{ $record->class_code ?? ''}}</td>
    <td>{{ $skills ?? ''}}</td>
    <td>{{ $record->qualification ?? ''}}</td>
    <td>{{ $section ?? ''}}</td>
    
    <td>{{ $record->mother_name ?? ''}}</td>
    <td>{{ $record->father_name ?? ''}}</td>
    <td>{{ $record->session_year->name ?? ''}}</td>
  </tr>
@endforeach

 

