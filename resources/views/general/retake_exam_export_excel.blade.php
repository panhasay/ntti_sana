    <table>
        <thead>
            <tr>
                <th colspan="8" style="font-family: 'Khmer OS Muol Light'; text-align: right;">
                    ព្រះរាជាណាចក្រកម្ពុជា
                </th>
            </tr>
            <tr>
                <th colspan="8" style="font-family: 'Khmer OS Muol Light'; text-align: right;">ជាតិ សាសនា ព្រះមហាក្សត្រ
                </th>
            </tr>
            <tr>
                <th colspan="4" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    វិទ្យាស្ថានជាតិបណ្ដុះបណ្ដាលបច្ចេកទេស</th>
            </tr>
            <tr>
                <th colspan="4" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា
                </th>
            </tr>
            <tr>
                <th colspan="8" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    បញ្ជីរាយនាមនិស្សិតដែលត្រូវប្រឡង
                </th>
            </tr>
            <tr>
                <th colspan="8" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    ដែលប្រព្រឹត្តទៅនៅ {{ App\Service\service::getDayMonthYearKhmer() }}
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
                <th width='10'
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black; vertical-align: middle;">
                    ភេទ
                </th>
                <th width='15'
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black; vertical-align: middle;">
                    ក្រុម
                </th>
                <th width='15'
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black; vertical-align: middle;">
                    ឆ្នាំសិក្សា
                </th>
                <th width='15'
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black; vertical-align: middle;">
                    ចំនួនមុខវិជ្ជា
                </th>
                <th width='20'
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black; vertical-align: middle;">
                    ហត្ថលេខា
                </th>
                <th width='20'
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black; vertical-align: middle;">
                    ពិន្ទុ
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 1;
            @endphp
            @foreach ($studentsByClass as $class => $students)
                @foreach ($students as $student)
                    <tr>
                        <td style="border: 1px solid black; text-align: center;">{{ $index++ }}</td>
                        <td
                            style="border: 1px solid black; font-family: 'Khmer OS Battambang';{{ $student['gender'] == 'ស្រី' ? 'font-weight:bold' : '' }}">
                            {{ $student['student_name'] }}</td>
                        <td
                            style="border: 1px solid black; text-align: center;font-family: 'Khmer OS Battambang';{{ $student['gender'] == 'ស្រី' ? 'font-weight:bold' : '' }}">
                            {{ $student['gender'] }}</td>
                        <td style="border: 1px solid black; text-align: center;">
                            {{ App\Service\service::removeDotFromCode($student['class_code']) }}</td>
                        <td style="border: 1px solid black; text-align: center;">
                            Y{{ $student['year'] }}S{{ $student['semester'] }}</td>
                        <td style="border: 1px solid black; text-align: center;">{{ $student['failed_subjects_count'] }}
                        </td>
                        <td style="border: 1px solid black; text-align: center;"></td>
                        <td style="border: 1px solid black; text-align: center;"></td>
                    </tr>
                @endforeach
            @endforeach
            {{-- <tr>
                <td style="font-family: 'Khmer OS Battambang';">
                    កំណត់សម្គាល់៖ និស្សិតដែលមានវត្តមានលើស
                    ១៥ដង​&#10;ក្នុងមួយឆមាសនោះខាងដេប៉ាតឺម៉ង់មិនអនុញ្ញាតឲ្យប្រឡងឆមាសជាដាច់ខាត។
                </td>
            </tr> --}}
            <tr>
                <td colspan="8" style="font-family: 'Khmer OS Battambang';text-align:right;">
                    {{ App\Service\service::updateDateTime() }}
                </td>
            </tr>
            <tr>
                <th colspan="7" style="font-family: 'Khmer OS Muol Light';text-align:right;">
                    អ្នកធ្វើតារាង
                </th>
            </tr>
            <tr>
                <th colspan="8" style="font-family: 'Khmer OS Battambang';;text-align:center;">
                    បានឃើញ​ និងពិនិត្យត្រឹមត្រូវ
                </th>
            </tr>
            <tr>
                <th colspan="8" style="font-family: 'Khmer OS Muol Light';text-align:center;">
                    ប្រធានដេប៉ាតឺម៉ង់
                </th>
            </tr>
            <tr>
                <th colspan="3" style="font-family: 'Khmer OS Battambang';text-align:center;">
                    បានឃើញ​ និងឯកភាព
                </th>
            </tr>
            <tr>
                <th colspan="3" style="font-family: 'Khmer OS Muol Light';text-align:center;">
                    នាយករងសិក្សា
                </th>
            </tr>
        </tbody>
    </table>
