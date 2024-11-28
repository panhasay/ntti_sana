
<div class="row">
  <table>
    <tr>
      <th colspan="6"><img src="asset/NTTI/images/logo.png" alt="logo"></th>
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="6">ព្រះរាជាណាចក្រកម្ពុជា <br> ជាតិ សាសនា ព្រះមហាក្សត</th>
    </tr>
    <tr>
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="12"> </th>
    </tr>
    <tr>
      <th style="font-weight: 700; font-family: Moul, serif !important;" colspan="12">filter : {{ $department ?? '' }} {{'ជំនាញ'. $skills ?? '' }} {{ 'វេន'. $sections ?? '' }}</th>
    </tr>
  </table>
</div>
<div class="control-table table-responsive custom-data-table-wrapper2">
  <table class="table table-striped">
    <thead>
      <tr class="general-data">
        <th style="font-weight: 700" width="10">អត្តលេខ</th>
        <th style="font-weight: 700" width="20">គោត្តនាម និងនាម</th>
        <th style="font-weight: 700" width="20">ឈ្មោះជាឡាតាំង</th>
        <th style="font-weight: 700" width="10">ភេទ</th>
        <th style="font-weight: 700" width="20">ថ្ងៃខែឆ្នាំកំណើត</th>
        <th style="font-weight: 700" width="50">ទីកន្លែងកំណើត</th>
        <th style="font-weight: 700" width="20">លេខទូរស័ព្ទ</th>
        <th style="font-weight: 700" width="20">ជំនាញ</th>
        <th style="font-weight: 700" width="20">កម្រិត</th>
        <th style="font-weight: 700" width="20">វេនសិក្សា</th>
        <th style="font-weight: 700" width="20">ឈ្មោះម្ដាយ</th>
        <th style="font-weight: 700" width="20">ឈ្មោះឪពុក</th>
        <th style="font-weight: 700" width="20">ឆ្នាំសិក្សា</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($records as $record)
      <?php 
              $skills = DB::table('skills')->where('code',$record->skills_code)->value('name_2');
              $classes = DB::table('classes')->where('code',$record->class_code)->value('name');
              $section =  DB::table('sections')->where('code',$record->sections_code)->value('name_2');
              $gender = ($record->gender == 'male') ? 'ប្រុស' : 'ស្រី';
              $department = DB::table('department')->where('code',$record->department_code)->value('name_2');
              $date = $record->date_of_birth;
              $khmerDate = App\Service\service::DateFormartKhmer($date);
              $postingDate = $record->posting_date;
              $year_student = App\Service\service::calculateDateDifference($postingDate);
              $picture =  App\Models\General\Picture::where('code', $record->code)->where('type','student')->value('picture_ori');
          ?>
      <tr id="row{{$record->code}}">
        <td class="text-center"> {{ $record->code ?? '' }}</td>
        <td>{{ $record->name_2 ?? ''}}</td>
        <td> {{ $record->name ?? ''}}</td>
        <td>{{ $record->gender ?? ''}}</td>
        <td>{{ $khmerDate ?? ''}}</td>
        <td>{{ $record->student_address ?? ''}}</td>
        <td>{{ $record->phone_student ?? ''}}</td>
        <td>{{ $skills ?? ''}}</td>
        <td>{{ $record->qualification ?? ''}}</td>
        <td>{{ $section ?? ''}}</td>

        <td>{{ $record->mother_name ?? ''}}</td>
        <td>{{ $record->father_name ?? ''}}</td>
        <td>{{ $record->session_year->name ?? ''}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$records->links("pagination::bootstrap-4")}}
</div><br><br>