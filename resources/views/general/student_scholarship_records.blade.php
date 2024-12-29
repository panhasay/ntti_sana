
@foreach ($records as $record)
  <?php 
      $skills = DB::table('skills')->where('code',$record->skills_code)->value('name_2');
      $classes = DB::table('student')->where('code',$record->code)->value('class_code');
      $section =  DB::table('sections')->where('code',$record->sections_code)->value('name_2');
      $department = DB::table('department')->where('code',$record->department_code)->value('name_2');
      $date = $record->date_of_birth;
      $khmerDate = App\Service\service::DateYearKH($date);
      $postingDate = $record->posting_date;
      $year_student = App\Service\service::calculateDateDifference($postingDate);
  ?>
  <tr id="row{{$record->code}}">
    <td height="35">{{ $record->name_2 }}</td>
    <td>{{ $record->name ?? '' }}</td>
    <td>{{ $record->gender ?? ''}}</td>
    <td>{{ $khmerDate ?? ''}}</td>
    <td>{{ $record->student_address ?? ''}}</td>
    <td class="text-center">
      @if($record->bakdop_results != '')
        {{ $record->bakdop_results ?? ''}}
      @else
        ផ្សេងៗ
      @endif
    </td>
    <td class="text-center">{{ $record->bakdop_index ?? ''}}</td>
    <td>{{ $record->bakdop_type ?? ''}}</td>
    <td>{{ $record->phone_student ?? ''}}</td>
    <td>{{ $section  ?? ''}}</td>
    <td>{{ $record->class_code  ?? ''}}</td>
    <td>{{ $skills ?? ''}}</td>
    <td class="text-center">{{ $record->scholarship ?? '' }}</td>
    <td>{{ $record->scholarship_type ?? ''}}</td>
    <td>{{ $record->submit_your_application ?? '' }}</td>
    {{-- <td>{{ $record->session_year->name ?? ''}}</td> --}}
  </tr>
@endforeach

 

