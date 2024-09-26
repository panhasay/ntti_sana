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
                    return $a['rank'] <=> $b['rank']; // Sort in ascending order (from lowest to highest rank)
                });
                // Convert studentsScores array into an easily accessible format by student code
                $studentsRanked = collect($studentsScores)->keyBy('student');
            ?>
            <!-- Output Data Sorted by Rank -->
            @foreach ($studentsRanked as $studentCode => $studentData)
                <!-- Find the student line with the student code -->
                @php
                    $line = $lines->firstWhere('student.code', $studentCode);
                @endphp

                <tr>
                    <td class="text-center">{{ $studentData['rank'] }}</td>
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
                    <td class="text-center">{{ $average_student }}</td>
                    <td class="text-center">{{ $studentData['rank'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
