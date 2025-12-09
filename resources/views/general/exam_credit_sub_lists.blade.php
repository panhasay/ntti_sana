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
            បញ្ជីរាយនាមនិស្សិតដែលបានមកប្រឡងក្រេឌីត
        </div>
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">
            @php
                $dateKh = App\Service\service::DateYearKH(\Carbon\Carbon::now());
            @endphp
            {{ $dateKh ?? '' }}
        </div>
    </div>
    <div class="row" style="text-align: center">
        <div class="col-12 text-center" style="font-family: 'Khmer OS Muol Light';font-weight:400;">

        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th width="35">ល.រ</th>
                <th>គោត្តនាម-នាម</th>
                <th width="45">ភេទ</th>
                <th>ថ្នាក់/ក្រុម</th>
                <th>ឆ្នាំសិក្សា</th>
                {{-- <th>ចំនួនមុខវិជ្ជា</th> --}}
                <th>ចំនួនអវត្តមានសរុប</th>
                <th>ហត្ថលេខា</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 1;
            @endphp
            @foreach ($records as $record)
                <tr>
                    <td style="text-align: center;">{{ $index++ }}</td>
                    <td style="text-align: left;">{{ $record->name_2 ?? '' }}</td>
                    <td style="text-align: center;">{{ $record->gender ?? '' }}</td>
                    <td style="text-align: center;">{{ $record->class_code ?? '' }}</td>
                    <td style="text-align: center;">ឆ្នាំទី{{ $record->years ?? '' }}
                        ឆមាសទី{{ $record->semester ?? '' }}
                    </td>
                    {{-- <td style="text-align: center;">៥ មុខវិជ្ជា</td> --}}
                    <td style="text-align: center;">{{ $record->absent ?? '' }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>បញ្ចប់បញ្ជីត្រឹមចំនួន​ 35នាក់ ស្រី 02នាក់</p>
    <div style="display:flex;justify-content:space-between;">
        <div style="margin-top:80px;margin-left:180px">
            <h4 style="font-weight:400;">បានឃើញ​ និងពិនិត្យត្រឹមត្រូវ</h4>
            <h4 style="font-family: 'Khmer OS Muol Light';font-weight:400;text-align:center">ប្រធានដេប៉ាតឺម៉ង់
            </h4>
        </div>
        <div style="margin-top:10px;">
            <div style="margin-left: -30px !important;white-space: pre-line !important;">
                {{ App\Service\service::updateDateTime() ?? '' }}
            </div>
            <h4 style="font-family:'Khmer OS Muol Light';font-weight:400;text-align: center">អ្នកធ្វើតារាង</h4>
        </div>
    </div><br>
</body>

</html>
