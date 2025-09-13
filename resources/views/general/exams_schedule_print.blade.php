<style scoped>
    /* Page setup and margins */
    /* @page {
        size: A4 landscape;
        margin: 15mm 20mm;
    } */

    /* Table styling with compact spacing */
    .single-custom-schedule-wrapper {
        margin-top: 7px;
        width: 100%;
    }

    .single-custom-schedule-table {
        width: 100% !important;
        border-collapse: collapse;
        table-layout: fixed;
        margin-bottom: 5px;
        height: 150px;
        margin-top: 12px;
    }

    .single-custom-schedule-table th,
    .single-custom-schedule-table td {
        border: 1px solid black;
        padding: 3px 4px;
        text-align: center;
        font-size: 12px;
        vertical-align: middle;
        line-height: 1.3;
        box-sizing: border-box;
    }

    .single-custom-schedule-table th {
        height: 32px;
        font-weight: bold;
        white-space: nowrap;
        font-size: 12px;
    }

    .single-subject-text {
        display: block;
        font-size: 10px;
        line-height: 1.1;
        margin: 1px 0;
        padding: 1px;
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
        /* Keep whole words together; wrap only at spaces */
        white-space: normal;
        word-break: keep-all;
        word-wrap: normal;
        overflow-wrap: normal;
        hyphens: none;
        /* Prevent any word breaking */
        -webkit-hyphens: none;
        -ms-hyphens: none;
        /* font-weight: bold; */
    }

    .single-room-text {
        display: block;
        font-size: 11px;
        line-height: 1.3;
        padding: 1px 2px;
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
    }

    .single-teacher-text {
        font-size: 11px;
        line-height: 1.3;
        display: block;
        padding: 2px;
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
    }

    .single-time-cell {
        font-size: 10px;
        padding: 3px 4px;
        font-family: Arial, sans-serif;
        white-space: nowrap;
        letter-spacing: -0.2px;
    }

    .single-group-text {
        font-size: 9px;
        line-height: 1.2;
        padding: 2px 3px;
        font-family: 'Khmer OS Siemreap', Arial, sans-serif;
        font-weight: bold;
        text-align: center;
    }

    .single-space-text {
        margin-bottom: 4px;
    }

    .single-custom-schedule-table th.first-column {
        width: 3%;
        min-width: 35px;
    }

    /* Remove second column since we're combining it with first column */
    /* .single-custom-schedule-table th.second-column {
        width: 1.5%;
        min-width: 15px;
    } */

    /* Make day columns equal width - now they get even more space */
    .single-custom-schedule-table th:not(.first-column) {
        width: calc((100% - 3%) / 12);
        /* 12 columns for 6 days × 2 shifts - now with much more space */
    }

    .single-custom-schedule-table tr {
        height: 24px;
    }

    .single-subject-cell {
        height: auto;
        min-height: 40px;
        padding: 2px 1px;
        vertical-align: middle;
        /* Do not break inside words */
        word-break: keep-all;
        word-wrap: normal;
        overflow-wrap: normal;
        hyphens: none;
        -webkit-hyphens: none;
        -ms-hyphens: none;
    }

    .single-teacher-cell {
        height: auto !important;
        min-height: 30px;
        padding: 2px 4px !important;
    }

    .single-header-row th {
        padding: 4px 3px;
        font-family: 'Khmer OS Muol Light', Arial, sans-serif;
        font-size: 12px;
    }

    .single-time-row td {
        font-family: Arial, sans-serif;
        font-size: 10px;
        padding: 4px;
        white-space: nowrap;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 5mm 5mm;
        }

        .single-page-break {
            page-break-after: always;
        }

        .single-custom-schedule-table {
            width: 100% !important;
            max-width: none !important;
        }

        .single-custom-schedule-wrapper {
            width: 100% !important;
            max-width: none !important;
        }
    }

    /* Subject and room info */
    .single-schedule-info1 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 4px;
        height: 100%;
    }

    /* Subject name in Khmer */
    .single-subject-info-khmer {
        font-size: 13px;
        line-height: 1.4;
        margin-bottom: 2px;
    }

    /* Subject name in English */
    .single-subject-info {
        font-size: 11px;
        line-height: 1.3;
        margin: 2px 0;
        color: #333;
    }

    /* Room number styling */
    .single-room-info {
        font-size: 12px;
        margin-top: 2px;
        color: #333;
    }

    /* Time slot styling */
    .single-custom-schedule-table th.time-slot {
        padding: 4px;
        font-size: 12px;
        line-height: 1.3;
        height: 35px;
    }

    .single-custom-schedule-table th.time-slot br {
        margin: 2px 0;
    }

    /* Header sections */
    .single-header-section {
        margin-bottom: 20px;
    }

    .single-schedule-title {
        margin: 15px 0;
    }

    /* Ensure proper text wrapping */
    .single-custom-schedule-table td>div {
        width: 100%;
        /* Do not break inside words */
        word-break: keep-all;
        word-wrap: normal;
        overflow-wrap: normal;
        hyphens: none;
        -webkit-hyphens: none;
        -ms-hyphens: none;
    }

    /* Force table to use full width */
    .single-custom-schedule-table {
        table-layout: fixed;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Ensure all columns expand to fill available space */
    .single-custom-schedule-table th,
    .single-custom-schedule-table td {
        width: auto;
        min-width: 0;
    }

    /* Class group styling */
    .single-class-group {
        font-size: 12px;
        line-height: 1.3;
    }

    /* Date styling in header */
    .single-date-header {
        font-size: 12px;
        font-weight: normal;
    }

    /* Rest of your existing styles remain unchanged */
    .single-footer-section {
        margin-top: 40px;
    }

    /* Utility: keep content on a single line */
    .single-nowrap {
        white-space: nowrap;
        word-break: keep-all;
        word-wrap: normal;
        overflow-wrap: normal;
        hyphens: none;
        -webkit-hyphens: none;
        -ms-hyphens: none;
    }
</style>

<div id="examsScheduleContainer">
    @if (($is_print ?? '') == 'yes')
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
            <div style=" position: absolute; display: flex; justify-content: end; padding-right: 180px; padding-top: 3rem;"
                class="picture">
                <img width="100px" src="{{ asset('asset/NTTI/images/tacting-image/tacting-image1.png') }}"
                    alt="">
            </div>

        </div><br><br>


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
                ៖ {{ $record->qualification ?? '' }}
                <span class="KhmerOSMuolLight">ជំនាញ</span> {{ implode(', ', $skills->pluck('name_2')->toArray()) }}
                <span class="KhmerOSMuolLight">ក្រុម</span>
                {{ implode(' , ', $records->pluck('class_code')->unique()->toArray()) }}
                <span class="KhmerOSMuolLight">វេន </span>
                {{ implode(' , ', $records->pluck('section.name_2')->unique()->filter()->toArray()) }}
            </div>
        </div>





        <div class="single-custom-schedule-wrapper" style="width: 100%;">
            <table class="single-custom-schedule-table" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="first-column" rowspan="2"> ក្រុម</th>
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
                        @foreach ($date_name as $dataZ)
                            @php
                                $firstSchedule = $record_sub_lines
                                    ->where('date_name_code', strtolower(trim($dataZ->code)))
                                    ->where('is_second_schedule', 0)
                                    ->first();
                                $scheduleDate = $firstSchedule ? date('d/m/Y', strtotime($firstSchedule->date)) : 'N/A';
                                $scheduleDateKhmer = $scheduleDate !== 'N/A' ? toKhmerNumber($scheduleDate) : 'N/A';
                                $dayCode = strtolower(trim($dataZ->code));
                            @endphp
                            <th colspan="2" data-day-code="{{ $dayCode }}">
                                {{ $dataZ->name_2 }} ({{ $scheduleDateKhmer }})
                            </th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($date_name as $dataZ)
                            @php
                                $dayCode = strtolower(trim($dataZ->code));
                                $firstSchedule = $record_sub_lines
                                    ->where('date_name_code', $dayCode)
                                    ->where('is_second_schedule', 0)
                                    ->first();
                                $secondSchedule = $record_sub_lines
                                    ->where('date_name_code', $dayCode)
                                    ->where('is_second_schedule', 1)
                                    ->first();
                            @endphp
                            <td class="time-slot" data-day-code="{{ $dayCode }}" data-session="1">
                                វេនទី១
                            </td>
                            <td class="time-slot" data-day-code="{{ $dayCode }}" data-session="2">
                                វេនទី២
                            </td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                        $grouped_records = $record_sub_lines->groupBy('class_code');
                    @endphp

                    @foreach ($grouped_records as $class_code => $lines)
                        <!-- Row 1: Group Info and Times -->
                        <tr>
                            <td rowspan="3" class="single-group-text">
                                {{-- <div class="single-space-text">
                                        {{ toKhmerNumber($index++) }}
                                    </div> --}}
                                <div class="single-space-text">
                                    ឆ្នាំទី {{ $record->years ?? '' }}
                                </div>
                                <div class="single-space-text">
                                    {{ $record->class_code }}
                                </div>
                            </td>
                            @foreach ($days as $day)
                                @php
                                    $firstSchedule = $lines
                                        ->where('date_name_code', $day)
                                        ->where('is_second_schedule', 0)
                                        ->first();
                                    $secondSchedule = $lines
                                        ->where('date_name_code', $day)
                                        ->where('is_second_schedule', 1)
                                        ->first();
                                @endphp
                                <td class="single-time-cell">
                                    @if ($firstSchedule && $firstSchedule->start_time)
                                        {{ date('g:i', strtotime($firstSchedule->start_time)) }}-{{ date('g:i', strtotime($firstSchedule->end_time)) }}{{ date('A', strtotime($firstSchedule->end_time)) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="single-time-cell">
                                    @if ($secondSchedule && $secondSchedule->start_time)
                                        {{ date('g:i', strtotime($secondSchedule->start_time)) }}-{{ date('g:i', strtotime($secondSchedule->end_time)) }}{{ date('A', strtotime($secondSchedule->end_time)) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        <!-- Row 2: Teachers -->
                        <tr>
                            @foreach ($days as $day)
                                @php
                                    $firstSchedule = $lines
                                        ->where('date_name_code', $day)
                                        ->where('is_second_schedule', 0)
                                        ->first();
                                    $secondSchedule = $lines
                                        ->where('date_name_code', $day)
                                        ->where('is_second_schedule', 1)
                                        ->first();
                                @endphp
                                <td class="single-teacher-cell">
                                    <span
                                        class="single-teacher-text">{{ $firstSchedule->teacher->name_2 ?? '' }}</span>
                                    @if ($firstSchedule && ($firstSchedule->coTeacher || $firstSchedule->coTeacher1))
                                        <span class="single-teacher-text">
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
                                <td class="single-teacher-cell">
                                    <span
                                        class="single-teacher-text">{{ $secondSchedule->teacher->name_2 ?? '' }}</span>
                                    @if ($secondSchedule && ($secondSchedule->coTeacher || $secondSchedule->coTeacher1))
                                        <span class="single-teacher-text">
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
                        <!-- Row 3: Subjects and Rooms -->
                        <tr>
                            @foreach ($days as $day)
                                @php
                                    $firstSchedule = $lines
                                        ->where('date_name_code', $day)
                                        ->where('is_second_schedule', 0)
                                        ->first();
                                    $secondSchedule = $lines
                                        ->where('date_name_code', $day)
                                        ->where('is_second_schedule', 1)
                                        ->first();
                                @endphp
                                <td class="single-subject-cell">
                                    @if ($firstSchedule)
                                        <span class="single-subject-text">
                                            @php
                                                $subjectName = $firstSchedule->subject->name_2 ?? '';
                                                if (strpos($subjectName, '(') !== false) {
                                                    $parts = explode('(', $subjectName, 2);
                                                    echo trim($parts[0]);
                                                    if (isset($parts[1])) {
                                                        echo ' <span class="single-nowrap">(' .
                                                            trim($parts[1]) .
                                                            '</span>';
                                                    }
                                                } else {
                                                    echo $subjectName;
                                                }
                                            @endphp
                                        </span>
                                        <span class="single-room-text">បន្ទប់ {{ $firstSchedule->room ?? '' }}</span>
                                    @endif
                                </td>
                                <td class="single-subject-cell">
                                    @if ($secondSchedule)
                                        <span class="single-subject-text">
                                            @php
                                                $subjectName = $secondSchedule->subject->name_2 ?? '';
                                                if (strpos($subjectName, '(') !== false) {
                                                    $parts = explode('(', $subjectName, 2);
                                                    echo trim($parts[0]);
                                                    if (isset($parts[1])) {
                                                        echo ' <span class="single-nowrap">(' .
                                                            trim($parts[1]) .
                                                            '</span>';
                                                    }
                                                } else {
                                                    echo $subjectName;
                                                }
                                            @endphp
                                        </span>
                                        <span class="single-room-text">បន្ទប់ {{ $secondSchedule->room ?? '' }}</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="" class="row mt-4">
            <div style="padding-top: 50px;" class="col-5 text-center KhmerOSMuolLight">
                បានឃើញនិងឯកភាព<br />
                នាយករងសិក្សា
            </div>
            <div class="col-2"></div>
            <div class="col-5 text-center khmer_os_b" style="position: relative;">
                <div style="margin-bottom: 10px; position: absolute; width: 85%; left: 2%;">
                    @if (empty($record->examDateKhmer->date_khmer))
                        <span>ថ្ងៃ......................</span>
                        <span>ខែ......................</span>
                        <span>ឆ្នាំ......................</span>
                        <p>ត្រូវនិងថ្ងៃទី.................................</p>
                    @else
                        {{ $record->examDateKhmer->date_khmer }}
                    @endif
                </div>
                <div class="KhmerOSMuolLight" style="margin-top: 50px; padding-right: 5px;">នាយករងសិក្សា</div>
            </div>
        </div>
    @else
        hello
    @endif
</div>


@push('scripts')
    <script></script>
@endpush
