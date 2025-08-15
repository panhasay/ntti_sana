@extends('app_layout.layout')
@section('content')

<style>
    @font-face {
      font-family: 'tacteing';
      src: url('/fonts/Tacteing.ttf') format('truetype');
      font-weight: normal;
      font-style: normal;
    }
  
    .tacteing {
      font-family: 'tacteing';
    }
  </style>

    <div class="px-4 mb-4 print:hidden battambang">
        <!-- Display validation errors -->
        @if (!empty($validationErrors))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            មានបញ្ហាក្នុងការបញ្ជូនទិន្នន័យ:
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($validationErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-gray-50 p-4 rounded-lg">
            <!-- Flex container: Buttons Left, Filter Button Right -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 ">
                <!-- Buttons section (left) -->
                <div class="flex gap-2 w-full md:w-auto text-md">
                    <!-- Preview Button -->
                    {{-- <button
                        class=" py-1.5 flex items-center gap-1 border border-blue-600 text-blue-600 font-bold text-sm px-3  rounded hover:bg-blue-600 hover:text-white transition">
                        Privew
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button> --}}

                    <!-- Print Button -->
                    <button onclick="window.print()" type="button"
                        class="flex items-center gap-2 border border-cyan-400 text-cyan-400 font-bold px-4 rounded hover:bg-cyan-400 hover:text-white transition">
                        Print
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-printer">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                        </svg>
                    </button>

                    <!-- Excel Button -->
                    <button onclick="exportTableToExcel('attendance-table', 'attendance_report')" type="button"
                        class="flex items-center gap-1 border border-green-400 text-green-400 font-bold px-4 rounded hover:bg-green-400 hover:text-white transition">
                        Excel
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                        </svg>
                    </button>
                </div>
                <!-- Filter Button (right) -->
                <div class="w-full md:w-auto flex justify-end">
                    <button id="toggle-filter-btn" type="button"
                        class=" px-4 py-1.5 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 shadow focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        Filter
                    </button>
                </div>
            </div>
            <!-- Filter form section (hidden by default) -->
            <form id="filter-form" method="GET" action="" class="w-full md:w-auto hidden">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-6 gap-4 items-end">
                    <!-- Year -->
                    <div>
                        <label for="year" class="block mb-1 text-sm font-medium text-gray-900">ឆ្នាំសិក្សា</label>
                        <select id="year" name="year"
                            class="bg-white border {{ isset($validationErrors['year']) ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">ជ្រើសរើសឆ្នាំសិក្សា</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->code }}"
                                    {{ ($filters['year'] ?? '') == $year->code ? 'selected' : '' }}>
                                    {{ $year->name }}
                                </option>
                            @endforeach
                        </select>
                        @if (isset($validationErrors['year']))
                            <p class="mt-1 text-sm text-red-600">{{ $validationErrors['year'] }}</p>
                        @endif
                    </div>
                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block mb-1 text-sm font-medium text-gray-900">ឆមាស</label>
                        <select id="semester" name="semester"
                            class="bg-white border {{ isset($validationErrors['semester']) ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">ជ្រើសរើសឆមាស</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester }}"
                                    {{ ($filters['semester'] ?? '') == $semester ? 'selected' : '' }}>
                                    ឆមាសទី {{ $semester }}
                                </option>
                            @endforeach
                        </select>
                        @if (isset($validationErrors['semester']))
                            <p class="mt-1 text-sm text-red-600">{{ $validationErrors['semester'] }}</p>
                        @endif
                    </div>
                    <!-- Department -->
                    @if (Auth::user()->role == 'admin')
                        <div>
                            <label for="department" class="block mb-1 text-sm font-medium text-gray-900">ដេប៉ាតឺម៉ង់</label>
                            <select id="department" name="department"
                                class="bg-white border border-gray-300 text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">ជ្រើសរើសដេប៉ាតឺម៉ង់</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->code }}"
                                        {{ ($filters['department'] ?? '') == $department->code ? 'selected' : '' }}>
                                        {{ $department->name_2 }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <!-- Class -->
                    <div>
                        <label for="class" class="block mb-1 text-sm font-medium text-gray-900">ថ្នាក់</label>
                        <select id="class" name="class"
                            class="bg-white border {{ isset($validationErrors['class']) ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-lg w-full h-10 px-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">ជ្រើសរើសថ្នាក់</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->code }}"
                                    {{ ($filters['class'] ?? '') == $class->code ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                        @if (isset($validationErrors['class']))
                            <p class="mt-1 text-sm text-red-600">{{ $validationErrors['class'] }}</p>
                        @endif
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
        </div>
    </div>





    {{-- {{ dd($results) }} --}}
    <div id="print-area" class="bg-white p-12">


            <div class="flex justify-between items-start ">
                <!-- Left: Ministry and Institution -->
                <div class="text-start space-y-2 pt-9 ">
                    <div class="moul text-base font-bold leading-tight">វិទ្យាស្ថានជាតិបណ្តុះបណ្តាលបច្ចេកទេស</div>
                    @if (!empty($filters['department']))
                        <div class="moul text-base font-bold leading-tight">
                            {{ $departments->firstWhere('code', $filters['department'])->name_2 ?? '' }}
                        </div>
                    @else
                        <div class="moul text-base font-bold leading-tight"></div>
                    @endif

                    <div ><span class="tacteing ml-15 text-3xl">3</span></div>
                </div>
                <!-- Right: Country and Motto -->
                <div class="text-end space-y-2 ">
                    <div class="moul text-base font-bold leading-tight mr-4">ព្រះរាជាណាចក្រកម្ពុជា</div>
                    <div class="moul text-base font-bold leading-tight ">ជាតិ សាសនា ព្រះមហាក្សត្រ</div>
                    <div><span class=" tacteing text-3xl mr-15">3</span></div>
                </div>
            </div>

        <div class="text-center mb-2 gap-2 flex flex-col items-center">
            <h3 class="moul text-md font-bold">បញ្ជីសរុបអវត្តមានប្រចាំឆមាសទី{{ $filters['khmer_semester'] }} ឆ្នាំទី
                {{ $filters['khmer_year_level'] }}</h3>
            <h3 class="moul text-md font-bold">ថ្នាក់: {{ $filters['qualification'] }} ជំនាញ៖​
                {{ $filters['skill_name'] }} ក្រុម៖ {{ $filters['class'] }} វេន{{ $filters['section_name'] }}</h3>
            <h4 class="moul text-md font-bold">ឆ្នាំសិក្សា {{ $filters['khmer_year'] }}</h4>
        </div>
        <div >
            <table id="attendance-table" class="w-full table-auto border border-black text-center battambang">
                <thead class="bg-gray-200">
                    <tr>
                        <th class=" border border-black p-2" rowspan="2">ល.រ</th>
                        <th class=" border border-black p-2" rowspan="2">ឈ្មោះសិស្ស-នាម</th>
                        @if (isset($months))
                            @foreach ($months as $month)
                                <th class="border border-black p-2" colspan="2">
                                    {{ $month['name'] }}<br />
                                    {{ $month['start'] }} <br /> {{ $month['end'] }}
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
                                $sum_absent = $student['total_absent'] + $student['total_permission'] / 2;
                                $highlight = $sum_absent > 15;
                            @endphp
                            <tr @if ($highlight) class="bg-red-300" @endif>
                                <td class="border border-black ">{{ $loop->iteration }}</td>
                                <td class="border border-black  text-left">{{ $student['student_name'] }}</td>
                                @foreach ($months as $monthKey => $month)
                                    <td class="border border-black ">{{ $student['monthly'][$monthKey]['absent'] }}
                                    </td>
                                    <td class="border border-black ">{{ $student['monthly'][$monthKey]['permission'] }}
                                    </td>
                                @endforeach
                                <td class="border border-black  {{ $highlight ? 'bg-red-300' : 'bg-gray-200' }}">
                                    {{ $student['total_absent'] }}</td>
                                <td class="border border-black  {{ $highlight ? 'bg-red-300' : 'bg-gray-200' }}">
                                    {{ $student['total_permission'] }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- Note: print only, centered -->
        <div class=" mt-2 hidden print:block text-2xs ">
            <span class="battambang-bold">កំណត់សម្គាល់៖</span>
            <span class="battambang">និស្សិតដែលមានអវត្តមានសរុបលើស ១៥ដង ក្នុងមួយឆមាសនោះដេប៉ាតឺម៉ង់មិនអនុញ្ញាតអោយប្រឡងឆមាសជាដាច់ខាត។</span>
        </div>
        <!-- Footer: print only, 3 columns -->
        <div class="hidden print:flex justify-between mt-16 px-8 w-full text-sm">
            <!-- Left: Prepared by -->
            <div class="flex-1 text-center">
                <div class="battambang">បានត្រួតពិនិត្យ និងអនុម័ត</div>
                <div class="moul font-bold">ប្រធានផ្នែកបណ្តុះបណ្តាល</div>

            </div>
            <!-- Center: Date and Director -->
            <!-- Right: Created by -->
            <div class="flex-1 text-center">
                <div class="battambang">បានរៀបចំ និងត្រួតពិនិត្យត្រឹមត្រូវ</div>
                <div class="moul font-bold">ប្រធានមុខវិជ្ជា</div>

            </div>
            <div class="flex-1 text-center">
                <div class="battambang">ភ្នំពេញ ថ្ងៃទី ...... ខែ ...... ឆ្នាំ .........</div>
                <div class="battambang">រាជធានីភ្នំពេញ,​ ថ្ងៃទី​​.....ខែ........ឆ្នាំ២០... </div>
                <div class="moul font-bold underline">អ្នកធ្វើតារាង</div>
            </div>
        </div>
    </div>

    <script>
        function exportTableToExcel(tableID, filename = '') {
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML;
            
            // Add Excel-specific styling for borders
            var excelHTML = tableHTML.replace(/<table/g, '<table style="border-collapse: collapse;"');
            excelHTML = excelHTML.replace(/<th/g, '<th style="border: 1px solid black; padding: 8px; background-color: #f0f0f0; font-weight: bold;"');
            excelHTML = excelHTML.replace(/<td/g, '<td style="border: 1px solid black; padding: 8px;"');
            
            // Create a temporary container to apply styles
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = excelHTML;
            
            // Apply border styles to all cells
            var cells = tempDiv.querySelectorAll('th, td');
            cells.forEach(function(cell) {
                cell.style.border = '1px solid black';
                cell.style.padding = '8px';
                if (cell.tagName === 'TH') {
                    cell.style.backgroundColor = '#f0f0f0';
                    cell.style.fontWeight = 'bold';
                }
            });
            
            // Get the styled HTML
            var styledHTML = tempDiv.innerHTML;
            
            // Create Excel file content with proper formatting
            var excelContent = `
                <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
                <head>
                    <meta charset="UTF-8">
                    <style>
                        table { border-collapse: collapse; width: 100%; font-family: 'Battambang', Arial, sans-serif; }
                        th, td { border: 1px solid black; padding: 8px; text-align: center; font-family: 'Battambang', Arial, sans-serif; }
                        th { background-color: #f0f0f0; font-weight: bold; font-family: 'Battambang', Arial, sans-serif; }
                        .text-left { text-align: left; }
                        .bg-red-300 { background-color: #fecaca; }
                        .bg-gray-200 { background-color: #e5e7eb; }
                    </style>
                </head>
                <body style="font-family: 'Battambang', Arial, sans-serif;">
                    ${styledHTML}
                </body>
                </html>
            `;
            
            // Create download link
            var downloadLink = document.createElement("a");
            var dataType = 'application/vnd.ms-excel';
            filename = filename ? filename + '.xls' : 'excel_data.xls';
            
            // For modern browsers
            var blob = new Blob(['\ufeff', excelContent], { type: dataType });
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = filename;
            downloadLink.click();
            
            // Clean up
            URL.revokeObjectURL(downloadLink.href);
        }

        // Toggle filter form visibility
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtn = document.getElementById('toggle-filter-btn');
            const filterForm = document.getElementById('filter-form');
            filterBtn.addEventListener('click', function() {
                filterForm.classList.toggle('hidden');
            });

            // Show filter form for all users if they have a default class selected
            @if (!empty($filters['class']))
                // Show the filter form to display the selected filters
                filterForm.classList.remove('hidden');
            @endif

            // Dynamic filter for class by department
            const departmentSelect = document.getElementById('department');
            const classSelect = document.getElementById('class');
            if (departmentSelect) {
                departmentSelect.addEventListener('change', function() {
                    const departmentCode = this.value;
                    if (!departmentCode) {
                        // Reset classes
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
                font-size: 14px
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

            /* Ensure header positioning is consistent in print */
            #print-area .flex.justify-between.items-start {
                margin-top: 0 !important;
                padding-top: 0 !important;
                margin-bottom: 20px !important;
            }

            .print-hidden {
                display: none !important;
            }
        }
    </style>

@endsection
