<style>
  .report-table {
    width: 100%;
    border-collapse: collapse;
    margin: 17px 0;
    font-size: 14px;
  }

  .report-table th,
  .report-table td {
    border: 1px solid #ccc;
  }

  .report-table th {
    background-color: #f2f2f2;
  }

  .report-table tfoot td {
    font-weight: bold;
    background-color: #e6ffe6;
  }

  .signature-section {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
  }

  .signature-section div {
    text-align: left;
    width: 40%;
  }

  .group-by>td {
    /* text-align: left !important; */
    font-weight: bold;
    padding: 7px;
  }

  .general>td {
    /* text-align: left !important; */
  }
</style>

<div class="control-table">
  <table class="report-table">
    <thead>
      <tr style="">
        <th width="50" class="text-center">ល.រ</th>
        <th class="text-left" width="20">អត្តលេខ</th>
        <th class="text-left" width="30">គោត្តនាម និងនាម</th>
        <th class="" width="30">ឈ្មោះជាឡាតាំង</th>
        <th class="text-center" width="10">ភេទ</th>
        @if(count($records) > 0)
        @foreach ($records as $subjest)
        <th class="text-center rotated_cell" width="150">
          <div class='rotate_text'>{{ $subjest->subject->name ?? '' }}</div>
        </th>
        @endforeach
        @php
        $emptyColumns = 7 - count($records);
        @endphp
        @for ($i = 0; $i < $emptyColumns; $i++) <th class="text-center rotated_cell" width="100">
          <div class='rotate_text'>&nbsp;</div>
          </th>
          @endfor
          @endif
          <th width="20" class="text-center rotated_cell">
            <div class='rotate_text'>មធ្យមភាគ</div>
          </th>
          <th width="20" class="text-center rotated_cell">
            <div class='rotate_text'>ចំណាត់ថ្នាក់</div>
          </th>
      </tr>
    </thead>
    <tbody id="">
      <?php $index = 1; $rank = 1; ?>
      <?php
          // First Pass: Gather all student averages
          $studentsScores = [];
          $total_subject = count($records); // Assuming $records is the list of subjects
          foreach ($lines as $line) {
              $grand_total_score = 0;

              foreach ($records as $subject) {
                  $total_score = 0;
                  $scourses = App\Models\General\AssingClassesStudentLine::selectRaw("student_code, attendance, assessment, midterm, final")
                      ->where('assing_line_no', $subject->assing_no)
                      ->where('student_code', $line->student->code)
                      ->first();

                  if ($scourses) {
                      $total_score = ($scourses->attendance ?? 0) + ($scourses->assessment ?? 0) + ($scourses->midterm ?? 0) + ($scourses->final ?? 0);
                  }
                  $grand_total_score += $total_score;
              }

              // Calculate average score for the student
              $average_student = $total_subject > 0 ? $grand_total_score / $total_subject : 0;
              
              // Store student code and their average score
              $studentsScores[] = [
                  'student' => $line->student->code,
                  'average' => $average_student
              ];
          }
          // Second Pass: Sort and Rank students based on average
          usort($studentsScores, function($a, $b) {
              return $b['average'] <=> $a['average']; // Sort in descending order (from highest to lowest average)
          });
          $rank = 1;
          foreach ($studentsScores as $index => &$studentData) {
              if ($index > 0 && $studentData['average'] == $studentsScores[$index - 1]['average']) {
                  $studentData['rank'] = $studentsScores[$index - 1]['rank'];
              } else {
                  $studentData['rank'] = $rank;
              }
              $rank++;
          }
          usort($studentsScores, function($a, $b) {
              return $a['rank'] <=> $b['rank']; 
          });
          $studentsRanked = collect($studentsScores)->keyBy('student');
          $no = 1;
      ?>
      <!-- Output Data Sorted by Rank -->
      @foreach ($studentsRanked as $studentCode => $studentData)
      @php
      $line = $lines->firstWhere('student.code', $studentCode);
      @endphp
      <tr class="recordsLineTableBody">
        <td class="text-center">{{ $no++ }}</td>
        <td class="text-center">{{ $line->student->code ?? '' }}</td>
        <td>{{ $line->student->name_2 ?? '' }}</td>
        <td>{{ $line->student->name ?? '' }}</td>
        <td class="text-center">{{ $line->student->gender ?? '' }}</td>

        @if(count($records) > 0)
        <?php
                      $grand_total_score = 0;
                  ?>
        @foreach ($records as $subject)
        <?php
                          $total_score = 0;
                          $scourses = App\Models\General\AssingClassesStudentLine::selectRaw("student_code, attendance, assessment, midterm, final")
                              ->where('assing_line_no', $subject->assing_no)
                              ->where('student_code', $line->student->code)
                              ->first();

                          if ($scourses) {
                              $total_score = ($scourses->attendance ?? 0) + ($scourses->assessment ?? 0) + ($scourses->midterm ?? 0) + ($scourses->final ?? 0);
                          }

                          $grand_total_score += $total_score;
                      ?>
        @if($total_score > 50)
        <th class="text-center" width="150">{{ $total_score }} </th>
        @else
        <th class="text-center" width="150" style="background: rgb(98, 96, 96)">{{ $total_score }}</th>
        @endif

        @endforeach
        <?php
                      // Calculate the student's average score again
                      $average_student = $total_subject > 0 ? $grand_total_score / $total_subject : 0;
                  ?>
        @endif
        <?php $emptyColumns = 7 - count($records); ?>
        @for ($i = 0; $i < $emptyColumns; $i++) <th class="text-center" width="150">&nbsp;</th>
          @endfor
          <td class="text-center">{{ number_format($average_student, 2) }} </td>
          <td class="text-center">{{ $studentData['rank'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>


</div>