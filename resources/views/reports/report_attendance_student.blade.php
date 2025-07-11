@extends('app_layout.layout')
@section('content')

<div class="px-4 mb-4 print:hidden battambang">
    <div class="bg-gray-50 p-4 rounded-lg">
        <!-- Flex container: Filters Left, Buttons Right -->
        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
            
            <!-- Filter form section (left) -->
            <form method="GET" action="" class="w-full md:w-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 items-end">
                    <!-- Year -->
                    <div>
                        <label for="year" class="block mb-1 text-sm font-medium text-gray-900">ឆ្នាំសិក្សា</label>
                        <select id="year" name="year"
                            class="bg-white border border-gray-300 text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">ជ្រើសរើសឆ្នាំសិក្សា</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->code }}" {{ ($filters['year'] ?? '') == $year->code ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block mb-1 text-sm font-medium text-gray-900">ឆមាស</label>
                        <select id="semester" name="semester"
                            class="bg-white border border-gray-300 text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">ជ្រើសរើសឆមាស</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester }}" {{ ($filters['semester'] ?? '') == $semester ? 'selected' : '' }}>
                                    ឆមាសទី {{ $semester }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Department -->
                    <div>
                        <label for="department" class="block mb-1 text-sm font-medium text-gray-900">ដេប៉ាតឺម៉ង់</label>
                        <select id="department" name="department"
                            class="bg-white border border-gray-300 text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">ជ្រើសរើសដេប៉ាតឺម៉ង់</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->code }}" {{ ($filters['department'] ?? '') == $department->code ? 'selected' : '' }}>
                                    {{ $department->name_2 }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Class -->
                    <div>
                        <label for="class" class="block mb-1 text-sm font-medium text-gray-900">ថ្នាក់</label>
                        <select id="class" name="class"
                            class="bg-white border border-gray-300 text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">ជ្រើសរើសថ្នាក់</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->code }}" {{ ($filters['class'] ?? '') == $class->code ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Search Button -->
                    <div class="flex items-end h-full">
                        <button type="submit"
                            class="w-full h-10 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            ស្វែងរក
                        </button>
                    </div>
                </div>
            </form>

            <!-- Buttons section (right) -->
            <div class="flex gap-2">
                <button onclick="window.print()" type="button"
                    class="h-10 px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 shadow focus:outline-none focus:ring-2 focus:ring-green-400 flex items-center gap-2">
                    Print
                </button>
                <button onclick="exportTableToExcel('attendance-table', 'attendance_report')" type="button"
                    class="h-10 px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 shadow focus:outline-none focus:ring-2 focus:ring-blue-400 flex items-center gap-2">
                    <!-- Download SVG icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                    </svg>
                    Export Excel
                </button>
            </div>
        </div>
    </div>
</div>





    {{-- {{ dd($results) }} --}}
    <div id="print-area" class="bg-white p-12 rounded shadow">
        <div class="text-center mb-2 gap-2 flex flex-col items-center">
            <h3 class="moul text-md font-bold">បញ្ជីសរុបអវត្តមានប្រចាំឆមាសទី១ ឆ្នាំទី១</h3>
            <h3 class="moul text-md font-bold">ថ្នាក់: បរិញ្ញាបត្រ ជំនាញ៖​ ព័ត៌មានវិទ្យា ក្រុម៖ IT07B វេនយប់</h3>
            <h4 class="moul text-md font-bold">ឆ្នាំសិក្សា ២០២៣-២០២៤</h4>
        </div>
        <div class="overflow-x-auto">
            <table id="attendance-table" class="w-full table-auto border border-black text-center battambang">
                <thead class="bg-gray-200">
                    <tr>
                        <th class=" border border-black p-2" rowspan="2">ល.រ</th>
                        <th class=" border border-black p-2" rowspan="2">ឈ្មោះសិស្ស-នាម</th>
                        @if (isset($months))
                            @foreach ($months as $month)
                                <th class="border border-black p-2" colspan="2">
                                    ខែ {{ $month['name'] }}<br />
                                    ថ្ងៃទី{{ $month['start'] }} <br /> ដល់ថ្ងៃទី{{ $month['end'] }}
                                </th>
                            @endforeach
                        @endif
                        <th class=" border border-black p-2" colspan="2">សរុប</th>
                    </tr>
                    <tr>
                        @if (isset($months))
                            @foreach ($months as $monthKey => $month)
                                <th class="border border-black p-2">ឥ.ច</th>
                                <th class="border border-black p-2">ម.ច</th>
                            @endforeach
                        @endif
                        <th class="border border-black p-2">ឥ.ច</th>
                        <th class="border border-black p-2">ម.ច</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($results) > 0)
                        @foreach ($results as $student)
                            @php
                                $sum_absent = $student['total_absent'] + ($student['total_permission'] / 2);
                                $highlight = $sum_absent > 4;
                            @endphp
                            <tr @if($highlight) class="bg-red-300" @endif>
                                <td class="border border-black p-2">{{ $loop->iteration }}</td>
                                <td class="border border-black p-2 text-left">{{ $student['student_name'] }}</td>
                                @foreach ($months as $monthKey => $month)
                                    <td class="border border-black p-2">{{ $student['monthly'][$monthKey]['absent'] }}</td>
                                    <td class="border border-black p-2">{{ $student['monthly'][$monthKey]['permission'] }}</td>
                                @endforeach
                                <td class="border border-black p-2 {{ $highlight ? 'bg-red-300' : 'bg-gray-200' }}">{{ $student['total_permission'] }}</td>
                                <td class="border border-black p-2 {{ $highlight ? 'bg-red-300' : 'bg-gray-200' }}">{{ $student['total_absent'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                downloadLink.download = filename;
                downloadLink.click();
            }
        }

        // Dynamic filter for subject and class by department
        document.addEventListener('DOMContentLoaded', function() {
            const departmentSelect = document.getElementById('department');
            const classSelect = document.getElementById('class');
            if (departmentSelect) {
                departmentSelect.addEventListener('change', function() {
                    const departmentCode = this.value;
                    if (!departmentCode) {
                        // Reset subjects and classes
                        classSelect.innerHTML = '<option value="">ជ្រើសរើសថ្នាក់</option>';
                        return;
                    }
                    fetch(`/api/department/${departmentCode}/options`)
                        .then(response => response.json())
                        .then(data => {
                            // Update classes
                            classSelect.innerHTML = '<option value="">ជ្រើសរើសថ្នាក់</option>';
                            data.classes.forEach(function(cls) {
                                classSelect.innerHTML +=
                                    `<option value="${cls.code}">${cls.name}</option>`;
                            });
                        });
                });
            }
        });
    </script>

    <style>
        @media print {
            body * {
                visibility: hidden !important;
                padding-left: 10px !important;
            }

            #print-area,
            #print-area * {
                visibility: visible !important;

            }

            #print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100vw;
                background: white;
                z-index: 9999;
                padding: 0;
                margin: 0;
            }

            .print-hidden {
                display: none !important;
            }

            #print-area table,
            #print-area th,
            #print-area td {
                border: 1px solid #000 !important;
                border-collapse: collapse !important;

            }


        }
    </style>

@endsection
