<style scoped>
    .custom-schedule-wrapper {
        width: 100%;
        max-width: 100vw;
        overflow-x: auto;
        margin-left: auto;
        margin-right: auto;
        page-break-inside: avoid;
        margin-bottom: 5px;
    }

    .custom-schedule-table {
        min-width: 1300px;
        /* For screen: allow scrolling if needed */
        width: auto;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
        table-layout: auto;
        margin-bottom: 5px;
    }

    .custom-schedule-table th,
    .custom-schedule-table td {
        border: 1px solid black;
        padding: 3px 4px;
        text-align: center;
        font-size: 8px;
        vertical-align: middle;
        line-height: 1.2;
    }

    .custom-schedule-table th {
        height: 24px;
        font-weight: normal;
        white-space: nowrap;
        white-space: normal;
        word-break: break-word;
        min-height: 32px;
        height: auto;
        vertical-align: middle;
    }

    .subject-text {
        display: block;
        font-size: 11px;
        line-height: 1.2;
        margin: 2px 0;
        padding: 2px;
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
        word-wrap: break-word;
        white-space: normal;
        hyphens: auto;
        overflow-wrap: break-word;
    }

    .room-text {
        display: block;
        font-size: 10px;
        line-height: 1.3;
        padding: 1px 2px;
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
    }

    .teacher-text {
        font-size: 11px;
        line-height: 1.3;
        display: block;
        padding: 2px;
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
    }

    .time-cell {
        font-size: 10px !important;
        padding: 3px 4px;
        font-family: Arial, sans-serif;
        white-space: nowrap;
        letter-spacing: -0.2px;
    }

    .group-text {
        font-size: 9px !important;
        line-height: 1.3;
        /* padding: 2px 3px; */
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
        font-weight: bold;
        white-space: normal;
        /* Allow wrapping */
        word-break: break-word;
        /* Break long words */
        overflow-wrap: break-word;
        /* Ensure wrapping in all browsers */

    }

    .space-text {
        font-size: 11px !important;
        padding: 2px 2px;
    }



    .custom-schedule-table th.first-column {
        width: 30px;
    }

    .custom-schedule-table th.second-column {
        width: 65px;
    }

    .custom-schedule-table tr {
        height: 24px;
    }

    .subject-cell {
        height: auto;
        min-height: 45px;
        padding: 3px 2px;
        vertical-align: middle;
        word-break: break-word;
    }

    .teacher-cell {
        height: auto !important;
        min-height: 30px;
        padding: 2px 4px !important;
    }

    .teacher-text+.teacher-text {
        margin-top: 1px;
        padding-top: 1px;
    }

    .header-row th {
        padding: 4px 3px;
        font-family: 'Khmer OS Muol Light', Arial, sans-serif;
        font-size: 9px;
    }

    .time-row td {
        font-family: Arial, sans-serif;
        font-size: 8px;
        padding: 2px;
        white-space: nowrap;
    }

    .header-section {
        margin-bottom: 10px;
        /* Reduced margin */
    }

    /* Main container and layout adjustments */
    .main-box {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        page-break-before: auto;
        page-break-after: auto;
        /* margin-bottom: 5mm; */
        /* background-color: green; */
        position: relative;
        margin-top: 5px;
        /* Reduced margin */
    }

    .title-box,
    .sub-title {
        flex: 1;
        height: auto;
        display: flex;
        page-break-inside: avoid !important;

    }

    .title-box {
        text-align: left;
        padding-right: 2mm;
        /* background-color: yellow; */
    }

    .title-box .head-title {
        padding-top: 1rem;
        font-size: 9px;
    }

    .title-box .head-title>span {
        text-decoration: underline;
        font-size: 9px;
    }

    .title-box .head-title .parab-title>p {
        padding-top: 1px;
        text-indent: 25px;
        font-size: 9px;
        margin-bottom: 2px;
    }

    .sub-title {
        display: flex;
        justify-content: flex-end;
        /* background-color: red; */
        padding-bottom: 2rem;
        /* Reduced padding */


    }

    .sub-title>.title-life {
        width: 45%;
        font-size: 10px;

    }

    /* Specific adjustments for print layout */
    .small-width {
        width: 50px;
        min-width: 50px;
        max-width: 50px;
        text-align: center;
        font-size: 8px;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 5mm 5mm;
        }

        .page-break {
            page-break-after: always;
        }
    }

    /* Add new style for handling parentheses in subject names */
    .subject-text br {
        display: none;
    }

    .subject-text span {
        display: block;
        font-size: 7.5px;
        color: #333;
        margin-top: 1px;
    }

    /* Adjust table column widths */
    .custom-schedule-table td {
        width: auto;
        min-width: 80px;
    }

    /* Ensure content fits */
    .custom-schedule-table td>div {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Header text styles */
    .row.align-items-start .KhmerOSMuolLight {
        font-size: 12px;
        line-height: 1.6;
    }

    .row.align-items-start .col-12.text-center.KhmerOSMuolLight {
        font-size: 12px;
        line-height: 1.6;
        margin: 4px 0;
    }

    /* PRINT: Force table to fit page */
    @media print {
        .custom-schedule-wrapper {
            overflow-x: visible !important;
            max-width: 100% !important;
        }

        .custom-schedule-table {
            min-width: 0 !important;
            width: 100% !important;
            table-layout: fixed !important;
            font-size: 8px;
            /* Optional: shrink font for more columns */
        }
    }
</style>

@php
    function toKhmerNumber($number)
    {
        $khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];
        return preg_replace_callback(
            '/\d/',
            function ($matches) use ($khmerDigits) {
                return $khmerDigits[$matches[0]];
            },
            $number,
        );
    }
@endphp

<div id="examsScheduleContainer">
    @if ($is_print ?? '' == 'yes')
        <!-- Header for each class schedule -->
        <br />
        <div class="header-section">
            <div style="position: relative" class="row align-items-start">
                <div class="col-5 text-center KhmerOSMuolLight"><br>
                    ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ<br>
                    វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស
                </div>
                <div class="col-2">

                </div>
                <div class="col-5 text-center KhmerOSMuolLight">
                    ព្រះរាជាណាចក្រកម្ពុជា<br>
                    ជាតិ សាសនា ព្រះមហាក្សត្រ
                </div>
                <div style=" position: absolute; display: flex; justify-content: end; padding-right: 184px; padding-top: 2.4rem;"
                    class="picture">
                    <img width="90px" src="{{ asset('asset/NTTI/images/tacting-image/tacting-image1.png') }}"
                        alt="">
                </div>

            </div>
        </div>
        <br />


        <!-- Header for Exam Schedule -->
        <div class="row align-items-start">
            <div class="col-12 text-center KhmerOSMuolLight">
                តារាងវិភាគប្រឡងឆមាសទី {{ implode(', ', $semesters) }}
                <span class="KhmerOSMuolLight">ឆ្នាំទី </span>
                {{ implode(', ', $years->toArray()) }}
                &nbsp;{{ $session_years_imploded ?? '' }}
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col-12 text-center KhmerOSMuolLight">
                <span class="KhmerOSMuolLight"> ថ្នាក់</span>
                ៖ {{ $header->qualification ?? '' }}
                <span class="KhmerOSMuolLight">ជំនាញ</span>
                {{ implode(', ', $departments->pluck('name_2')->toArray()) }}
                {{-- <span class="KhmerOSMuolLight">ក្រុម</span> --}}
                {{ implode(' , ', $records->pluck('class_code')->unique()->toArray()) }}
                <span class="KhmerOSMuolLight">វេន </span>
                {{ implode(' , ', $records->pluck('section.name_2')->unique()->filter()->toArray()) }}
            </div>
        </div>





        @php
            $totalIndex = 1;
            $totalRecords = $groupedRecords->sum(function ($records) {
                return $records->count();
            });
        @endphp

        <div class="custom-schedule-wrapper">
            <table class="custom-schedule-table">
                <thead>
                    <tr class="header-row">
                        <th class="first-column" style="font-weight: bold;" rowspan="3">ល.រ</th>
                        <th class="second-column" style="font-weight: bold;" rowspan="3">ក្រុម</th>
                        @foreach ($date_name as $dataZ)
                            @php
                                $scheduleDate = $dataZ->date !== 'N/A' ? date('d/m/Y', strtotime($dataZ->date)) : 'N/A';
                            @endphp
                            <th colspan="2" style="font-weight: bold;">
                                {{ $dataZ->name_2 }} ({{ toKhmerNumber($scheduleDate) }})
                            </th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($date_name as $dataZ)
                            <td style="font-size: 11px;">ម៉ោងទី១</td>
                            <td style="font-size: 11px;">ម៉ោងទី២</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php $recordCount = 0; @endphp
                    @foreach ($groupedRecords as $classCode => $classRecords)
                        @foreach ($classRecords as $record)
                            @php
                                $recordCount++;
                                $lines = $groupedLines->get($record->id);

                                if ($recordCount > 2 && $recordCount % 3 == 0):
                                    echo '</tbody></table></div><div class="page-break"></div><div class="custom-schedule-wrapper"><table class="custom-schedule-table"><thead>';
                                    // Repeat the header for the new page
                                    echo '<tr class="header-row">
                                            <th class="first-column" rowspan="3">ល.រ</th>
                                            <th class="second-column" rowspan="3">ក្រុម</th>';
                                    foreach ($date_name as $dataZ) {
                                        $scheduleDate =
                                            $dataZ->date !== 'N/A' ? date('d/m/Y', strtotime($dataZ->date)) : 'N/A';
                                        echo '<th colspan="2" style="font-weight: bold;">' .
                                            $dataZ->name_2 .
                                            ' (' .
                                            $scheduleDate .
                                            ')</th>';
                                    }
                                    echo '</tr><tr>';
                                    foreach ($date_name as $dataZ) {
                                        echo '<td>ម៉ោងទី១</td><td>ម៉ោងទី២</td>';
                                    }
                                    echo '</tr></thead><tbody>';
                                endif;
                            @endphp

                            <!-- Class info and subjects -->
                            <tr>
                                <td rowspan="3" style="font-weight: bold;">{{ toKhmerNumber($recordCount) }}</td>
                                <td rowspan="3" class="group-text" style="text-align: center;">
                                    <div class="space-text">
                                        ឆ្នាំទី {{ $record->years ?? '' }}
                                    </div>
                                    {{-- <div style="margin-bottom: 2px;padding:3px 2px">ក្រុម</div> --}}
                                    <div style="font-size: 11px;padding: 3px 2px">{{ $record->class_code }}</div>
                                </td>

                                @foreach ($date_name as $dataZ)
                                    @php
                                        $firstSchedule = $lines
                                            ?->where('date_name_code', strtolower(trim($dataZ->code)))
                                            ->where('is_second_schedule', 0)
                                            ->first();
                                        $secondSchedule = $lines
                                            ?->where('date_name_code', strtolower(trim($dataZ->code)))
                                            ->where('is_second_schedule', 1)
                                            ->first();

                                        // Format first schedule time
                                        if ($firstSchedule && $firstSchedule->start_time) {
                                            $firstStartTime = date('g:i', strtotime($firstSchedule->start_time));
                                            $firstEndTime = date('g:i', strtotime($firstSchedule->end_time));
                                            $firstTime = $firstStartTime . '-' . $firstEndTime . 'AM';
                                        } else {
                                            $firstTime = 'N/A';
                                        }

                                        // Format second schedule time
                                        if ($secondSchedule && $secondSchedule->start_time) {
                                            $secondStartTime = date('g:i', strtotime($secondSchedule->start_time));
                                            $secondEndTime = date('g:i', strtotime($secondSchedule->end_time));
                                            $secondTime = $secondStartTime . '-' . $secondEndTime . 'AM';
                                        } else {
                                            $secondTime = 'N/A';
                                        }
                                    @endphp
                                    <td class="time-cell">{{ $firstTime }}</td>
                                    <td class="time-cell">{{ $secondTime }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($days as $day)
                                    @php
                                        $firstSchedule = $lines
                                            ?->where('date_name_code', $day)
                                            ->where('is_second_schedule', 0)
                                            ->first();
                                        $secondSchedule = $lines
                                            ?->where('date_name_code', $day)
                                            ->where('is_second_schedule', 1)
                                            ->first();
                                    @endphp
                                    <td class="teacher-cell">
                                        <span class="teacher-text">{{ $firstSchedule->teacher->name_2 ?? '' }}</span>
                                        @if ($firstSchedule && ($firstSchedule->coTeacher || $firstSchedule->coTeacher1))
                                            <span class="teacher-text">
                                                @if ($firstSchedule->coTeacher)
                                                    {{ $firstSchedule->coTeacher->name_2 ?? '' }}
                                                @endif
                                                @if ($firstSchedule->coTeacher && $firstSchedule->coTeacher1)
                                                    ,
                                                @endif
                                                @if ($firstSchedule->coTeacher1)
                                                    {{ $firstSchedule->coTeacher1->name_2 ?? '' }}
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="teacher-cell">
                                        <span class="teacher-text">{{ $secondSchedule->teacher->name_2 ?? '' }}</span>
                                        @if ($secondSchedule && ($secondSchedule->coTeacher || $secondSchedule->coTeacher1))
                                            <span class="teacher-text">
                                                @if ($secondSchedule->coTeacher)
                                                    {{ $secondSchedule->coTeacher->name_2 ?? '' }}
                                                @endif
                                                @if ($secondSchedule->coTeacher && $secondSchedule->coTeacher1)
                                                    ,
                                                @endif
                                                @if ($secondSchedule->coTeacher1)
                                                    {{ $secondSchedule->coTeacher1->name_2 ?? '' }}
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                @foreach ($days as $day)
                                    @php
                                        $firstSchedule = $lines
                                            ?->where('date_name_code', $day)
                                            ->where('is_second_schedule', 0)
                                            ->first();
                                        $secondSchedule = $lines
                                            ?->where('date_name_code', $day)
                                            ->where('is_second_schedule', 1)
                                            ->first();
                                    @endphp
                                    <td class="subject-cell">
                                        @if ($firstSchedule)
                                            <span class="subject-text">
                                                @php
                                                    $subjectName = $firstSchedule->subject->name_2 ?? '';
                                                    // Check if the subject name contains parentheses
                                                    if (strpos($subjectName, '(') !== false) {
                                                        // Split the main text and the part in parentheses
                                                        $parts = explode('(', $subjectName);
                                                        echo trim($parts[0]);
                                                        if (isset($parts[1])) {
                                                            echo '<span>(' . trim($parts[1]);
                                                        }
                                                    } else {
                                                        echo $subjectName;
                                                    }
                                                @endphp
                                            </span>
                                            <span class="room-text">បន្ទប់ {{ $firstSchedule->room ?? '' }}</span>
                                        @endif
                                    </td>
                                    <td class="subject-cell">
                                        @if ($secondSchedule)
                                            <span class="subject-text">
                                                @php
                                                    $subjectName = $secondSchedule->subject->name_2 ?? '';
                                                    // Check if the subject name contains parentheses
                                                    if (strpos($subjectName, '(') !== false) {
                                                        // Split the main text and the part in parentheses
                                                        $parts = explode('(', $subjectName);
                                                        echo trim($parts[0]);
                                                        if (isset($parts[1])) {
                                                            echo '<span>(' . trim($parts[1]);
                                                        }
                                                    } else {
                                                        echo $subjectName;
                                                    }
                                                @endphp
                                            </span>
                                            <span class="room-text">បន្ទប់ {{ $secondSchedule->room ?? '' }}</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($totalRecords > 3)
            <!-- Remove this page break since we're handling it in the loop -->
        @endif

        <div class="row align-items-start">
            <div class="col-12 main-box text-center KhmerOSMuolLight">
                <div class="title-box">
                    <div class="head-title">
                        ***<span>កំណត់សម្គាល់</span>
                        <div class="parab-title">
                            <p>មុខវិជ្ជាទ្រឹស្តីប្រលងរយះពេល1ម៉ោង30នាទី</p>
                            <p>មុខវិជ្ជាទាក់ទង Computer ប្រលងតាមម៉ោងជាក់ស្តែង</p>
                            <p>សាស្រ្តាចារ្យបង្រៀនត្រូវផ្តល់វិញ្ញាសាតាមមុខវិជ្ជាបានមុនថ្ងៃទី៣ ខែមករា ឆ្នាំ២០២៥</p>
                            <p>និស្សិតម្នាក់ត្រូវស្លៀកពាក់ឯកសណ្ជានបានត្រឹមត្រូវនិងមានកាតសម្គាល់ខ្លួននិស្សិត។</p>
                        </div>
                    </div>
                </div>
                <div class="sub-title">
                    <div class="col-4 title-life text-center khmer_os_b" style=" width: 52%;margin-right: 12px">
                        <div style="width: 100%; margin-bottom: 10px;">
                            @if (empty($record->examDateKhmer->date_khmer))
                                <span>ថ្ងៃ....................</span>
                                <span>ខែ....................</span>
                                <span>ឆ្នាំ....................</span>
                                <p style="font-size: 10px;">ត្រូវនិងថ្ងៃទី.................................</p>
                            @else
                                {{ $record->examDateKhmer->date_khmer }}
                            @endif
                        </div>
                        <div class="KhmerOSMuolLight">នាយកវិទ្យាស្ថាន</div>
                    </div>
                </div>
            </div>
            <div class="col-2"></div>
        </div>

    @endif
</div>
