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

<body class="bg-gray-50 ">
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
                        <div class="font-semibold text-black">{{ ($header->start_time ?? '') . ($header->end_time ? ' -
                            ' . $header->end_time : '') }}</div>
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

                    <span class="text-xl sm:text-4xl font-bold  class=" text-xl sm:text-4xl
                        font-bold"">{{$records->count()}}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-green-50 rounded-lg border">
                <div class="text-sm font-medium text-green-600">វត្តមាន</div>
                <div class="flex flex-row items-center justify-center gap-1">

                    <span id="present-count" class="text-xl sm:text-4xl font-bold">{{
                        $recordsAtt->where('status','present')->count() }}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-red-50 rounded-lg border">
                <div class="text-sm font-medium text-red-600">អវត្តមាន</div>
                <div class="flex flex-row items-center justify-center gap-1">
                    <span id="absent-count" class="text-xl sm:text-4xl font-bold">{{
                        $recordsAtt->where('status','absent')->count() }}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-orange-100 rounded-lg border">
                <div class="text-sm font-medium text-yellow-600">ច្បាប់</div>
                <div class="flex flex-row items-center justify-center gap-1">
                    <span id="permission-count" class="text-xl sm:text-4xl font-bold">{{
                        $recordsAtt->where('status','permission')->count() }}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
            <div class="flex-1 p-2 sm:p-5 bg-yellow-50 rounded-lg border">
                <div class="text-sm font-medium text-yellow-600">យឺត</div>
                <div class="flex flex-row items-center justify-center gap-1">
                    <span id="late-count" class="text-xl sm:text-4xl font-bold">{{
                        $recordsAtt->where('status','late')->count() }}</span>
                    <span class="text-sm sm:text-md font-bold ">នាក់</span>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-4 mb-2">
            <input type="search" placeholder="ស្វែងរក..."
                class="w-full px-3 py-2 border rounded-lg min-w-[100px] max-w-[200px] " id="search-input"
                style="height: 38px !important;">

            <!-- Push buttons to the right -->
            <div class="flex items-center gap-2 ml-auto">
                <button
                    id="BntSendToTelegram"
                    class="px-3 py-2 border rounded-lg bg-green-100 hover:bg-green-200"
                    style="height: 38px !important;">
                    ផ្ញើទៅគ្រុតេលេក្រាម
                </button>

                <button
                    id="btnTeacherAbsent"
                    class="px-3 py-2 border rounded-lg bg-green-100 hover:bg-green-200"
                    style="height: 38px !important;">
                    គ្រូអត់រៀន
                </button>
            </div>
        </div>
        <!-- Table -->
        <div class="bg-white rounded-lg border w-full overflow-x-auto ">
            <table class="w-full text-sm md:text-lg ">
                <thead>
                    <tr class="border-b">
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
                    @forEach($records as $students)
                    @if($students->student && $students->student->code)
                    @php
                    $recordsAtt = App\Models\General\student_score::where('student_code', $students->student->code)
                    ->where('assign_line_no', request('assing_no'))
                    ->where('att_date', request('date'))
                    ->first();
                    @endphp
                    <tr class="border-b">
                        <td class="px-2 py-2 text-xs sm:text-sm">{{$students->student->code}}</td>
                        <td class="px-2 py-2 text-xs sm:text-sm ">{{$students->student->name_2}}</td>
                        <td class="px-2 py-2 text-xs sm:text-sm hidden sm:table-cell">{{$students->student->name}}</td>
                        <td class="px-2 py-2 text-xs sm:text-sm ">{{$students->student->gender}}</td>
                        <td class="px-2 py-2">
                            <div class="flex gap-2 justify-center relative">

                                <!-- Present -->
                                <button type="button" class="attendance-btn p-1 sm:p-3 rounded-lg border button-Save-Attendant-Byday
                                            {{ optional($recordsAtt)->status === 'present' ? 'active' : '' }}"
                                    data-student="{{ $students->student->code }}" data-type="present">
                                    ✔
                                </button>

                                <!-- Absent -->
                                <button type="button" class="attendance-btn p-1 sm:p-3 rounded-lg border button-Save-Attendant-Byday
                                            {{ optional($recordsAtt)->status === 'absent' ? 'active' : '' }}"
                                    data-student="{{ $students->student->code }}" data-type="absent">
                                    ✖
                                </button>

                                <!-- Permission -->
                                <button type="button" class="attendance-btn p-1 sm:p-3 rounded-lg border button-Save-Attendant-Byday
                                            {{ optional($recordsAtt)->status === 'permission' ? 'active' : '' }}"
                                    data-student="{{ $students->student->code }}" data-type="permission">
                                    📄
                                </button>

                                <!-- Late -->
                                <button type="button" class="attendance-btn p-1 sm:p-3 rounded-lg border button-Save-Attendant-Byday
                                            {{ optional($recordsAtt)->status === 'late' ? 'active' : '' }}"
                                    data-student="{{ $students->student->code }}" data-type="late">
                                    ⏰
                                </button>
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
</body>
<!-- Check All Present Confirmation Modal -->
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
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.button-Save-Attendant-Byday', function () {
            const $btn = $(this); 
            const assignNo    = "{{ request('assing_no') }}";
            const studentCode = $btn.data('student');
            const statusType  = $btn.data('type');
            const attDate     = "{{ request('date') }}";

            if (!attDate) {
                alert('សូមជ្រើសរើសកាលបរិច្ឆេទ');
                return;
            }
            $.ajax({
                url: "{{ route('attendance.update') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                data: {
                    assign_no: assignNo,
                    student_code: studentCode,
                    status: statusType,
                    att_date: attDate
                },
                success: function (response) {
                    $btn.closest('.flex')
                        .find('.attendance-btn')
                        .removeClass('active');
                    $btn.addClass('active');

                    let present = 0;
                    let absent = 0;
                    let permission = 0;
                    let late = 0;
                    response.records.forEach(function (item) {
                        switch (item.status) {
                            case 'present':
                                present++;
                                break;
                            case 'absent':
                                absent++;
                                break;
                            case 'permission':
                                permission++;
                                break;
                            case 'late':
                                late++;
                                break;
                        }
                    });
                    $('#present-count').text(present);
                    $('#absent-count').text(absent);
                    $('#permission-count').text(permission);
                    $('#late-count').text(late);
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
        $(document).on('click', '#BntSendToTelegram', function () {
            const assignNo = "{{ request('assing_no') }}";
            const attDate  = "{{ request('date') }}";

            if (!assignNo || !attDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'បញ្ហា',
                    text: 'សូមជ្រើសរើសកាលបរិច្ឆេទ និងក្រុមសិក្សា'
                });
                return;
            }

            const $btn = $(this);
            Swal.fire({
                title: 'បញ្ជាក់ការផ្ញើ',
                text: 'តើអ្នកចង់ផ្ញើទៅ Telegram មែនទេ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'បាទ / ចាស',
                cancelButtonText: 'បោះបង់',
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#dc2626'
            }).then((result) => {
                if (!result.isConfirmed) return;
                $btn.prop('disabled', true).text('កំពុងផ្ញើទៅ Telegram...');
                $.ajax({
                    url: "{{ route('attendance.submitByDate') }}",
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        assing_no: assignNo,
                        att_date: attDate
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'ជោគជ័យ',
                                text: response.msg ?? 'ផ្ញើទៅ Telegram បានជោគជ័យ'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'បរាជ័យ',
                                text: response.msg ?? 'មិនអាចផ្ញើទៅ Telegram បាន'
                            });
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'កំហុស',
                            text: 'មានកំហុសក្នុងការផ្ញើ Telegram'
                        });
                    },
                    complete: function () {
                        $btn.prop('disabled', false).text('ផ្ញើទៅគ្រុតេលេក្រាម');
                    }
                });
            });
        });
        $(document).on('click', '#btnTeacherAbsent', function () {
            const $btn = $(this);
            const assignNo = "{{ request('assing_no') }}";
            const attDate  = "{{ request('date') }}";

            Swal.fire({
                title: 'បញ្ជាក់ស្ថានភាព',
                text: 'តើអ្នកប្រាកដថា ម៉ោងនេះមិនមានការរៀនទេ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'បាទ/ចាស បញ្ជាក់',
                cancelButtonText: 'បោះបង់',
                reverseButtons: true
            }).then((result) => {

                if (!result.isConfirmed) return;

                $btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('attendance.student.remove') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        assign_no: assignNo,
                        att_date: attDate
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'បានបញ្ជាក់',
                            text: response.msg ?? 'បានកំណត់ថា ម៉ោងនេះមិនរៀន'
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'បរាជ័យ',
                            text: xhr.responseJSON?.msg ?? 'មានកំហុសក្នុងការបញ្ជាក់'
                        });
                    },
                    complete: function () {
                        $btn.prop('disabled', false).text('គ្រូអត់រៀន');
                    }
                });

            });
        });
    });
</script>
@endsection