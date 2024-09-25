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
            <?php $index = 1; ?>
            @foreach ($lines as $line)
                <tr>
                    <td class="text-center">{{ $index++ }}</td>
                    <td class="text-center">{{ $line->student->code ?? ''}}</td>
                    <td>{{ $line->student->name_2 ?? ''}}</td>
                    <td>{{ $line->student->name ?? ''}}</td>
                    <td class="text-center">{{ $line->student->gender ?? ''}}</td>
                    @if(count($records) > 0)
                    <?php 
                        $grand_total_score = 0; 
                        $total_subject = count($records); 
                        $rating_student = 0;
                    ?>
                        @foreach ($records as $subjest)
                            <?php 

                                $scourses_s = App\Models\General\AssingClassesStudentLine::selectRaw("student_code, final")->where('assing_line_no', $subjest->assing_no)->where('student_code', $line->student->code)->first();
                                $scourses = App\Models\General\AssingClassesStudentLine::where('assing_line_no', $subjest->assing_no)->where('student_code', $line->student->code)->first();
                                if ($scourses) {
                                    $total_score = ($scourses->attendance ?? 0) + ($scourses->assessment ?? 0) +  ($scourses->midterm ?? 0) + ($scourses->final ?? 0);
                                } else {
                                    $total_score = 0; 
                                }

                                $grand_total_score += $total_score;
                                $string = $grand_total_score / $total_subject;
                                $array = explode(' ', $string);

// Sort the array in descending order
rsort($array);

// Format each number with square brackets
$formatted_array = array_map(function($num) {
    return "[$num]";
}, $array);

// Output the average score and the formatted array
echo "Average Score: [$average_score]\n";
echo implode(" ", $formatted_array);                 
                            ?>  
                            <th class="text-center" width="150">{{ $total_score ?? '' }}</th>
                        @endforeach
                        @php
                            $emptyColumns = 7 - count($records);
                        @endphp
                        @for ($i = 0; $i < $emptyColumns; $i++)
                            <th class="text-center" width="150">&nbsp;</th>
                        @endfor
                    @endif
                    <td class="text-center">{{ $grand_total_score / $total_subject}}</td>
                    <td class="text-center">{{ $rating_student ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
