<div class="container mx-auto">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@100;300;400;700;900&display=swap" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
@extends('app_layout.app-zlayout')
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
<body class="bg-gray-50 ">
    <div class=" p-2 sm:p-6 space-y-2 md:space-y-6 lg:px-24 lg:py-12  ">
        <!-- Header Controls -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-1 sm:gap-2">
                <input type="search" placeholder="ស្វែងរក..." class="w-full px-3 py-2 border rounded-lg min-w-[100px] max-w-[500px] " id="search-input" style="height: 38px !important;">

                <button class="px-2 py-2 border rounded-lg flex items-center justify-center gap-2  min-w-[100px] max-w-[500px]" id="button-saveAttendant-Byday" style="height: 38px !important;">
                    រក្សាទុក
                </button>
                {{-- <button class="px-2 py-2 border rounded-lg flex items-center justify-center gap-2" id="filter-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span class="hidden sm:inline">ស្រង់</span>
                </button> --}}
            </div>
            
            <div id="alert-message" class="fixed top-0  right-0 p-4 mb-4 text-md text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span id="message" class="font-medium"></span>
            </div>
            
            <div class="text-lg font-semibold">
                កាលបរិច្ឆេទ: {{ isset($_GET['date']) ? $_GET['date'] : date('Y-m-d') }}
            </div>
            <input type="hidden" id="att-date" value="{{ request('date', date('Y-m-d')) }}">
        </div>
        <!-- Add Filter Panel -->
        <div id="filter-panel" class="hidden mt-2 p-4 bg-white border rounded-lg ">
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
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-3  md:grid-cols-5 gap-1 sm:gap-2 w-full">
            <div class="flex-1 p-2 sm:p-5 bg-blue-50 rounded-lg border">
                <div class="text-sm font-medium">សរុប</div>
                <div class="flex flex-row items-center justify-center gap-1">

                    <span class="text-xl sm:text-4xl font-bold ">{{$records->count()}}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-green-50 rounded-lg border">
                <div class="text-sm font-medium text-green-600">វត្តមាន</div>
                <div class="flex flex-row items-center justify-center gap-1">

                    <span id="present-count" class="text-xl sm:text-4xl font-bold ">{{$records->where('status', 'present')->count()}}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-red-50 rounded-lg border">
                <div  class="text-sm font-medium text-red-600">អវត្តមាន</div>
                <div class="flex flex-row items-center justify-center gap-1">
                    <span id="absent-count" class="text-xl sm:text-4xl font-bold ">{{$records->where('status', 'absent')->count()}}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-orange-100 rounded-lg border">
                <div class="text-sm font-medium text-yellow-600">ច្បាប់</div>
                <div class="flex flex-row items-center justify-center gap-1">
                    <span id="permission-count" class="text-xl sm:text-4xl font-bold ">{{$records->where('status', 'permission')->count()}}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-yellow-50 rounded-lg border">
                <div class="text-sm font-medium text-yellow-600">យឺត</div>
                <div class="flex flex-row items-center justify-center gap-1">
                    <span id="late-count" class="text-xl sm:text-4xl font-bold ">{{$records->where('status', 'late')->count()}}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg border w-full overflow-x-auto ">
            <table class="w-full text-sm md:text-lg ">
                <thead>
                    <tr class="border-b">
                        <th class="px-2 py-2 text-left whitespace-nowrap">
                            <input type="checkbox" class="rounded border-gray-300">
                        </th>
                        <th class="px-2 py-2 text-left whitespace-nowrap">អត្តលេខ</th>
                        <th class="px-2 py-2 text-left whitespace-nowrap  hidden sm:table-cell ">ភេទ</th>
                        <th class="px-2 py-2 text-left whitespace-nowrap hidden sm:table-cell ">ឈ្មោះ (អង់គ្លេស)</th>
                        <th class="px-2 py-2 text-left whitespace-nowrap  sm:table-cell ">ឈ្មោះ (ខ្មែរ)</th>
                        <th class="px-2 py-2 text-center whitespace-nowrap">វត្តមាន</th>
                        <th class="px-2 py-2 text-center whitespace-nowrap">ពិន្ទុ</th>
                       
                    </tr>
                </thead> 
                <tbody >
                    @forEach($records as $students)
                    @if($students->student && $students->student->code)
                    <tr class="border-b">
                        <td class="px-2 py-2 text-center"><input type="checkbox" class="rounded border-gray-300"></td>
                        <td class="px-2 py-2 text-xs sm:text-sm">{{$students->student->code}}</td>
                        <td class="px-2 py-2 text-xs sm:text-sm">{{$students->student->gender}}</td>
                        <td class="px-2 py-2 text-xs sm:text-sm">{{$students->student->name}}</td>
                        <td class="px-2 py-2 text-xs sm:text-sm">{{$students->student->name_2}}</td>
                        <td class="px-2 py-2">
                            <div class="flex gap-2 justify-center">
                                <div id="tooltip-present-{{$students->id}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    <span class="text-sm">វត្តមាន</span>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div id="tooltip-absent-{{$students->id}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    <span class="text-sm">អវត្តមាន</span>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div id="tooltip-late-{{$students->id}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    <span class="text-sm">យឺត</span>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                <div id="tooltip-permission-{{$students->id}}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                    <span class="text-sm">ច្បាប់</span>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <button data-tooltip-target="tooltip-present-{{$students->id}}" class="attendance-btn p-1 sm:p-3 rounded-lg border {{ $students->status === 'present' ? 'active' : '' }}" data-type="present">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                
                                <button data-tooltip-target="tooltip-absent-{{$students->id}}" class="attendance-btn p-1  sm:p-3 rounded-lg border {{ $students->status === 'absent' ? 'active' : '' }}" data-type="absent">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <button data-tooltip-target="tooltip-permission-{{$students->id}}" class="attendance-btn p-1 sm:p-3 rounded-lg border {{ $students->status === 'permission' ? 'active' : '' }}" data-type="permission">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </button>
                                <button data-tooltip-target="tooltip-late-{{$students->id}}" class="attendance-btn p-1 sm:p-3 rounded-lg border {{ $students->status === 'late' ? 'active' : '' }}" data-type="late">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td class="student-score" data-student-id="{{ $students->student_code }}">
                            {{ $students->score ?? '-' }}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
</body>
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
                data: { assing_no: assing_no, att_date: att_date },
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
                    const activeButton = scoreCell.closest('tr').querySelector(`.attendance-btn[data-type="${buttonType}"]`);
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
    });

    document.querySelectorAll('.attendance-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from siblings
            const siblings = this.parentElement.querySelectorAll('.attendance-btn');
            siblings.forEach(sib => sib.classList.remove('active'));
            
            // Toggle active class on clicked button
            this.classList.add('active');
            
            // Update score based on attendance type
            const studentId = this.closest('tr').querySelector('.student-score').getAttribute('data-student-id');
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

    // Handle select all checkbox
    const selectAllCheckbox = document.querySelector('thead input[type="checkbox"]');
    const studentCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

    selectAllCheckbox.addEventListener('change', function() {
        studentCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

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

    // Search functionality
    const searchInput = document.getElementById('search-input');
    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const code = row.cells[1].textContent || '';
            const nameKh = row.cells[2].textContent || '';
            const nameEn = row.cells[3].textContent || '';
            
            const found = code.toLowerCase().includes(filter) ||
                        nameKh.toLowerCase().includes(filter) ||
                        nameEn.toLowerCase().includes(filter);

            row.style.display = found ? '' : 'none';
        });
    });

    // Filter panel toggle
    const filterButton = document.getElementById('filter-button');
    const filterPanel = document.getElementById('filter-panel');

    filterButton.addEventListener('click', function() {
        filterPanel.classList.toggle('hidden');
    });

    function updateScoreStudent(score){
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
            if(data.status == 'success'){
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
            }else{
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
        toast.classList.remove("hidden");
        toast.textContent = message;
        
        setTimeout(() => {
            toast.classList.add("hidden");
        }, 2000);
    }

    // Initially hide the toast
    toast.classList.add("hidden");
</script>



@endsection
