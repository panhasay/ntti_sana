<style>
    @import url('https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&family=Indie+Flower&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Moul&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Yuji+Mai&display=swap');

    html,
    body {
        overflow: hidden !important;
    }

    .roboto {
        font-family: "Roboto", sans-serif;
        font-optical-sizing: auto;
        font-weight: bold;
        font-style: normal;
    }

    .moul-regular {
        font-family: "Moul", serif !important;
        font-weight: 500 !important;
        font-style: normal !important;
    }

    .battambang-bold {
        font-family: "Battambang", system-ui !important;
        font-size: 14px !important;
    }

    .table th,
    .table td {
        vertical-align: middle !important;
        font-family: 'Khmer OS Battambang', 'Noto Sans Khmer', sans-serif;
        padding: 10px !important;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 7mm;
        }

        .table-print th,
        .table-print td {
            border: 0.7px solid #333 !important;
            font-size: 14px !important;
            background-color: transparent !important;
        }

        .table-print td>div {
            font-size: 14px !important;
        }

        .no-print {
            display: none !important;
        }

        .bg-absent {
            background-color: #dc3545 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

    }

    .row {
        margin-right: 0;
        margin-left: 0;
    }

    .table th:nth-child(1),
    .table td:nth-child(1) {
        width: 5%;
    }

    .table th:nth-child(2),
    .table td:nth-child(2) {
        width: 17%;
    }

    .table th:nth-child(3),
    .table td:nth-child(3) {
        width: 13%;
    }

    .table th:nth-child(4),
    .table td:nth-child(4) {
        width: 13%;
    }

    .table th:nth-child(5),
    .table td:nth-child(5) {
        width: 13%;
    }

    .table th:nth-child(6),
    .table td:nth-child(6) {
        width: 10%;
    }

    .table th:nth-child(7),
    .table td:nth-child(7) {
        width: 15%;
    }

    .table th:nth-child(8),
    .table td:nth-child(8) {
        width: 15%;
    }
</style>
<div id="classScheduleContainer">
    @if ($is_print ?? '' == 'Yes')
        <div class="row align-items-start text-center">
            <div class="col-5 moul-regular">
                <br>វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស<br>
                ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា
            </div>
            <div class="col-2"></div>
            <div class="col-5 moul-regular">
                ព្រះរាជាណាចក្រកម្ពុជា<br>
                ជាតិ សាសនា ព្រះមហាក្សត្រ
            </div>
        </div><br>
        <div class="row">
            <div class="col-12 text-center moul-regular">
                បញ្ជីរាយនាមនិស្សិតដែលត្រូវប្រឡង
            </div>
        </div>
        <div class="row py-2">
            <div class="col-12 text-center moul-regular">
                ដែលបានប្រព្រឹត្តទៅនៅ{{ \App\Service\Service::getDayMonthYearKhmer() }}
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered table-print mt-2" style="table-layout: fixed; width: 100%;">
                <tbody id="recordsLineTableBody">
                    <tr>
                        <th class="text-center">ល.រ</th>
                        <th class="text-center">គោត្តនាម-នាម</th>
                        <th class="text-center">ភេទ</th>
                        <th class="text-center">ក្រុម</th>
                        <th class="text-center">ឆ្នាំសិក្សា</th>
                        <th class="text-center">ចំនួនមុខវិជ្ជា</th>
                        <th class="text-center">ហត្ថលេខា</th>
                        <th class="text-center">ពិន្ទុ</th>
                    </tr>
                    @if (!empty($studentsByClass) && $studentsByClass->count() > 0)
                        @php $i = 1; @endphp
                        @foreach ($studentsByClass as $classCode => $students)
                            @foreach ($students as $student)
                                <tr>
                                    <td style="text-align: center">{{ $i++ }}</td>
                                    <td class="{{ $student['gender'] == 'ស្រី' ? 'fw-bold' : '    ' }}">
                                        {{ $student['student_name'] }}
                                    </td>
                                    <td class="text-center {{ $student['gender'] == 'ស្រី' ? 'fw-bold' : '' }}">
                                        {{ $student['gender'] }}
                                    </td>
                                    <td style="text-align: center">
                                        {{ App\Service\Service::removeDotFromCode($student['class_code']) }}</td>
                                    <td style="text-align: center">Y{{ $student['year'] }}S{{ $student['semester'] }}
                                    </td>
                                    <td style="text-align: center">
                                        {{ $student['failed_subjects_count'] }}
                                        {{-- @if (!empty($student['failed_subjects']))
                                            <ul>
                                                @foreach ($student['failed_subjects'] as $subject)
                                                    <li>{{ $subject }}</li>
                                                @endforeach
                                            </ul>
                                        @endif --}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">មិនមានសិស្សនៅក្នុងថ្នាក់</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="row mt-3">
                {{-- <p>
                    បញ្ចប់បញ្ជីត្រឹមចំនួន {{ $records->count() }} នាក់
                    ស្រីចំនួន {{ $records->where('gender', 'ស្រី')->count() }} នាក់
                </p> --}}
                <div class="col-5 moul-regular"></div>
                <div class="col-2"></div>
                <div class="col-5 text-center">
                    <div class="me-5">
                        <div>
                            {{ App\Service\service::updateDateTime() }}
                        </div>
                        <div class="moul-regular">អ្នកធ្វើតារាង</div>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-4 mt-4">
                    បានឃើញ និងឯកភាព<br>
                    <span class="moul-regular">
                        នាយករងសិក្សា</span>
                </div>
                <div class="col-4">
                    បានឃើញ និងពិនិត្យត្រឹមត្រូវ<br>
                    <span class="moul-regular">
                        ប្រធានដេប៉ាតឺម៉ង់</span>
                </div>
            </div>
        </div>
    @else
        <h1>ot jenh hahaha</h1>
    @endif
</div>
