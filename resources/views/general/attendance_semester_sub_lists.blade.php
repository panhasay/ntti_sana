<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Angkor&family=Battambang:wght@100;300;400;700;900&family=Caveat:wght@400..700&family=Indie+Flower&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Moul&family=Moulpali&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Yuji+Mai&display=swap');

        body {
            font-family: 'Khmer OS Battambang', sans-serif;
            margin: 20px;
            font-size: 14px;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
        }

        th,
        td {
            border: 0.9px solid #333 !important;
            padding: 6px;
            word-wrap: break-word;
            vertical-align: middle;
        }

        th {
            background-color: #e6e6e6;
            font-weight: bold;
        }

        td p {
            margin: 0;
            line-height: 1.2;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media print {
            @page {
                size: A4 landscape;
                margin: 5mm;
            }

            body {
                margin-top: 20px;
            }

            table {
                font-size: 14px;
            }

            th,
            td {
                padding: 4px;
            }

            h2 {
                font-size: 18px;
                margin-bottom: 5px;
            }

            h3,
            h4 {
                margin: 0;
            }

            .moul-regular {
                font-family: "Moul", serif !important;
                font-weight: 500 !important;
                font-style: normal !important;
            }

        }
    </style>
</head>

<body>
    @php
        $skill = DB::table('skills')->where('code', $classInfo->skills_code)->value('name_2');
        $section = DB::table('sections')->where('code', $classInfo->sections_code)->value('name_2');
    @endphp
    <div style="display:flex;justify-content:space-between;">
        <div style="margin-top:20px">
            <h3 style="font-family: 'Khmer OS Muol Light';font-weight:400;">ក្រសួងការងារ
                និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</h3>
            <h3 style="font-family: 'Khmer OS Muol Light';font-weight:400;">វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</h3>
        </div>
        <div>
            <h3 style="font-family: 'Khmer OS Muol Light';font-weight:400;text-align: center">ព្រះរាជាណាចក្រកម្ពុជា</h3>
            <h3 style="font-family: 'Khmer OS Muol Light';font-weight:400;"> ជាតិ សាសនា ព្រះមហាក្សត្រ</h3>
        </div>
    </div>
    <div class="row" style="text-align: center;margin-top:30px">
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">
            បញ្ជីសរុបវត្តមានប្រចាំឆមាស ឆមាសទី៖
            {{ App\Service\service::convertToKhmerNumerals($classInfo->semester ?? '') }}
            ឆ្នាំទី៖
            {{ App\Service\service::convertToKhmerNumerals($classInfo->years ?? '') }}
        </div>
    </div>
    <div class="row" style="text-align: center">
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">
            ថ្នាក់៖ {{ $classInfo->qualification ?? '' }}បច្ចេកទេស ជំនាញ៖ {{ $skill ?? '' }} ក្រុម៖
            {{ $classInfo->class_code ?? '' }} វេន៖ {{ $section ?? '' }}
        </div>
    </div>
    <div class="row" style="text-align: center">
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">
            ឆ្នាំសិក្សា៖
            {{ App\Service\service::convertEnglishToKhmerNumber(str_replace('_', '-', $classInfo->session_year_code ?? '')) }}
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th width="15" rowspan="2">ល.រ</th>
                <th width="30" rowspan="2">គោត្តនាម-នាម</th>
                <th width="15" rowspan="2">ភេទ</th>
                @foreach ($months as $month)
                    <th width="50" colspan="2">
                        ខែ {{ $kh_months[$month->month] }}<br>
                        ថ្ងៃទី {{ App\Service\service::convertToKhmerNumerals($month->start_day) }}<br> ដល់ថ្ងៃទី
                        {{ App\Service\service::convertToKhmerNumerals($month->end_day) }}
                    </th>
                @endforeach
                <th width="35" colspan="2">សរុប</th>
            </tr>
            <tr>
                @foreach ($months as $month)
                    <th>ម.ច</th>
                    <th>ឥ.ច</th>
                @endforeach
                <th>ម.ច</th>
                <th>ឥ.ច</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 1;
                $records = collect($records)
                    ->sortBy(function ($sort_name) {
                        return $sort_name['name'];
                    })
                    ->values();
            @endphp
            @foreach ($records as $record)
                <tr>
                    <td style="text-align: center">
                        {{ $index++ }}</td>
                    <td class="{{ ($record['gender'] ?? '') == 'ស្រី' ? 'fw-bold' : '' }}">
                        {{ $record['name'] ?? '' }}
                    </td>
                    <td style="text-align: center" class="{{ ($record['gender'] ?? '') == 'ស្រី' ? 'fw-bold' : '' }}">
                        {{ $record['gender'] ?? '' }}
                    </td>

                    @php
                        $total_permission = 0;
                        $total_absent = 0;
                    @endphp

                    @foreach ($months as $month)
                        @php
                            $year = $month->year;
                            $m = $month->month;
                            $permissionCount = $record['months'][$year][$m]['permission'] ?? 0;
                            $absentCount = $record['months'][$year][$m]['absent'] ?? 0;
                            $permissionScore = $permissionCount * 0.5;
                            $permissionAsAbsent = floor($permissionScore);
                            $total_permission += $permissionCount;
                            $total_absent += $absentCount + $permissionAsAbsent;
                        @endphp
                        <td style="text-align: center">{{ $permissionCount }}</td>
                        <td style="text-align: center">{{ $absentCount }}</td>
                    @endforeach

                    <td style="text-align: center; {{ $total_absent > 14 ? 'color: red;font-weight: bold;' : '' }}">
                        {{ $total_permission }}
                    </td>
                    <td style="text-align: center; {{ $total_absent > 14 ? 'color: red;font-weight: bold;' : '' }}">
                        {{ $total_absent }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><span style="font-weight: bold;">កំណត់សម្គាល់ៈ</span> និស្សិតដែលមានវត្តមានលើស ១៥ដង
        ក្នុងមួយឆមាសនោះខាងដេប៉ាតឺម៉ង់មិនអនុញ្ញាតឲ្យប្រឡងឆមាសជាដាច់ខាត។</p>
    <div style="display:flex;justify-content:space-between;">
        <div style="margin-top:80px;margin-left:180px">
            <h4 style="font-weight:400;">បានឃើញ​ និងពិនិត្យត្រឹមត្រូវ</h4>
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;text-align:center">ប្រធានដេប៉ាតឺម៉ង់
            </h4>
        </div>
        <div style="margin-top:20px;">
            <div style="margin-left: -30px !important;white-space: pre-line !important;">
                {{ App\Service\service::updateDateTime() ?? '' }}
            </div>
            <h4 style="font-family:'Khmer OS Muol Light';font-weight:400;text-align: center">អ្នកធ្វើតារាង</h4>
        </div>
    </div><br>
</body>

</html>
