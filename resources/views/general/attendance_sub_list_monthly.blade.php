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
            border: 1px solid #333 !important;
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
</style>
<div id="classScheduleContainer">
    @if ($is_print ?? '' == 'Yes')
        @php
            $firstRecord = $records->first();
            $currentMonth = now()->month;
        @endphp
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
                បញ្ជីសរុបវត្តមានប្រចាំខែ {{ \App\Service\Service::getMonthKhmer($currentMonth - 1) }}
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12 text-center moul-regular">
                ថ្នាក់៖ {{ $firstRecord->qualification ?? '' }} ជំនាញ៖ {{ $firstRecord->skill_name ?? '' }}
                ក្រុម៖​ <span class="roboto ms-1">
                    {{ \App\Service\Service::removeDotFromCode($firstRecord->class_code ?? '') }}
                </span>
                វេន{{ $firstRecord->section_name ?? '' }}
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center moul-regular">
                ឆ្នាំសិក្សា៖ {{ \App\Service\Service::formatSessionYearToKhmer($firstRecord->session_year_code ?? '') }}
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered table-print mt-2">
                <tbody id="recordsLineTableBody">
                    <tr>
                        <th rowspan="2" width="10" class="fw-bold">ល.រ</th>
                        <th rowspan="2" width="170" class="fw-bold text-center">គោតនាម-នាម</th>
                        @foreach ($attendanceMonths as $month)
                            <th colspan="2" class="fw-bold text-center">
                                <div>
                                    ខែ {{ \App\Service\Service::getMonthKhmer((int) $month->att_month - 1) }}
                                </div>
                                <div class="py-3">
                                    ថ្ងៃទី {{ \App\Service\Service::convertToKhmerNumerals((int) $month->start_day) }}
                                </div>
                                <div>
                                    ដល់ថ្ងៃទី {{ \App\Service\Service::convertToKhmerNumerals((int) $month->end_day) }}
                                </div>
                            </th>
                        @endforeach
                        <th colspan="2" width="70" class="fw-bold text-center">
                            សរុប
                        </th>
                    </tr>
                    <tr>
                        @for ($i = 0; $i < count($attendanceMonths); $i++)
                            <th class="text-center fw-bold">ឥ.ច</th>
                            <th class="text-center fw-bold">ម.ច</th>
                        @endfor
                        <th class="text-center fw-bold">ឥ.ច</th>
                        <th class="text-center fw-bold">ម.ច</th>
                    </tr>
                    @foreach ($uniqueStudents as $record)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="{{ $record->gender == 'ស្រី' ? 'fw-bold' : '' }}">
                                {{ $record->name_2 ?? '' }}
                            </td>
                            @php
                                $total_absent = 0;
                                $total_permission = 0;
                            @endphp
                            @foreach ($attendanceMonths as $month)
                                @php
                                    $matchingRecords = $records->filter(function ($item) use ($record, $month) {
                                        return $item->code === $record->code &&
                                            $item->att_month === $month->att_month &&
                                            $item->att_year === $month->att_year;
                                    });

                                    $absent = $matchingRecords->sum('total_absent');
                                    $permission = $matchingRecords->sum('total_permission');

                                    $total_absent += $absent;
                                    $total_permission += $permission;
                                @endphp
                                <td class="text-center">{{ $absent }}</td>
                                <td class="text-center">{{ $permission }}</td>
                            @endforeach
                            <td class="{{ $total_absent > 15 ? 'bg-danger text-white' : '' }} text-center">
                                {{ $total_absent }}</td>
                            <td class="text-center">{{ $total_permission }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-3 text-center">
                <p><span class="fw-bold">កំណត់សម្គាល់៖ ​</span>និស្សិតដែលមានវត្តមានលើស​ ១៥ដង
                    ក្នុងមួយឆមាសនោះខាងដេប៉ាតឺម៉ង់មិនអនុញ្ញាតឲ្យប្រឡងឆមាសជាដាច់ខាត។</p>
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
        <div class="table-responsive p-2">
            <form id="frmDataSublist" role="form" class="form-sample" enctype="multipart/form-data">
                <table class="table table-bordered table-print text-center">
                    <thead>
                        <tr>
                            <th rowspan="2" width="40">ល.រ</th>
                            <th rowspan="2" width="170">គោតនាម-នាម</th>
                            <th colspan="2">

                                ខែ មថុនា ថ្ងៃទី ៧​ ដល់ថ្ងៃទី ៣១
                            </th>
                            <th colspan="2">
                                សរុប
                            </th>
                        </tr>
                        <tr>
                            <th>ឥ.ច</th>
                            <th>ម.ច</th>
                            <th>ឥ.ច</th>
                            <th>ម.ច</th>
                        </tr>
                    </thead>
                    <tbody id="recordsLineTableBody">
                        <tr>
                            <td>1</td>
                            <td class="text-start">លោក សោម អរិយា</td>
                            <td>3</td>
                            <td>5</td>
                            <td>0</td>
                            <td>6</td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    @endif
</div>
