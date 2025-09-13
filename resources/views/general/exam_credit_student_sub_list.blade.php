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

    .selected-subject-list {
        padding-left: 0;
        margin: 0;
        text-align: left;
    }

    .selected-subject-list li {
        padding: 2px 0;
        font-size: 13px;
        color: #333;
        word-break: break-word;
    }

    td .btn {
        margin-bottom: 5px;
    }

    td .selected-subject-list {
        display: block;
        max-height: none;
    }
</style>
<div id="classScheduleContainer">
    @if ($is_print ?? '' == 'Yes')
        @php
            $firstRecord = $records->first();
            $currentMonth = now()->month;
            $now = \Carbon\Carbon::now('Asia/Phnom_Penh');
            $day = $now->day;
            $month = $now->month;
            $year = $now->year;

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
                បញ្ជីរាយនាមនិស្សិតដែលត្រូវមកប្រឡងក្រេឌីត
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center moul-regular">
                ថ្ងៃទី{{ \App\Service\Service::convertToKhmerNumerals((int) $day) }}
                ខែ{{ \App\Service\Service::getMonthKhmer((int) $month - 1) }}
                ឆ្នាំ{{ \App\Service\Service::convertToKhmerNumerals((int) $year) }}
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered table-print mt-2">
                <tbody id="recordsLineTableBody">
                    <tr>
                        <th width="40" class="text-center fw-bolder">ល.រ</th>
                        <th width="250" class="text-center fw-bolder">គោត្តនាម-នាម</th>
                        <th width="100" class="text-center fw-bolder">ភេទ</th>
                        <th class="text-center fw-bolder">ក្រុម</th>
                        <th class="text-center fw-bolder">ឆ្នាំសិក្សា</th>
                        <th width='90' class="text-center fw-bolder">ចំនួនអវត្តមាន</th>
                        <th width='90' class="text-center fw-bolder">ប្រឡងសង</th>
                        <th width='400' class="text-center fw-bolder">មុខវិជ្ជា</th>
                    </tr>
                    @php
                        $shownGroups = [];
                        $grouped = $records->groupBy(function ($item) {
                            return $item->class_code . '_' . $item->semester . '_' . $item->years;
                        });
                        $rowspans = $grouped->map->count();
                    @endphp
                    @foreach ($records as $record)
                        @php
                            $groupKey = $record->class_code . '_' . $record->semester . '_' . $record->years;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $record->name_2 }}</td>
                            <td class="text-center">{{ $record->gender }}</td>
                            <td class="text-center">{{ \App\Service\Service::removeDotFromCode($record->class_code) }}
                            </td>
                            <td class="text-center">Y{{ $record->years }}S{{ $record->semester }}</td>
                            <td class="text-center">{{ $record->total_absent }}</td>
                            @if ($record->total_absent > 3 && $record->total_absent <= 4)
                                <td class='text-center'>3​ មុខវិជ្ជា</td>
                            @elseif ($record->total_absent > 4 && $record->total_absent <= 10)
                                <td class='text-center'>5 មុខវិជ្ជា</td>
                            @else
                                <td class='text-center'>ត្រួតថ្នាក់</td>
                            @endif
                            @if (!in_array($groupKey, $shownGroups))
                                <td class="text-center" rowspan="{{ $rowspans[$groupKey] }}">
                                    @if ($is_print != 'Yes')
                                        <button class="btn btn-sm btn-success select-subject-btn no-print"
                                            data-code="{{ $record->class_code }}"
                                            data-semester="{{ $record->semester }}">
                                            ជ្រើសរើសមុខវិជ្ជា
                                        </button>
                                    @endif
                                    @php
                                        $count = 0;
                                        $totalSubjects = count(
                                            $selectedSubjects[$record->class_code . '_' . $record->semester] ?? [],
                                        );
                                    @endphp
                                    <ul class="list-unstyled selected-subject-list"
                                        data-code="{{ $record->class_code }}" data-semester="{{ $record->semester }}">
                                        @foreach ($selectedSubjects[$record->class_code . '_' . $record->semester] ?? [] as $subject)
                                            <li>{{ $subject }}</li>
                                            @php $count++; @endphp
                                            @if ($count % 3 === 0 && $totalSubjects > 3)
                                                <li>+</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                @php
                                    $shownGroups[] = $groupKey;
                                @endphp
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-3">
                <p>បញ្ចប់បញ្ជីត្រឹមចំនួន {{ count($records) }} នាក់ ស្រី
                    {{ $records->where('gender', 'ស្រី')->count() }} នាក់</p>
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
        <p>don't have students</p>
    @endif
</div>
