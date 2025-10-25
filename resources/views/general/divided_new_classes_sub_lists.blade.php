<style>
    @media print {
        @page {
            size: A4 landscape;
            margin: 07mm;
        }

        .general-print>th {
            border: 1px solid #333;
            font-family: 'Khmer OS Battambang';
            padding: 3px;
            font-size: 10.5px !important
        }

        .general-print>td {
            padding: 1px;
            border: 1px solid #333;
            font-family: 'Khmer OS Battambang';
            font-size: 10.5px !important
        }

        .general-print>td>div {
            padding: 1px;
            font-family: 'Khmer OS Battambang';
            font-size: 12px !important;
        }

        .general-prints>th> {
            font-family: 'Khmer OS Battambang';
            font-size: 12px !important;
            border: 1px solid #333;
        }

        .table-print {
            width: 95%;
            margin: auto !important
        }

        .table-print-sm {
            width: 40%;
            margin: auto !important
        }
    }
</style>
@if ($is_print ?? '' == 'Yes')
    <div class="row align-items-start">
        <div class="col-5 text-center KhmerOSMuolLight"><br>
            ក្រសួងការងារ និងបណ្តុះបណ្តាលវិជ្ជាជីវៈ<br>
            វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស
        </div>
        <div class="col-2">
        </div>
        <div class="col-5 text-center KhmerOSMuolLight">
            ព្រះរាជាណាចក្រកម្ពុជា<br>
            ជាតិ សាសនា ព្រះមហាក្សត្រ
        </div>
    </div><br>
    <div class="row align-items-start">
        <div class="col-12 text-center KhmerOSMuolLight">
            តារាងវិភាគសិក្សាបង្រៀន ឆមាសទី {{ $records->semester ?? '' }} ឆ្នាំទី {{ $records->years ?? '' }}
            ​​ឆ្នាំសិក្សា {{ $records->session_year_code ?? '' }} តារាងពិន្ទុ ក្រុម {{ $header->class_code ?? '' }}
        </div>
    </div>
    <div class="row align-items-start">
        <div class="col-12 text-center KhmerOSMuolLight">
            ថ្នាក់ {{ $records->qualification ?? '' }} ជំនាញ {{ $records->skill->name_2 ?? '' }} ក្រុម
            {{ $records->class_code ?? '' }} វេន​ {{ $records->section->name_2 ?? '' }}
        </div>
    </div>
    <div class="row">
        <table class="table-print">
            <thead>
                <tr class="general-print">
                    <th class="text-center" rowspan="2" width="10">ល.រ</th>
                    <th class="text-center" rowspan="2" width="120">សាស្រ្តាចារ្យ 123456</th>
                    <th class="text-center" colspan="2">ចន្ទ</th>
                    <th class="text-center" colspan="2">អង្គា</th>
                    <th class="text-center" colspan="2">ពុធ</th>
                    <th class="text-center" colspan="2">ព្រហស្បត៏</th>
                    <th class="text-center" colspan="2">សុក្រ</th>
                    <th class="text-center" colspan="2">សៅរ៏ </th>
                </tr>
                <tr class="general-print">
                    @foreach ($record_sub_lines->take(6) as $time)
                        <th class="text-center">{{ $time->start_time ?? '' }}</th>
                        <th class="text-center">{{ $time->end_time ?? '' }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody id="recordsLineTableBody">
                <?php
                $index = 1;
                $daysOfWeek = ['monday' => 2, 'tuesday' => 4, 'wednesday' => 6, 'thursday' => 8, 'friday' => 10, 'saturday' => 12];
                ?>
                @foreach ($record_sub_lines as $record)
                    @foreach ($daysOfWeek as $day => $subjectCol)
                        @if ($record->date_name == $day)
                            <tr class="general-print">
                                <td class="text-center" rowspan="" width="10">{{ $index++ }}</td>
                                <td class="text-left" rowspan="">
                                    <div>{{ $record->teacher->name_2 ?? '' }}</div>
                                </td>
                                @for ($i = 2; $i <= 12; $i += 2)
                                    @if ($i == $subjectCol)
                                        {{-- Display the subject name in the correct column based on the day --}}
                                        <td class="text-center" colspan="2">
                                            {{ $record->subject->name ?? '' }}
                                            &nbsp;<span style="font-size: 9px !important;">
                                                {{ $record->room ?? '' }}</span>
                                        </td>
                                    @else
                                        {{-- Leave other columns empty --}}
                                        <td class="text-left" colspan="2"></td>
                                    @endif
                                @endfor
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div class="row align-items-start mt-1">
            <div class="col-5 text-center KhmerOSMuolLight"><br><br><br>
                បានឃើញនិងឯកភាព<br />
                នារយករងសិក្សា
            </div>
            <div class="col-2"></div>
            <div class="col-5 text-center khmer_os_b">
                <div class="p-3" style="margin-left: 30px !important;">
                    {{ App\Service\service::updateDateTime() ?? '' }}</div>
                <div class="KhmerOSMuolLight">នាយករងសិក្សា</div>
            </div>
        </div>
    </div>
@else
    <div class="control-table table-responsive custom-data-table-wrapper2">
        <table class="table table-striped">
            <thead>
                <tr class="general-data">
                    <th width="50"></th>
                    <th width="10">អត្តលេខ</th>
                    <th width="50">គោត្តនាម និងនាម</th>
                    <th width="50">ឈ្មោះជាឡាតាំង</th>
                    <th>ភេទ</th>
                    <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                    {{-- <th>ទីកន្លែងកំណើត</th> --}}
                    <th width="20">លេខទូរស័ព្ទ</th>
                    <th>ក្រុម/ថា្នក់</th>
                    <th>ជំនាញ</th>
                    <th>កម្រិត</th>
                    <th>វេនសិក្សា</th>
                    <th>ដេប៉ាដេម៉ង់</th>
                    <th>ឆ្នាំសិក្សា</th>
                    <th>អាហារបករណ៍%</th>
                    <th>ប្រភពអាហារបករណ៍</th>
                    <th width="200">ផ្សេងៗ</th>
                </tr>
            </thead>
            <tbody class="data-list-studnet">
                @foreach ($record_sub_lines as $record)
                    @include('general.divided_new_classes_sub_record')
                @endforeach
            </tbody>
        </table>
    </div>
@endif
<br><br>
