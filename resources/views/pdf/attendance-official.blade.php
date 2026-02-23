<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="utf-8">

    <style>
        /* ✅ Khmer Unicode Font */
        @font-face {
            font-family: 'Khmer';
            src: url("{{ storage_path('fonts/NotoSerifKhmer-Regular.ttf') }}") format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: 'Khmer';
            src: url("{{ storage_path('fonts/NotoSerifKhmer-Bold.ttf') }}") format('truetype');
            font-weight: bold;
        }

        body {
            font-family: 'Khmer', DejaVu Sans;
            font-size: 12px;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .info {
            margin-top: 10px;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: -10px;
            left: 0;
            right: 0;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="title">
        របាយការណ៍អវត្តមានសិស្ស (Official)
    </div>

    <div class="info">
        <strong>ក្រុម:</strong> {{ $classCode }} <br>
        <strong>មុខវិជ្ជា:</strong> {{ $subjectName }} <br>
        <strong>លោកគ្រូ:</strong> {{ $teacherName }} <br>
        <strong>វេន:</strong> {{ $sectionName }} <br>
        <strong>ថ្ងៃបង្រៀន:</strong> {{ $att_date }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="40">ល.រ</th>
                <th width="100">លេខសម្គាល់</th>
                <th>ឈ្មោះសិស្ស</th>
                <th width="90">ស្ថានភាព</th>
                <th width="120">កំណត់សម្គាល់</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $stu)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stu->student_code }}</td>
                    <td class="text-left">{{ $stu->student_name }}</td>
                    <td>
                        @switch($stu->status)
                            @case('present') វត្តមាន @break
                            @case('absent') អវត្តមាន @break
                            @case('permission') ច្បាប់ @break
                            @case('late') យឺត @break
                            @default -
                        @endswitch
                    </td>
                    <td>{{ $stu->remark }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        បង្កើតដោយ {{ $generatedBy }} | {{ now()->format('d/m/Y H:i') }}
    </footer>

</body>
</html>
