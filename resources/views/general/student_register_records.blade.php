
@foreach ($records as $record)
  <?php 
      $skills = DB::table('skills')->where('code',$record->skills_code)->value('name_2');
      $classes = DB::table('classes')->where('code',$record->class_code)->value('name');
      $section =  DB::table('sections')->where('code',$record->sections_code)->value('name_2');
      $gender = ($record->gender == 'male') ? 'ប្រុស' : 'ស្រី';
      $department = DB::table('department')->where('code',$record->department_code)->value('name_2');
      $date = $record->date_of_birth;
      $khmerDate = App\Service\service::convertToKhmerDate($date);
      $postingDate = $record->posting_date;
      $year_student = App\Service\service::calculateDateDifference($postingDate);
      $picture =  App\Models\General\Picture::where('code', $record->code)->where('type','student')->value('picture_ori');
  ?>
  <tr id="row{{$record->code}}">
    <td>
      <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'registration/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code) }}"><i class="mdi mdi-border-color"></i> Edit</a>
    </td>
    <td class="text-center"> {{ $record->code ?? '' }}</td>
    <td> {{ $record->name ?? ''}}</td>
    <td>{{ $record->name_2 ?? ''}}</td>
    <td>{{ $record->gender ?? ''}}</td>
    <td >{{ $khmerDate ?? ''}}</td>
    <td class="text-center">{{ $record->phone_student ?? ''}}</td>
    <td>{{ $skills ?? ''}}</td>
    <td>{{ $record->qualification ?? ''}}</td>
  </tr>
@endforeach
 

