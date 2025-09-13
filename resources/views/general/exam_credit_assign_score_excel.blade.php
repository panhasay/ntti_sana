<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: right;">
                    ព្រះរាជាណាចក្រកម្ពុជា
                </th>
            </tr>
            <tr>
                <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: right;">ជាតិ សាសនា ព្រះមហាក្សត្រ
                </th>
            </tr>
            <tr>
                <th colspan="3" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    វិទ្យាស្ថានជាតិបណ្ដុះបណ្ដាលបច្ចេកទេស</th>
            </tr>
            <tr>
                <th colspan="3" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា
                </th>
            </tr>
            <tr>
                <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    បញ្ជីរាយនាមនិស្សិតដែលបានមកប្រឡងក្រេឌីត
                </th>
            </tr>
            <tr>
                <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    {{ App\Service\service::getDayMonthYearKhmer() }}
                </th>
            </tr>
            <tr>
                <th width="5"
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center; vertical-align: middle;border: 1px solid black;">
                    ល.រ
                </th>
                <th width="20"
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center; vertical-align: middle;border: 1px solid black;">
                    គោត្តនាម-នាម
                </th>
                <th width='15'
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black; vertical-align: middle;">
                    ភេទ
                </th>
                <th width="20"
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                    ក្រុម
                </th>
                <th width="20"
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                    ឆ្នាំសិក្សា
                </th>
                <th width="20"
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                    ពិន្ទុ
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $students = collect($students);
                $index = 1;
            @endphp
            @foreach ($students as $student)
                <tr>
                    <td
                        style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                        {{ $index++ }}</td>
                    <td
                        style="font-family: 'Khmer OS Battambang'; border: 1px solid black;{{ ($student['gender'] ?? '') === 'ស្រី' ? 'font-weight: bold;' : '' }}">
                        {{ $student['name'] ?? '' }}
                    </td>
                    <td
                        style="font-family: 'Khmer OS Battambang'; text-align: center; border: 1px solid black; {{ ($student['gender'] ?? '') === 'ស្រី' ? 'font-weight: bold;' : '' }}">
                        {{ $student['gender'] ?? '' }}
                    </td>

                    <td style="font-family: 'Roboto', sans-serif; text-align: center; border: 1px solid black;">
                        {{ \App\Service\service::removeDotFromCode($student['class_code'] ?? '') }}
                    </td>
                    <td style="font-family: 'Roboto', sans-serif; text-align: center; border: 1px solid black;">
                        {{ $student['year_semester'] ?? '' }}
                    </td>
                    <td
                        style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                        {{ $student['total'] ?? '' }}</td>
                </tr>
            @endforeach
            <tr>
                <td style="font-family: 'Khmer OS Battambang';">
                    បញ្ចប់បញ្ជីត្រឹមចំនួន {{ $students->count() }} នាក់ ស្រី
                    {{ $students->where('gender', 'ស្រី')->count() }} នាក់ ។
                </td>
            </tr>
            <tr>
                <td colspan="6" style="font-family: 'Khmer OS Battambang'; text-align:right;">
                    {{ \App\Service\service::updateDateTime() }}
                </td>
            </tr>
            <tr>
                <th colspan="5" style="font-family: 'Khmer OS Muol Light';text-align:right;">
                    ប្រធានដេប៉ាតឺម៉ង់
                </th>
            </tr>
            <tr>
                <th colspan="6" style="font-family: 'Khmer OS Battambang';;text-align:center;">
                    បានឃើញ​ និងពិនិត្យត្រឹមត្រូវ
                </th>
            </tr>
            <tr>
                <th colspan="6" style="font-family: 'Khmer OS Muol Light';text-align:center;">
                    នាយករងសិក្សា
                </th>
            </tr>
            <tr>
                <th colspan="3" style="font-family: 'Khmer OS Battambang';text-align:center;">
                    បានឃើញ​ និងឯកភាព
                </th>
            </tr>
            <tr>
                <th colspan="3" style="font-family: 'Khmer OS Muol Light';text-align:center;">
                    នាយកវិទ្យាស្ថាន
                </th>
            </tr>
        </tbody>
    </table>
</body>

</html>
