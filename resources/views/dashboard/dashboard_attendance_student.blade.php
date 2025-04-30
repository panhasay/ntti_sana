<style>
    .avatar-bg-1 { background-color: #FFB4B4; }
    .avatar-bg-2 { background-color: #BFFCC6; }
    .avatar-bg-3 { background-color: #B4E4FF; }
    .avatar-bg-4 { background-color: #FFF6BD; }
    .avatar-bg-5 { background-color: #C8B6FF; }

    .status-on-time { background-color: #22c55e; }
    .status-late { background-color: #f59e0b; }
    .status-absent { background-color: #ef4444; }
    .status-unchecked { background-color: #f59e0b; }

    .check-status {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: absolute;
        bottom: 6px;
        right: 6px;
    }
    .status-checked { background-color: #22c55e; }
    .status-unchecked { background-color: #f59e0b; }



    .khmer-moul {
        font-family: 'Moul', serif !important;
        font-size: 20px !important;
        color: #0f4e87 !important;
    }

    @media (max-width: 640px) {
        .max-w-[1400px] {
            max-width: 100%;
            padding: 0 12px;
        }
        
        .grid.grid-cols-4 {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .flex.justify-between {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .text-4xl {
            font-size: 1.75rem;
        }

        .p-6 {
            padding: 1rem;
        }

        .hover\:scale-105:hover {
            transform: none;
        }

        .filter-controls {
            flex-direction: column;
            gap: 0.5rem;
        }

        .datepicker-toggle {
            width: 100%;
        }
    }
</style>
<div class="containner">
@extends('app_layout.app_layout')
@section('content')

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>

<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 sm:gap-0 mb-4 sm:mb-6">
        <h1 class="scroll-m-20 text-2xl sm:text-3xl lg:text-4xl khmer-moul">វត្តមានថ្ងៃនេះ</h1>
        <div class="text-sm sm:text-base text-muted-foreground khmer-font">
            {{ $selectedDate->locale('km')->isoFormat('ថ្ងៃdddd ទីD ខែMMMM ឆ្នាំY') }}
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="filter-controls mb-6">
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center">
            <!-- Date Navigation -->
            <div class="date-navigation w-full sm:w-auto flex items-center bg-white rounded-lg border border-gray-300 overflow-hidden">
                <button type="button" onclick="navigateDate('prev')" class="nav-button p-2.5 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <div class="relative flex-1 border-x border-gray-200">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input datepicker datepicker-format="dd/mm/yyyy" type="text" 
                        id="date-filter"
                        value="{{ $selectedDate->format('d/m/Y') }}"
                        class="bg-white text-gray-900 text-sm block w-full ps-10 p-2.5 focus:outline-none focus:ring-0 border-0"
                        placeholder="Select date">
                </div>

                <button type="button" onclick="navigateDate('next')" class="nav-button p-2.5 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <!-- Department and Section Filters -->
            <div class="filter-selects flex items-center gap-4 flex-1">
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <label for="department-filter" class="text-sm font-medium text-gray-700 whitespace-nowrap khmer-font">ដេប៉ាតឺម៉ង់៖</label>
                    <select id="department-filter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="All Departments" {{ $selectedDepartment == 'All Departments' ? 'selected' : '' }}>ដេប៉ាតឺម៉ង់ទាំងអស់</option>
                        @foreach($departments as $department)
                            @if($department != 'All Departments')
                                <option value="{{ $department }}" {{ $selectedDepartment == $department ? 'selected' : '' }}>
                                    {{ $department }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <label for="section-filter" class="text-sm font-medium text-gray-700 whitespace-nowrap khmer-font">វេន៖</label>
                    <select id="section-filter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="All" {{ $selectedSection == 'All' ? 'selected' : '' }}>វេនទាំងអស់</option>
                        <option value="Morning" {{ $selectedSection == 'Morning' ? 'selected' : '' }}>វេនព្រឹក</option>
                        <option value="Evening" {{ $selectedSection == 'Evening' ? 'selected' : '' }}>វេនល្ងាច</option>
                        <option value="Night" {{ $selectedSection == 'Night' ? 'selected' : '' }}>វេនយប់</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 pb-8 sm:pb-16">
        @foreach ($schedules as $schedule)
            @foreach ($schedule['schedule_items'] as $item)
                <div class="rounded-xl border-1 border-green-600 bg-card text-card-foreground shadow-sm hover:shadow-md transition-all cursor-pointer hover:scale-105 transform duration-300 ease-in-out relative" 
                    onclick="window.location.href='{{ url('get-attendant-student?assing_no=' . $item['assing_no'] . '&date=' . $selectedDate->format('Y-m-d')) }}'">
                    <div class="p-4 sm:p-6 flex flex-col h-full">
                        <div class="text-base font-semibold mb-4 flex flex-row items-center justify-between">
                            <span>ក្រុម : {{ $schedule['class_code'] }}</span>
                        </div>

                        <!-- Teacher and Subject Info -->
                        <div class="flex items-center space-x-3 sm:space-x-4 mb-4">
                            <span class="relative flex h-10 sm:h-12 w-10 sm:w-12 shrink-0 overflow-hidden rounded-full">
                                <span class="flex h-full w-full items-center justify-center rounded-full avatar-bg-{{ (crc32($item['teacher']) % 5) + 1 }}">
                                    <span class="text-sm sm:text-base font-medium text-gray-700">
                                        {{ substr($item['teacher'], 0, 1) }}
                                    </span>
                                </span>
                            </span>
                                
                            <div class="flex-1">
                                <h3 class="text-base sm:text-lg font-semibold leading-none tracking-tight mb-1.5">{{ $item['teacher'] }}</h3>
                                <div class="text-sm text-muted-foreground">
                                    {{ $item['subject'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Time and Room Info -->
                        <div class="mt-auto">
                            <div class="flex items-center gap-2 text-xs sm:text-sm text-muted-foreground justify-between border-t pt-3">
                                <div class="flex flex-row">
                                    <svg class="w-3.5 sm:w-4 h-3.5 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    <span class="px-2">{{ $item['time'] }}</span>
                                </div>
                                <div class="khmer-font">
                                    Room : ({{ $item['room'] }})
                                </div>
                                <div class="check-status {{ $item['checked'] ? 'status-checked' : 'status-unchecked' }}"></div>
                            </div>
                            <!-- Add section info for debugging -->
                            <div class="text-xs text-gray-500 mt-2">
                                Section: {{ $item['section'] ?? 'Not set' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

    <script>
        // Initialize Flowbite datepicker
        document.addEventListener('DOMContentLoaded', function() {
            const datepickerEl = document.getElementById('date-filter');
            if (datepickerEl) {
                new Datepicker(datepickerEl, {
                    format: 'dd/mm/yyyy',
                    autohide: true,
                    todayHighlight: true,
                });
            }
        });

        function formatDate(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        function parseDate(dateStr) {
            // Handle both dd/mm/yyyy and yyyy-mm-dd formats
            if (dateStr.includes('/')) {
                const [day, month, year] = dateStr.split('/');
                return new Date(year, month - 1, day);
            } else {
                return new Date(dateStr);
            }
        }

        function navigateDate(direction) {
            const dateInput = document.getElementById('date-filter');
            const currentDate = parseDate(dateInput.value);
            
            // Create a new date object to avoid modifying the original
            const newDate = new Date(currentDate);
            
            if (direction === 'prev') {
                newDate.setDate(newDate.getDate() - 1);
            } else {
                newDate.setDate(newDate.getDate() + 1);
            }
            
            const formattedDate = formatDate(newDate);
            dateInput.value = formattedDate;
            updateFilters(formattedDate);
        }

        function updateFilters(date = null) {
            const selectedDate = date || document.getElementById('date-filter').value;
            // Convert date format from dd/mm/yyyy to yyyy-mm-dd for the backend
            const [day, month, year] = selectedDate.split('/');
            const formattedDate = `${year}-${month}-${day}`;
            
            const department = document.getElementById('department-filter').value;
            const section = document.getElementById('section-filter').value;
            
            window.location.href = `{{ url()->current() }}?date=${formattedDate}&department=${encodeURIComponent(department)}&section=${encodeURIComponent(section)}`;
        }

        // Add event listeners
        document.getElementById('date-filter').addEventListener('changeDate', function(e) {
            const formattedDate = formatDate(e.detail.date);
            updateFilters(formattedDate);
        });

        document.getElementById('department-filter').addEventListener('change', function() {
            updateFilters(document.getElementById('date-filter').value);
        });

        document.getElementById('section-filter').addEventListener('change', function() {
            const selectedSection = this.value;
            console.log('Selected Section:', selectedSection);
            updateFilters(document.getElementById('date-filter').value);
        });

        // Log initial section value
        console.log('Initial Section:', '{{ $selectedSection }}');
        console.log('Available Sections:', Array.from(document.getElementById('section-filter').options).map(opt => opt.value));

        // Log section for each schedule item
        @foreach ($schedules as $schedule)
            @foreach ($schedule['schedule_items'] as $item)
                console.log('Schedule Details:', {
                    classCode: '{{ $schedule['class_code'] }}',
                    time: '{{ $item['time'] }}',
                    section: '{{ $item['section'] ?? 'Not set' }}',
                    subject: '{{ $item['subject'] }}'
                });
            @endforeach
        @endforeach
    </script>
    @endsection

    {{-- @dd($schedules) --}}
</div>

<style>
/* Add these styles to your existing styles */
.filter-controls {
    background-color: white;
    border-radius: 0.5rem;
    padding: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.filter-selects {
    display: flex;
    flex-wrap: nowrap;
    gap: 1rem;
}

/* Date picker custom styles */
.date-navigation {
    min-width: 200px;
}

.date-navigation input {
    font-family: 'Moul', serif;
}

.date-navigation button:hover svg {
    color: #0f4e87;
}

/* Datepicker dropdown styles */
.datepicker-dropdown {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
}

.datepicker-cell.selected {
    background-color: #0f4e87 !important;
}

.datepicker-cell.today {
    border-color: #0f4e87 !important;
}

@media (max-width: 640px) {
    .filter-controls > div {
        flex-direction: column;
        gap: 1rem;
    }

    .filter-selects {
        flex-direction: column;
        width: 100%;
    }

    .filter-selects > div {
        width: 100%;
    }

    .date-navigation {
        width: 100%;
    }
}
</style>





