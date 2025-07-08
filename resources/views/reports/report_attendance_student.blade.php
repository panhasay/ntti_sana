@extends('app_layout.layout')
@section('content')

    <head>
        <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Koulen&amp;family=Moul&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>

        <style>
            .tbody {
                font-family: 'Koulen', sans-serif;
            }

            .khmer-moul {
                font-family: 'Moul', serif;
            }

            .table-bordered,
            .table-bordered th,
            .table-bordered td {
                border: 1px solid black;
            }
        </style>
    </head>


        <div class="max-w-7xl mx-auto px-8 rounded-lg shadow-lg mb-2 ">
            <form method="GET" action="" class="mb-6 bg-gray-50 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 khmer-moul" for="year">ឆ្នាំសិក្សា</label>
                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" id="year" name="year">
                            <option value="">--</option>
                            @foreach($years as $year)
                                <option value="{{ $year->code }}" {{ ($filters['year'] ?? '') == $year->code ? 'selected' : '' }}>{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 khmer-moul" for="semester">ឆមាស</label>
                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" id="semester" name="semester">
                            <option value="">--</option>
                            @foreach($semesters as $semester)
                                <option value="{{ $semester }}" {{ ($filters['semester'] ?? '') == $semester ? 'selected' : '' }}>{{ $semester }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 khmer-moul" for="department">ដេប៉ាតឺម៉ង់</label>
                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" id="department" name="department">
                            <option value="">--</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->code }}" {{ ($filters['department'] ?? '') == $department->code ? 'selected' : '' }}>{{ $department->name_2 }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 khmer-moul" for="subject">មុខវិជ្ជា</label>
                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" id="subject" name="subject">
                            <option value="">--</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->code }}" {{ ($filters['subject'] ?? '') == $subject->code ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 khmer-moul" for="class">ថ្នាក់</label>
                        <select class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" id="class" name="class">
                            <option value="">--</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->code }}" {{ ($filters['class'] ?? '') == $class->code ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 khmer-moul" type="submit">
                            <span class="material-icons mr-2">filter_alt</span> ត្រង
                        </button>
                    </div>
                </div>
            </form>
           
        </div>

        {{-- {{ dd($results) }} --}}
 
        <div class="max-w-7xl mx-auto bg-white p-20 rounded-lg shadow-lg">
            <div class="flex justify-end mb-4 gap-2">
                <button onclick="window.print()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Print</button>
                <button onclick="exportTableToExcel('attendance-table', 'attendance_report')" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Export Excel</button>
            </div>
            <div class="flex justify-between items-start mb-6">
                <div class="text-center">
                <h2 class="font-bold khmer-moul">ក្រសួងអប់រំ យុវជន និងកីឡា</h2>
                <h3 class="font-bold khmer-moul">មន្ទីរអប់រំ យុវជន និងកីឡា</h3>
                <h3 class="font-bold khmer-moul">រាជធានីភ្នំពេញ</h3>
                <hr class="border-black my-1 w-24 mx-auto"/>
                </div>
                <div class="text-center">
                <h2 class="font-bold khmer-moul">ព្រះរាជាណាចក្រកម្ពុជា</h2>
                <h3 class="font-bold khmer-moul">ជាតិ សាសនា ព្រះមហាក្សត្រ</h3>
                <hr class="border-black my-1 w-32 mx-auto"/>
                </div>
                </div>
                <div class="text-center mb-6">
                <h2 class="text-lg font-bold khmer-moul">បញ្ជីអវត្តមានសិស្សប្រចាំខែធ្នូ</h2>
                <h3 class="text-md font-bold khmer-moul">ថ្នាក់: បរិញ្ញាបត្រ ជំនាន់ទី៧ អគារមជ្ឈមណ្ឌលទ្រព្យ ក្រុមB វេនល្ងាច</h3>
                <h4 class="text-md font-bold khmer-moul">ឆ្នាំសិក្សា ២០២៣-២០២៤</h4>
                </div>
        @if(count($results) > 0)
        @php $class = $results[0]; @endphp
        <div class="mb-8">
            <div class="mb-4">
                <h3 class="text-lg font-bold khmer-moul">ថ្នាក់: {{ $class['class_info']->class_code ?? '-' }} | {{ $class['class_info']->name ?? '' }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table id="attendance-table" class="w-full text-center table-auto table-bordered border-collapse">
                    <thead class="bg-gray-50 ">
                        <tr>
                            <th class="p-2" rowspan="2">ល.រ</th>
                            <th class="p-2" rowspan="2">ឈ្មោះសិស្ស-នាម</th>
                            <th class="p-2" colspan="2">ខែ សីហា <br /> ថ្ងៃទី០២ <br /> ដល់ថ្ងៃទី១៦</th>
                            <th class="p-2" colspan="2">ខែ កញ្ញា <br /> ថ្ងៃទី០៣ <br /> ដល់ថ្ងៃទី១៧</th>
                            <th class="p-2" colspan="2">ខែ តុលា <br /> ថ្ងៃទី០១ <br /> ដល់ថ្ងៃទី១៥</th>
                            <th class="p-2" colspan="2">ខែ វិច្ឆិកា <br /> ថ្ងៃទី០១ <br /> ដល់ថ្ងៃទី១៥</th>
                            <th class="p-2" colspan="2">ខែ ធ្នូ <br /> ថ្ងៃទី០១ <br /> ដល់ថ្ងៃទី១៥</th>
                            <th class="p-2" colspan="2">សរុប</th>
                        </tr>
                        <tr>
                            <th class="p-2">អ.ច</th>
                            <th class="p-2">អ.គ</th>
                            <th class="p-2">អ.ច</th>
                            <th class="p-2">អ.គ</th>
                            <th class="p-2">អ.ច</th>
                            <th class="p-2">អ.គ</th>
                            <th class="p-2">អ.ច</th>
                            <th class="p-2">អ.គ</th>
                            <th class="p-2">អ.ច</th>
                            <th class="p-2">អ.គ</th>
                            <th class="p-2">អ.ច</th>
                            <th class="p-2">អ.គ</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        @php $row = 1; @endphp
                        @foreach($class['students'] as $student)
                            <tr>
                                <td class="p-2">{{ $row++ }}</td>
                                <td class="p-2 text-left">{{ $student['student_name'] }}</td>
                                <td class="p-2">{{ $student['monthly']['08'] }}</td>
                                <td class="p-2">-</td>
                                <td class="p-2">{{ $student['monthly']['09'] }}</td>
                                <td class="p-2">-</td>
                                <td class="p-2">{{ $student['monthly']['10'] }}</td>
                                <td class="p-2">-</td>
                                <td class="p-2">{{ $student['monthly']['11'] }}</td>
                                <td class="p-2">-</td>
                                <td class="p-2">{{ $student['monthly']['12'] }}</td>
                                <td class="p-2">-</td>
                                <td class="p-2">{{ array_sum($student['monthly']) }}</td>
                                <td class="p-2">-</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
@endif

</div>

<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    filename = filename?filename+'.xls':'excel_data.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>


@endsection
