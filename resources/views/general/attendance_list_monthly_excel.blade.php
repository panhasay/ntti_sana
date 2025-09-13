<table>
    <thead>
        <tr>
            <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: right;">
                ព្រះរាជាណាចក្រកម្ពុជា
            </th>
        </tr>
        <tr>
            <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: right;">
                ជាតិ សាសនា ព្រះមហាក្សត្រ
            </th>
        </tr>

        <tr>
            <th colspan="3" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                វិទ្យាស្ថានជាតិបណ្ដុះបណ្ដាលបច្ចេកទេស
            </th>
        </tr>
        <tr>
            <th colspan="3" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                ដេប៉ាតឺម៉ង់ព័ត៌មានវិទ្យា
            </th>
        </tr>
        <tr>
            @foreach ($attendanceMonths as $month)
                <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                    បញ្ជីសរុបវត្តមានប្រចាំខែ {{ \App\Service\Service::getMonthKhmer($month->att_month - 1) }}
                </th>
            @endforeach
        </tr>
        <tr>
            <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                ថ្នាក់៖ {{ $records->first()->qualification ?? '' }}
                ជំនាញ៖ {{ $section_name ?? '' }}
                ក្រុម៖ {{ \App\Service\Service::removeDotFromCode($classCode ?? '') }}
                វេន៖ {{ $skill_name ?? '' }}
            </th>
        </tr>
        <tr>
            <th colspan="6" style="font-family: 'Khmer OS Muol Light'; text-align: center;">
                ឆ្នាំសិក្សា៖ {{ \App\Service\Service::formatSessionYearToKhmer($session_year_code ?? '') }}
            </th>
        </tr>
        <tr>
            <th rowspan="2" width="5"
                style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center; vertical-align: middle;border: 1px solid black;">
                ល.រ
            </th>
            <th rowspan="2" width="20"
                style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center; vertical-align: middle;border: 1px solid black;">
                គោត្តនាម-នាម
            </th>
            @foreach ($attendanceMonths as $month)
                <th colspan="2" width="20"
                    style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                    ខែ {{ \App\Service\Service::getMonthKhmer($month->att_month - 1) }}
                    ចាប់ពីថ្ងៃ {{ \App\Service\Service::convertToKhmerNumerals($month->start_day) }} ដល់
                    {{ \App\Service\Service::convertToKhmerNumerals($month->end_day) }}
                </th>
            @endforeach
            <th colspan="2"
                style="font-weight: bold; font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                សរុប
            </th>
        </tr>
        <tr>
            @foreach ($attendanceMonths as $month)
                <th width='20'
                    style="font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">ឥ.ច</th>
                <th width='20'
                    style="font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">ម.ច</th>
            @endforeach
            <th width= '20' style="font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                ឥ.ច</th>
            <th width='20' style="font-family: 'Khmer OS Battambang'; text-align: center;border: 1px solid black;">
                ម.ច</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $index => $student)
            @php
                $monthly = $records->where('code', $student->code);
                $total_absent = 0;
                $total_permission = 0;
            @endphp
            <tr>
                <td style="border: 1px solid black; text-align: center;">
                    {{ $index + 1 }}
                </td>
                <td
                    style="border: 1px solid black; font-family: 'Khmer OS Battambang';{{ $student->gender == 'ស្រី' ? 'font-weight:bold' : '' }}">
                    {{ $student->name_2 }}
                </td>

                @foreach ($attendanceMonths as $month)
                    @php
                        $data = $monthly
                            ->where('att_month', $month->att_month)
                            ->where('att_year', $month->att_year)
                            ->first();
                        $absent = $data->total_absent ?? 0;
                        $permission = $data->total_permission ?? 0;
                        $total_absent += $absent;
                        $total_permission += $permission;
                    @endphp
                    <td style="border: 1px solid black; text-align: center;">
                        {{ $absent }}
                    </td>
                    <td style="border: 1px solid black; text-align: center;">
                        {{ $permission }}
                    </td>
                @endforeach
                <td
                    style="border: 1px solid black; text-align: center; {{ $total_absent > 15 ? 'background-color:red;color:white' : '' }}">
                    {{ $total_absent }}
                </td>
                <td
                    style="border: 1px solid black; text-align: center; {{ $total_absent > 15 ? 'background-color:red;color:white' : '' }}">
                    {{ $total_permission }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td style="font-family: 'Khmer OS Battambang';">
                កំណត់សម្គាល់៖ និស្សិតដែលមានវត្តមានលើស ១៥ដង​
                ក្នុងមួយឆមាសនោះខាងដេប៉ាតឺម៉ង់មិនអនុញ្ញាតឲ្យប្រឡងឆមាសជាដាច់ខាត។
            </td>
        </tr>
        <tr>
            <td colspan="6" style="font-family: 'Khmer OS Battambang';text-align:right;">
                {{ App\Service\service::updateDateTime() }}
            </td>
        </tr>
        <tr>
            <th colspan="5" style="font-family: 'Khmer OS Muol Light';text-align:right;">
                អ្នកធ្វើតារាង
            </th>
        </tr>
        <tr>
            <th colspan="6" style="font-family: 'Khmer OS Battambang';;text-align:center;">
                បានឃើញ​ និងពិនិត្យត្រឹមត្រូវ
            </th>
        </tr>
        <tr>
            <th colspan="6" style="font-family: 'Khmer OS Muol Light';text-align:center;">
                ប្រធានដេប៉ាតឺម៉ង់
            </th>
        </tr>
        <tr>
            <th colspan="2" style="font-family: 'Khmer OS Battambang';text-align:center;">
                បានឃើញ​ និងឯកភាព
            </th>
        </tr>
        <tr>
            <th colspan="2" style="font-family: 'Khmer OS Muol Light';text-align:center;">
                នាយករងសិក្សា
            </th>
        </tr>
    </tbody>
</table>
