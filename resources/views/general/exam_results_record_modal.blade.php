
<style>
    .table th, .table td {
        vertical-align: middle;
        font-size: 0.875rem;
        line-height: 1;
        white-space: nowrap;
        font-family: 'Khmer OS Battambang';
        padding: 10px !important;
    }
    .table > :not(:last-child) > :last-child > *, .jsgrid .jsgrid-table > :not(:last-child) > :last-child > * {
        font-family: 'Khmer OS Battambang';
        font-weight: 600;
    }
</style>
@if(isset($is_print) && $is_print == "Yes")
    <style>
        @media print {
            @page {
                size: A4;
                margin: 9mm;
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
            .rotate_text {
                writing-mode: vertical-lr;
                -webkit-writing-mode: vertical-lr;
                -ms-writing-mode: vertical-lr;
                -webkit-transform: rotate(-180deg);
                -moz-transform: rotate(-180deg);
                -o-transform: rotate(-180deg);
                transform: rotate(-180deg);
            }
            .rotated_cell {
                text-align: right;
                vertical-align: bottom;
                padding: 1px;
                padding-bottom: 10px;
                padding-top: 20px;
            }
            td, th {border: 1px solid #333;
                padding: 3;
                font-family: 'Khmer OS Battambang';
                vertical-align: middle;
                white-space: nowrap;
            }
            .table {
                border-right: thin dashed grey;
                border-bottom: thin dashed grey;
            }
            .table> :not(:last-child)> :last-child>*,
            .jsgrid .jsgrid-table> :not(:last-child)> :last-child>* {
                font-family: 'Khmer OS Battambang';
                border: 1px solid #b3b3b3;
                font-weight: bold;
            }
            .form-control-line {
                border: 1px solid #e4e9f0;
                font-family: "Open Sans", sans-serif;
                font-weight: 400;
                font-size: 0.8125rem;
                height: 31px;
                font-family: 'Khmer OS Battambang';
                text-align: center;
            }
            .table th,
            .table td {
                vertical-align: middle;
                font-size: 0.875rem;
                line-height: 1;
                white-space: nowrap;
                font-family: 'Khmer OS Battambang';
                padding: 1px;
            }
            .KhmerOSMuolLight {
                font-family: 'Khmer OS Muol Light';
            }
        }
    </style>
    <div class="row align-items-start">
        <div class="col-5 text-center KhmerOSMuolLight"><br>
        វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស
        ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា
        </div>
    <div class="col-2">
        </div>
        <div class="col-5 text-center KhmerOSMuolLight">
        ព្រះរាជាណាចក្រកម្ពុជា
        ជាតិ សាសនា ព្រះមហាក្សត្រ
        </div>
    </div><br>
    <div class="row align-items-start">
        <div class="col-12 text-center KhmerOSMuolLight">
        លទ្ធផលប្រឡងឆមាសទី {{ $header->semester ?? '' }} ឆ្នាំទី {{ $header->years ?? '' }} ​​ឆ្នាំសិក្សា {{ $header->session_year_code ?? '' }} តារាងពិន្ទុ ក្រុម {{ $header->class_code ?? ''}}
        </div>
    </div>
  <div class="row align-items-start">
    <div class="col-12 text-center KhmerOSMuolLight">
      ថ្នាក់ {{ $header->qualification ?? '' }} ជំនាញ {{ $header->skill->name_2 ?? '' }} ក្រុម {{ $header->class_code ?? '' }} វេន​  {{ $header->section->name_2 ?? '' }}
    </div>
  </div><br>
    <div class="control-table table-responsive custom-data-table-wrapper2">
        <table class="table-striped">
            <thead>
                <tr style="">
                    <th width="50" class="text-center" >ល.រ</th>
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
                        @for ($i = 0; $i < $emptyColumns; $i++)
                            <th class="text-center rotated_cell" width="100">
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
                        @for ($i = 0; $i < $emptyColumns; $i++)
                            <th class="text-center" width="150">&nbsp;</th>
                        @endfor
                        <td class="text-center">{{ number_format($average_student, 2) }} </td>
                        <td class="text-center">{{ $studentData['rank'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row align-items-start mt-5">
            <div class="col-5 text-center KhmerOSMuolLight"><br><br><br>
                បានឃើញនិងឯកភាព<br />
                នារយករងសិក្សា
            </div>
        <div class="col-1">
            </div>
                <div class="col-6 text-center khmer_os_b">
                    {{ App\Service\service::updateDateTime() ?? ''}}
                    <div class="KhmerOSMuolLight">ប្រធានដេប៉ាដេម៉ង</div>
                </div>
        </div><br>
    </div>
@else
    <div class="control-table table-responsive custom-data-table-wrapper2">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="50" class="text-center" >ល.រ</th>
                    <th class="text-left" width="20">អត្តលេខ</th>
                    <th class="text-left" width="30">គោត្តនាម និងនាម</th>
                    <th class="" width="30">ឈ្មោះជាឡាតាំង</th>
                    <th class="text-center" width="10">ភេទ</th>
                    @if(count($records) > 0)
                        @foreach ($records as $subjest)
                            <th class="text-center rotate" width="150">{{ $subjest->subject->name ?? '' }}</th>
                        @endforeach
                        @php
                            $emptyColumns = 7 - count($records);
                        @endphp
                        @for ($i = 0; $i < $emptyColumns; $i++)
                            <th class="text-center" width="100">&nbsp;</th>
                        @endfor
                    @endif
                    <th width="20" class="text-center">មធ្យមភាគ</th>
                    <th width="20" class="text-center">ចំណាត់ថ្នាក់</th>
                </tr>
            </thead>
            <tbody id="recordsLineTableBody">
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
                    <tr>
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
                                <th class="text-center" width="150">{{ $total_score }}</th>
                            @endforeach
                            <?php
                                // Calculate the student's average score again
                                $average_student = $total_subject > 0 ? $grand_total_score / $total_subject : 0;
                            ?>
                        @endif
                        <?php $emptyColumns = 7 - count($records); ?>
                        @for ($i = 0; $i < $emptyColumns; $i++)
                            <th class="text-center" width="150">&nbsp;</th>
                        @endfor
                        <td class="text-center">{{ number_format($average_student, 2) }} </td>
                        <td class="text-center">{{ $studentData['rank'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
