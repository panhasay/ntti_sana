<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8jhAXg6/jzOyh0b9bJbN+4l/j4j5zVhY4Kc0vGQfH5f1A6" crossorigin="anonymous">
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
            text-align: center;
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

        /* Alternate row shading for clarity */
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }


        /* Print Settings */
        @media print {
            @page {
                size: A4 landscape;
                margin: 5mm;
            }

            body {
                margin: 0;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 4px;
            }

            h2 {
                font-size: 18px;
                margin-bottom: 5px;
            }

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
    <div style="display:flex;justify-content:space-between;">
        <div style="margin-top:20px">
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;">ក្រសួងការងារ
                និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ</h4>
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;">វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</h4>
        </div>
        <div>
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;text-align: center">ព្រះរាជាណាចក្រកម្ពុជា</h4>
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;"> ជាតិ សាសនា ព្រះមហាក្សត្រ</h4>
        </div>
    </div><br>
    <div class="row" style="text-align: center">
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">
            តារាងបែងចែកម៉ោងបង្រៀន ឆមាសទី {{ App\Service\service::convertToKhmerNumerals($headers->semester ?? '') }}
            ឆ្នាំទី {{ App\Service\service::convertToKhmerNumerals($headers->years ?? '') }} &nbsp;
            ​​ឆ្នាំសិក្សា {{ $headers->session_year_code ?? '' }}
        </div>
    </div>
    <div class="row" style="text-align: center">
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">
            សម្រាប់ថ្នាក់{{ $headers->qualification ?? '' }}បច្ចេកវិទ្យា{{ $headers->skill_name ?? '' }} វេន​
            {{ $headers->section_name ?? '' }} ក្រុម {{ $headers->class_code ?? '' }}
        </div>
    </div>
    <div class="row" style="text-align: center">
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">
            ចាប់ផ្ដើមអនុវត្តពី​ {{ App\Service\service::DateYearKH($headers->start_date) }}
        </div>
    </div>

    <div class="table-responsive margin-bottom">
        <table class="table table-bordered bg-white mt-4">
            <thead>
                <tr id="day">
                    <th width='25' class="text-center fw-bold" rowspan="2">ល.រ</th>
                    <th width="120" class="text-center fw-bold" rowspan="2">សាស្រ្តាចារ្យ</th>
                    @foreach ($days as $dayCode => $dayName)
                        <th class="fw-bold p-2" colspan="{{ count($sessions[$dayCode] ?? []) }}">
                            {{ trim($dayName) }}
                        </th>
                    @endforeach
                </tr>
                <tr id="session">
                    @foreach ($days as $dayCode => $dayName)
                        @foreach ($sessions[$dayCode] ?? [] as $time => $data)
                            <th class="text-center">{{ $time }}</th>
                        @endforeach
                    @endforeach
                </tr>
            </thead>

            <tbody id="body-data">
                @php
                    $index = 1;
                    $teacherGroups = [];
                    foreach ($sessions as $day => $daySessions) {
                        foreach ($daySessions as $time => $details) {
                            $key = $details['teacher_name'];
                            $teacherGroups[$key]['teacher_name'] = $details['teacher_name'];
                            $teacherGroups[$key]['teacher_gender'] = $details['teacher_gender'];
                            $teacherGroups[$key]['data'][$day][$time] = $details;
                        }
                    }
                @endphp
                @foreach ($teacherGroups as $teacher)
                    <tr>
                        <td class="text-center">{{ $index++ }}</td>
                        <td width='80' style="text-align:start;"
                            class="{{ $teacher['teacher_gender'] === 'ស្រី' ? 'fw-bold ' : '' }}">
                            {{ $teacher['teacher_gender'] === 'ស្រី' ? 'លោកស្រី' : 'លោក' }}
                            {{ $teacher['teacher_name'] ?? '' }}
                        </td>
                        @foreach ($days as $dayCode => $dayName)
                            @foreach ($sessions[$dayCode] ?? [] as $time => $data)
                                @if (isset($teacher['data'][$dayCode][$time]))
                                    <td class="text-center position-relative">
                                        <p class="fw-bold" style="font-size:10px">
                                            {{ $teacher['data'][$dayCode][$time]['subject_name'] }}</p>
                                        <p style="font-size:10px">{{ $teacher['data'][$dayCode][$time]['room'] }}</p>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="display:flex;justify-content:space-between;">
        <div style="margin-top:80px;margin-left:180px">
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;">បានឃើញ​ និងឯកភាព</h4>
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;text-align:center">នាយកវិទ្យាស្ថាន</h4>
        </div>
        <div style="margin-top:20px;">
            <div class="p-3">
                {{ App\Service\service::updateDateTime() ?? '' }}</div>
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;text-align: center">នាយករងសិក្សា</h4>
        </div>
    </div><br>
</body>

</html>
