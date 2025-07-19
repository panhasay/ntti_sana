<div class="container mx-auto">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
@extends('app_layout.layout')
@section('content')
    <style>
        body {
            font-family: 'Battambang', system-ui, sans-serif;

        }

        .attendance-btn.active {
            background-color: #000;
            color: white;
            border: none;
        }

        .py-2 {
            padding-top: .5rem !important;
            padding-bottom: .5rem !important;
            font-size: 15px !important;
        }
    </style>
    <div class="max-w-full md:max-w-3xl lg:max-w-5xl xl:max-w-6xl 2xl:max-w-[83rem] mx-auto md:px-4 py-6 flex-1 w-full">
        <div class=" p-2 space-y-2 md:space-y-6  ">

            <nav class="flex items-center text-sm mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="/attendance/dashboards-attendance"
                            class="inline-flex items-center text-gray-500 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" />
                            </svg>
                            <span class="text-gray-700 font-semibold">បញ្ជីវត្តមានសិស្ស</span>
                        </div>
                    </li>
                </ol>
            </nav>


            <!-- Add Filter Panel -->
            {{-- <div id="filter-panel" class=" mt-2 p-4 bg-white border rounded-lg ">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">ថ្នាក់</label>
                    <select class="w-full px-3 py-2 border rounded-lg">
                        <option>ទាំងអស់</option>
                        <!-- Add your grade options here -->
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">ផ្នែក</label>
                    <select class="w-full px-3 py-2 border rounded-lg">
                        <option>ទាំងអស់</option>
                        <!-- Add your section options here -->
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">ស្ថានភាព</label>
                    <select class="w-full px-3 py-2 border rounded-lg">
                        <option>ទាំងអស់</option>
                        <option>វត្តមាន</option>
                        <option>អវត្តមាន</option>
                        <option>ច្បាប់</option>
                    </select>
                </div>
            </div>
        </div> --}}

            <!-- Class Information Card -->
            <div class="bg-white rounded-xl border p-6 mb-6 shadow-sm">
                <div class="flex justify-between text-lg font-semibold">
                    <h2 class="text-2xl font-bold mb-4">ព័ត៌មានថ្នាក់</h2>
                    កាលបរិច្ឆេទ: {{ isset($_GET['date']) ? $_GET['date'] : date('Y-m-d') }}
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div class="flex items-center">
                        <div>
                            <div class="text-xs text-gray-400 font-medium">ថ្នាក់</div>
                            <div class="font-semibold text-black">{{ $header->class_code ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <div class="text-xs text-gray-400 font-medium">គ្រូបង្រៀន</div>
                            <div class="font-semibold text-black">{{ $header->teacher->name_2 ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <div class="text-xs text-gray-400 font-medium">មុខវិជ្ជា</div>
                            <div class="font-semibold text-black">{{ $header->subject->name ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <div class="text-xs text-gray-400 font-medium">ម៉ោងបង្រៀន</div>
                            <div class="font-semibold text-black">
                                {{ ($header->start_time ?? '') . ($header->end_time ? ' - ' . $header->end_time : '') }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <div class="text-xs text-gray-400 font-medium">បន្ទប់</div>
                            <div class="font-semibold text-black">{{ $header->room ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div>
                            <div class="text-xs text-gray-400 font-medium">វេន</div>
                            <div class="font-semibold text-black">{{ $header->section->name_2 ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-3  md:grid-cols-5 gap-1 sm:gap-2 w-full">
                <div class="flex-1 p-2 sm:p-5 bg-blue-50 rounded-lg border">
                    <div class="text-sm font-medium">សរុប</div>
                    <div class="flex flex-row items-center justify-center gap-1">

                        <span class="text-xl sm:text-4xl font-bold ">{{ $records->count() }}</span>
                        <span class="text-sm sm:text-md font-bold ">នាក់</span>
                    </div>
                </div>
                <div class="flex-1 p-2 sm:p-5 bg-green-50 rounded-lg border">
                    <div class="text-sm font-medium text-green-600">វត្តមាន</div>
                    <div class="flex flex-row items-center justify-center gap-1">

                        <span id="present-count"
                            class="text-xl sm:text-4xl font-bold ">{{ $records->where('status', 'present')->count() }}</span>
                        <span class="text-sm sm:text-md font-bold ">នាក់</span>
                    </div>
                </div>
                <div class="flex-1 p-2 sm:p-5 bg-red-50 rounded-lg border">
                    <div class="text-sm font-medium text-red-600">អវត្តមាន</div>
                    <div class="flex flex-row items-center justify-center gap-1">
                        <span id="absent-count"
                            class="text-xl sm:text-4xl font-bold ">{{ $records->where('status', 'absent')->count() }}</span>
                        <span class="text-sm sm:text-md font-bold ">នាក់</span>
                    </div>
                </div>
                <div class="flex-1 p-2 sm:p-5 bg-orange-100 rounded-lg border">
                    <div class="text-sm font-medium text-yellow-600">ច្បាប់</div>
                    <div class="flex flex-row items-center justify-center gap-1">
                        <span id="permission-count"
                            class="text-xl sm:text-4xl font-bold ">{{ $records->where('status', 'permission')->count() }}</span>
                        <span class="text-sm sm:text-md font-bold ">នាក់</span>
                    </div>
                </div>
                <div class="flex-1 p-2 sm:p-5 bg-yellow-50 rounded-lg border">
                    <div class="text-sm font-medium text-yellow-600">យឺត</div>
                    <div class="flex flex-row items-center justify-center gap-1">
                        <span id="late-count"
                            class="text-xl sm:text-4xl font-bold ">{{ $records->where('status', 'late')->count() }}</span>
                        <span class="text-sm sm:text-md font-bold ">នាក់</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4 mb-2">
                <input type="search" placeholder="ស្វែងរក..."
                    class="w-full px-3 py-2 border rounded-lg min-w-[100px] max-w-[200px] " id="search-input"
                    style="height: 38px !important;">

                <button
                    class="px-2 py-2 border rounded-lg flex items-center justify-center gap-2 min-w-[100px] max-w-[500px] bg-green-100 hover:bg-green-200"
                    id="button-checkAllPresent" data-modal-target="checkall-modal" data-modal-toggle="checkall-modal"
                    style="height: 38px !important;">
                    វត្តមានទាំងអស់
                </button>
            </div>
            <!-- Table -->
            <div class="bg-white rounded-lg border w-full overflow-x-auto ">
                <table class="w-full text-sm md:text-lg ">
                    <thead>
                        <tr class="border-b">
                            {{-- <th class="px-2 py-2 text-left whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </th> --}}
                            <th class="px-2 py-2 text-left whitespace-nowrap">អត្តលេខ</th>
                            <th class="px-2 py-2 text-left whitespace-nowrap  sm:table-cell cursor-pointer"
                                data-sort="name_2">
                                <span class="flex items-center">
                                    ឈ្មោះ (ខ្មែរ)
                                    <svg class="w-4 h-4 ms-1 inline-block sort-icon" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th class="px-2 py-2 text-left whitespace-nowrap hidden sm:table-cell cursor-pointer"
                                data-sort="name">
                                ឈ្មោះ (អង់គ្លេស)
                                <svg class="w-4 h-4 ms-1 inline-block sort-icon" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </th>
                            <th class="px-2 py-2 text-left whitespace-nowrap cursor-pointer" data-sort="gender">
                                ភេទ
                                <svg class="w-4 h-4 ms-1 inline-block sort-icon" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                </svg>
                            </th>
                            <th class="px-2 py-2 text-center whitespace-nowrap">វត្តមាន</th>
                            <th class="px-2 py-2 text-center whitespace-nowrap hidden">ពិន្ទុ</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $students)
                            @if ($students->student && $students->student->code)
                                <tr class="border-b">
                                    {{-- <td class="px-2 py-2 text-center"><input type="checkbox" class="rounded border-gray-300"></td> --}}
                                    <td class="px-2 py-2 text-xs sm:text-sm">{{ $students->student->code }}</td>
                                    <td class="px-2 py-2 text-xs sm:text-sm ">{{ $students->student->name_2 }}</td>
                                    <td class="px-2 py-2 text-xs sm:text-sm hidden sm:table-cell">
                                        {{ $students->student->name }}</td>
                                    <td class="px-2 py-2 text-xs sm:text-sm ">{{ $students->student->gender }}</td>
                                    <td class="px-2 py-2">
                                        <div class="flex gap-2 justify-center relative">
                                            <!-- Present Button and Tooltip -->
                                            <button type="button"
                                                data-tooltip-target="tooltip-present-{{ $students->id }}"
                                                data-tooltip-trigger="hover"
                                                class="attendance-btn p-1 sm:p-3 rounded-lg border {{ $students->status === 'present' ? 'active' : '' }}"
                                                data-type="present">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                            <div id="tooltip-present-{{ $students->id }}" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                                <span class="text-sm">វត្តមាន</span>
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                            <!-- Absent Button and Tooltip -->
                                            <button type="button"
                                                data-tooltip-target="tooltip-absent-{{ $students->id }}"
                                                data-tooltip-trigger="hover"
                                                class="attendance-btn p-1 sm:p-3 rounded-lg border {{ $students->status === 'absent' ? 'active' : '' }}"
                                                data-type="absent">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <div id="tooltip-absent-{{ $students->id }}" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                                <span class="text-sm">អវត្តមាន</span>
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                            <!-- Permission Button and Tooltip -->
                                            <button type="button"
                                                data-tooltip-target="tooltip-permission-{{ $students->id }}"
                                                data-tooltip-trigger="hover"
                                                class="attendance-btn p-1 sm:p-3 rounded-lg border {{ $students->status === 'permission' ? 'active' : '' }}"
                                                data-type="permission">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </button>
                                            <div id="tooltip-permission-{{ $students->id }}" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                                <span class="text-sm">ច្បាប់</span>
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                            <!-- Late Button and Tooltip -->
                                            <button type="button" data-tooltip-target="tooltip-late-{{ $students->id }}"
                                                data-tooltip-trigger="hover"
                                                class="attendance-btn p-1 sm:p-3 rounded-lg border {{ $students->status === 'late' ? 'active' : '' }}"
                                                data-type="late">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                            <div id="tooltip-late-{{ $students->id }}" role="tooltip"
                                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                                <span class="text-sm">យឺត</span>
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="student-score hidden" data-student-id="{{ $students->student_code }}">
                                        {{ $students->score ?? '-' }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div><!-- Check All Present Confirmation Modal -->
        <div id="checkall-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                        data-modal-hide="checkall-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 ">តើអ្នកប្រាកដថាចង់វត្តមានទាំងអស់មែនទេ?</h3>
                        <button data-modal-hide="checkall-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">បោះបង់</button>
                        <button id="confirm-checkall" data-modal-hide="checkall-modal" type="button"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            បាទ/ចាស, វត្តមានទាំងអស់
                        </button>
                    </div>
                </div>
            </div>
        </div>

        </html>


        <script>
            const record = <?php echo json_encode($records); ?>;
            const currentDate = "{{ isset($_GET['date']) ? $_GET['date'] : date('Y-m-d') }}";
            console.log(record);
            const scores = <?php echo json_encode($scores ?? []); ?>;

            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).on('click', '#button-saveAttendant-Byday', function() {
                    var assing_no = "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}";
                    var att_date = $('#att-date').val();
                    $.ajax({
                        type: "POST",
                        url: "/attendance/submit-by-date",
                        data: {
                            assing_no: assing_no,
                            att_date: att_date
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                notyf.success(response.msg);
                            } else {
                                notyf.error(response.msg);
                            }
                        }
                    });
                });

                // Remove the old handler for #button-checkAllPresent
                // Add handler for modal confirm button
                $(document).on('click', '#confirm-checkall', function() {
                    $('tbody tr').each(function() {
                        const presentBtn = $(this).find('.attendance-btn[data-type="present"]');
                        if (presentBtn.length) {
                            $(this).find('.attendance-btn').removeClass('active');
                            presentBtn.addClass('active');
                            const scoreCell = $(this).find('.student-score');
                            scoreCell.text('2');
                            const studentId = scoreCell.data('student-id');
                            var assing_no =
                                "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}";
                            var student = record.find(student => student.student_code === studentId);
                            var class_code = student ? student.student.class_code : '';
                            let formData = {
                                date: currentDate,
                                score: '2',
                                assign_line_no: assing_no,
                                student_code: studentId,
                                class_code: class_code
                            };
                            fetch('update-score-student', {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify(formData)
                                })
                                .then(response => response.json())
                                .then(data => {
                                    // Optionally show toast or handle response
                                })
                                .catch(error => console.error("Error:", error));
                        }
                    });
                    updateStatistics();
                });
            });

            // Initialize scores and attendance buttons
            function initializeScores() {
                const studentScores = document.querySelectorAll('.student-score');

                // Reset all scores and buttons first
                studentScores.forEach(scoreCell => {
                    const score = scoreCell.textContent.trim();
                    const buttons = scoreCell.closest('tr').querySelectorAll('.attendance-btn');
                    buttons.forEach(btn => btn.classList.remove('active'));

                    // Set the appropriate button as active based on score
                    if (score !== '-') {
                        let buttonType;
                        switch (score) {
                            case "2":
                                buttonType = "present";
                                break;
                            case "1":
                                buttonType = "late";
                                break;
                            case "0.5":
                                buttonType = "permission";
                                break;
                            case "0":
                                buttonType = "absent";
                                break;
                        }

                        if (buttonType) {
                            const activeButton = scoreCell.closest('tr').querySelector(
                                `.attendance-btn[data-type="${buttonType}"]`);
                            if (activeButton) activeButton.classList.add('active');
                        }
                    }
                });

                // Update statistics after setting scores
                updateStatistics();
            }

            // Initialize when page loads
            document.addEventListener('DOMContentLoaded', function() {
                initializeScores();
                updateStatistics();

                // Search functionality
                const searchInput = document.getElementById('search-input');
                if (searchInput) {
                    searchInput.addEventListener('keyup', function() {
                        const filter = this.value.toLowerCase();
                        const rows = document.querySelectorAll('tbody tr');

                        rows.forEach(row => {
                            const code = row.cells[0].textContent || '';
                            const nameKh = row.cells[1].textContent || '';
                            const nameEn = row.cells[2].textContent || '';

                            const found = code.toLowerCase().includes(filter) ||
                                nameKh.toLowerCase().includes(filter) ||
                                nameEn.toLowerCase().includes(filter);

                            row.style.display = found ? '' : 'none';
                        });
                    });
                }

                // Sorting logic
                let currentSort = {
                    column: null,
                    direction: 'asc'
                };
                const ths = document.querySelectorAll('th[data-sort]');
                ths.forEach(th => {
                    th.addEventListener('click', function() {
                        const sortKey = this.getAttribute('data-sort');
                        const colIndex = Array.from(this.parentNode.children).indexOf(this);
                        let direction = 'asc';
                        if (currentSort.column === sortKey) {
                            direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                        }
                        currentSort = {
                            column: sortKey,
                            direction
                        };
                        sortTable(colIndex, direction);
                        updateSortIcons();
                    });
                });

                function sortTable(colIndex, direction) {
                    const tbody = document.querySelector('tbody');
                    const rows = Array.from(tbody.querySelectorAll('tr')).filter(row => row.style.display !== 'none');
                    rows.sort((a, b) => {
                        const aText = a.children[colIndex].textContent.trim();
                        const bText = b.children[colIndex].textContent.trim();
                        if (aText < bText) return direction === 'asc' ? -1 : 1;
                        if (aText > bText) return direction === 'asc' ? 1 : -1;
                        return 0;
                    });
                    rows.forEach(row => tbody.appendChild(row));
                }

                function updateSortIcons() {
                    ths.forEach(th => {
                        const icon = th.querySelector('.sort-icon');
                        if (!icon) return;
                        if (th.getAttribute('data-sort') === currentSort.column) {
                            icon.style.transform = currentSort.direction === 'asc' ? 'rotate(0deg)' :
                                'rotate(180deg)';
                            icon.style.color = '#2563eb';
                        } else {
                            icon.style.transform = 'rotate(0deg)';
                            icon.style.color = '';
                        }
                    });
                }
            });

            document.querySelectorAll('.attendance-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from siblings
                    const siblings = this.parentElement.querySelectorAll('.attendance-btn');
                    siblings.forEach(sib => sib.classList.remove('active'));

                    // Toggle active class on clicked button
                    this.classList.add('active');

                    // Update score based on attendance type
                    const studentId = this.closest('tr').querySelector('.student-score').getAttribute(
                        'data-student-id');
                    let score = 0;

                    switch (this.dataset.type) {
                        case 'present':
                            score = "2";
                            break;
                        case 'late':
                            score = "1";
                            break;
                        case 'permission':
                            score = "0.5";
                            break;
                        case 'absent':
                            score = "0";
                            break;
                    }

                    // Update the score display
                    const scoreCell = document.querySelector(`[data-student-id="${studentId}"]`);
                    scoreCell.textContent = score;

                    // Update score in database
                    updateScoreStudent(score);

                    // Update statistics
                    updateStatistics();
                });
            });

            // Handle select all checkbox - only if checkbox exists
            const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
            if (selectAllCheckbox) {
                const studentCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
                selectAllCheckbox.addEventListener('change', function() {
                    studentCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });
            }

            // Update statistics based on attendance
            function updateStatistics() {
                const total = document.querySelectorAll('tbody tr').length;
                const present = document.querySelectorAll('.attendance-btn[data-type="present"].active').length;
                const absent = document.querySelectorAll('.attendance-btn[data-type="absent"].active').length;
                const late = document.querySelectorAll('.attendance-btn[data-type="late"].active').length;
                const permission = document.querySelectorAll('.attendance-btn[data-type="permission"].active').length;

                document.getElementById('present-count').textContent = present + late;
                document.getElementById('absent-count').textContent = absent + permission;
                document.getElementById('late-count').textContent = late;
                document.getElementById('permission-count').textContent = permission;
            }



            // Filter panel toggle
            const filterButton = document.getElementById('filter-button');
            const filterPanel = document.getElementById('filter-panel');

            // filterButton.addEventListener('click', function() {
            //     filterPanel.classList.toggle('hidden');
            // });

            function updateScoreStudent(score) {
                const studentId = event.target.closest('tr').querySelector('.student-score').getAttribute('data-student-id');
                url = 'update-score-student';
                var assing_no = "{{ isset($_GET['assing_no']) ? addslashes($_GET['assing_no']) : '' }}";
                // Find student by student_code instead of id
                var student = record.find(student => student.student_code === studentId);
                var student_code = studentId; // Use studentId directly since it's already the student_code
                var class_code = student ? student.student.class_code : '';

                let formData = {
                    date: currentDate,
                    score: score,
                    assign_line_no: assing_no,
                    student_code: student_code,
                    class_code: class_code
                }

                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status == 'success') {
                            showToast(data.msg);
                            // Update the scores array with the new score
                            const scoreIndex = scores.findIndex(s => s.student_id === student_code);
                            if (scoreIndex !== -1) {
                                scores[scoreIndex].att_score = score;
                            } else {
                                scores.push({
                                    student_id: student_code,
                                    att_score: score
                                });
                            }
                            // Reinitialize scores to update buttons
                            initializeScores();
                        } else {
                            showToast(data.msg);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        </script>

        <script>
            updateStatistics();

            // Get the toast element
            const toast = document.getElementById("alert-message");
            const message = document.getElementById("message");

            // Function to show the toast
            function showToast(message) {
                if (toast) {
                    toast.classList.remove("hidden");
                    toast.textContent = message;

                    setTimeout(() => {
                        toast.classList.add("hidden");
                    }, 2000);
                } else {
                    // Fallback: use console or alert if toast element doesn't exist
                    console.log(message);
                }
            }

            // Initially hide the toast if it exists
            if (toast) {
                toast.classList.add("hidden");
            }
        </script>
    @endsection
