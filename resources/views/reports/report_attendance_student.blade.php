@extends('app_layout.layout')
@section('content')

    <div class="px-4 rounded-lg mb-2 print-hidden">
        <div class="flex justify-between items-center mb-4">

        <form method="GET" action="" class="mb-6 bg-gray-50 p-4 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end battambang">
                <div>
                    <label for="year" class="block mb-2 text-sm font-medium text-gray-900">ឆ្នាំសិក្សា</label>
                    <select id="year"
                        name="year"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 h-10">
                        <option value="">ជ្រើសរើសឆ្នាំសិក្សា</option>
                        @foreach ($years as $year)
                            <option value="{{ $year->code }}" {{ ($filters['year'] ?? '') == $year->code ? 'selected' : '' }}>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
  
                <div>
                    <label for="semester" class="block mb-2 text-sm font-medium text-gray-900">ឆមាស</label>
                    <select id="semester"
                        name="semester"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 h-10">
                        <option value="">ជ្រើសរើសឆមាស</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester }}" {{ ($filters['semester'] ?? '') == $semester ? 'selected' : '' }}>ឆាសទី {{ $semester }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="department" class="block mb-2 text-sm font-medium text-gray-900">ដេប៉ាតឺម៉ង់</label>
                    <select id="department"
                        name="department"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 h-10">
                        <option value="">ជ្រើសរើសដេប៉ាតឺម៉ង់</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->code }}" {{ ($filters['department'] ?? '') == $department->code ? 'selected' : '' }}>
                                {{ $department->name_2 }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">មុខវិជ្ជា</label>
                    <select id="subject"
                        name="subject"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 h-10">
                        <option value="">ជ្រើសរើសមុខវិជ្ជា</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->code }}" {{ ($filters['subject'] ?? '') == $subject->code ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="class" class="block mb-2 text-sm font-medium text-gray-900">ថ្នាក់</label>
                    <select id="class"
                        name="class"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 h-10">
                        <option value="">ជ្រើសរើសថ្នាក់</option>
                        @foreach ($classes as $class)
                            <option value="{{ $class->code }}" {{ ($filters['class'] ?? '') == $class->code ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
               
                
              
                <div>
                    <button
                        class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 khmer-moul"
                        type="submit">
                        <span class=" material-icons mr-2">ស្រង់</span> 
                    </button>
                </div>
            </div>
        </form>

        <div class="flex justify-end gap-2 mb-4 print-hidden">
            <button onclick="window.print()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Print</button>
            <button onclick="exportTableToExcel('attendance-table', 'attendance_report')"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Export Excel</button>
        </div>
        </div>
    </div>

    
    {{-- {{ dd($results[]) }} --}}
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
                        @if(isset($results[0]['months']))
                            @foreach($results[0]['months'] as $month)
                                <th class="border border-black p-2" colspan="2">
                                    ខែ {{ $month['name'] }}<br />
                                    ថ្ងៃទី{{ $month['start'] }} <br /> ដល់ថ្ងៃទី{{ $month['end'] }}
                                </th>
                            @endforeach
                        @endif
                        <th class=" border border-black p-2" colspan="2">សរុប</th>
                    </tr>
                    <tr>
                        @if(isset($results[0]['months']))
                            @foreach($results[0]['months'] as $monthKey => $month)
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
                        @php
                            $class = $results[0];
                            $row = 1;
                        @endphp
                        @foreach ($class['students'] as $student)
                            <tr>
                                <td class="border border-black p-2">{{ $row++ }}</td>
                                <td class="border border-black p-2 text-left">{{ $student['student_name'] }}</td>
                                @foreach($class['months'] as $monthKey => $month)
                                    <td class="border border-black p-2">{{ $student['monthly'][$monthKey] }}</td>
                                    <td class="border border-black p-2">-</td>
                                @endforeach
                                <td class="border border-black p-2 bg-gray-200">{{ array_sum($student['monthly']) }}</td>
                                <td class="border border-black p-2 bg-gray-200">-</td>
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
            const subjectSelect = document.getElementById('subject');
            const classSelect = document.getElementById('class');
            if (departmentSelect) {
                departmentSelect.addEventListener('change', function() {
                    const departmentCode = this.value;
                    if (!departmentCode) {
                        // Reset subjects and classes
                        subjectSelect.innerHTML = '<option value="">ជ្រើសរើសមុខវិជ្ជា</option>';
                        classSelect.innerHTML = '<option value="">ជ្រើសរើសថ្នាក់</option>';
                        return;
                    }
                    fetch(`/api/department/${departmentCode}/options`)
                        .then(response => response.json())
                        .then(data => {
                            // Update subjects
                            subjectSelect.innerHTML = '<option value="">ជ្រើសរើសមុខវិជ្ជា</option>';
                            data.subjects.forEach(function(subject) {
                                subjectSelect.innerHTML += `<option value="${subject.code}">${subject.name}</option>`;
                            });
                            // Update classes
                            classSelect.innerHTML = '<option value="">ជ្រើសរើសថ្នាក់</option>';
                            data.classes.forEach(function(cls) {
                                classSelect.innerHTML += `<option value="${cls.code}">${cls.name}</option>`;
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
