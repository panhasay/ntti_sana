
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
      <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'student/transaction?type=ed&code='.\App\Service\service::Encr_string($record->code) }}"><i class="mdi mdi-border-color"></i> Edit</a>
      <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->code ?? '' }}"><i class="mdi mdi-delete-forever"></i>  Delete</button>
      
      @if($picture != null)
        <img class="btn-Image" id="btn-Image" data-code ='{{$record->code ?? ''}}' src="{{ $picture ?? '' }}" width="1000" height="1000">
      @else
        <img class="btn-Image" id="btn-Image" data-code ='{{$record->code ?? ''}}' src="asset/NTTI/images/faces/default_User.jpg" width="1000" height="1000">
      @endif
    </td>
    <td class="text-center">
        <a href="{{ url('dahhboard-student-account') }}?code={{ $record->code ?? '' }}">
            {{ $record->code ?? '' }}
        </a>
    </td>
    <td> {{ $record->name ?? ''}}</td>
    <td>{{ $record->name_2 ?? ''}}</td>
    <td>{{ $record->gender ?? ''}}</td>
    <td >{{ $khmerDate ?? ''}}</td>
    <td class="text-center">{{ $record->phone_student ?? ''}}</td>
    <td>{{ $classes ?? ''}}</td>
    <td>{{ $skills ?? ''}}</td>
    <td>{{ $department ?? ''}}</td>
    <td class="text-right">
      <label class="badge {{ $record->status == 'no' ? 'badge-danger' : 'badge-success' }} btn-sm mb-2 mb-md-0 me-2">
        {{ $record->status ?? '' }}
      </label>
    </td>
  </tr>
@endforeach
 

