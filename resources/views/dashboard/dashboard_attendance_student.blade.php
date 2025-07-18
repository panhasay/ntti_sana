@extends('app_layout.layout')
@section('content')
<style>
  .font-noto {
    font-family: "Noto Sans Khmer", sans-serif;
  }
  .khmer-moul {
    font-family: "Moul", serif;
  }
</style>
{{-- {{ dd($schedules) }} --}}
<div class="bg-gray-50 font-noto">
    <div class="container">
        @if(session('warning'))
            <div id="future-date-warning" class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded flex items-center">
                <span class="mr-2">🚫</span>
                <span>{{ session('warning')}}</span>
            </div>
            <script>
                setTimeout(function() {
                    var el = document.getElementById('future-date-warning');
                    if (el) el.style.display = 'none';
                }, 5000);
            </script>
        @endif
        <div class=" rounded-lg py-6 px-2">
           
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 sm:gap-0 mb-4 sm:mb-6">
                <h3 class=" text-xl sm:text-2xl lg:text-3xl khmer-moul">វត្តមានថ្ងៃនេះ</h3>
                <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                    <div class="text-sm sm:text-base text-muted-foreground khmer-font">
                        {{ $selectedDate->locale('km')->isoFormat('ថ្ងៃdddd ទីD ខែMMMM ឆ្នាំY') }}
                    </div>
                    {{-- <a href="/report_attendance_student" class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-full shadow-lg hover:from-blue-600 hover:to-indigo-700 transition ml-0 sm:ml-4 text-center font-semibold focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2V7a2 2 0 00-2-2h-1V3.5A1.5 1.5 0 0012.5 2h-1A1.5 1.5 0 0010 3.5V5H9a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        View Report
                    </a> --}}
                </div>
            </div>
            
            <!-- Filters Section -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        កាលបរិច្ឆេទ
                    </label>
                    @include('components.custom_date')
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        ដេប៉ាតឺម៉ង់
                    </label>
                    <select id="department-filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="All Departments" {{ $selectedDepartment == 'All Departments' ? 'selected' : '' }}>ដេប៉ាតឺម៉ង់ទាំងអស់</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept }}" {{ $selectedDepartment == $dept ? 'selected' : '' }}>{{ $dept }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        វេន
                    </label>
                    <select id="section-filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="All" {{ $selectedSection == 'All' ? 'selected' : '' }}>វេនទាំងអស់</option>
                        <option value="Morning" {{ $selectedSection == 'Morning' ? 'selected' : '' }}>ព្រឹក</option>
                        <option value="Evening" {{ $selectedSection == 'Evening' ? 'selected' : '' }}>រសៀល</option>
                        <option value="Night" {{ $selectedSection == 'Night' ? 'selected' : '' }}>យប់</option>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 pb-8 sm:pb-16">
                @foreach ($schedules as $schedule)
                @foreach ($schedule['schedule_items'] as $item)
                    <x-dashboard.card_schedule :schedule="$schedule" :item="$item" :selectedDate="$selectedDate" />
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
{{-- {{ dd($departments) }} --}}

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtn = document.getElementById('filterBtn');
    const attendanceTableBody = document.getElementById('attendanceTableBody');
    const loadingState = document.getElementById('loadingState');
    const emptyState = document.getElementById('emptyState');
    
    function loadAttendanceData() {
        const date = document.getElementById('datepicker').value;
        const department = document.getElementById('department-filter').value;
        const section = document.getElementById('section-filter').value;
        
        // Show loading state
        loadingState.classList.remove('hidden');
        attendanceTableBody.innerHTML = '';
        emptyState.classList.add('hidden');
        
        // Build query parameters
        const params = new URLSearchParams();
        if (date) params.append('date', date);
        if (department && department !== 'All Departments') params.append('department', department);
        if (section && section !== 'All') params.append('section', section);
        
        // Make API call to get attendance data
        fetch(`/attendance?${params.toString()}`)
            .then(response => response.json())
            .then(data => {
                loadingState.classList.add('hidden');
                
                if (data.length === 0) {
                    emptyState.classList.remove('hidden');
                    return;
                }
                
                // Populate table with data
                attendanceTableBody.innerHTML = data.map(item => `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${item.time || 'N/A'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${item.subject || 'N/A'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${item.teacher || 'N/A'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${item.department || 'N/A'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${item.section || 'N/A'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <a href="/get-attendant-student?assing_no=${item.assing_no}" 
                               class="text-blue-600 hover:text-blue-900">
                                View Attendance
                            </a>
                        </td>
                    </tr>
                `).join('');
            })
            .catch(error => {
                loadingState.classList.add('hidden');
                console.error('Error loading attendance data:', error);
                emptyState.classList.remove('hidden');
                emptyState.innerHTML = '<p class="text-red-600">Error loading attendance data. Please try again.</p>';
            });
    }

    function updateFilters(date = null) {
        const selectedDate = date || document.getElementById('datepicker').value;
        // selectedDate is yyyy-mm-dd, backend expects yyyy-mm-dd
        const department = document.getElementById('department-filter').value;
        const section = document.getElementById('section-filter').value;
        window.location.href = `{{ url()->current() }}?date=${selectedDate}&department=${encodeURIComponent(department)}&section=${encodeURIComponent(section)}`;
    }

    // Listen for custom dateSelected event from custom_date.blade.php
    document.getElementById('datepicker').addEventListener('dateSelected', function(e) {
        updateFilters(e.detail.date);
    });

    // Also allow manual typing or change in the input
    document.getElementById('datepicker').addEventListener('change', function(e) {
        updateFilters(e.target.value);
    });

    document.getElementById('department-filter').addEventListener('change', function() {
        updateFilters();
    });
    document.getElementById('section-filter').addEventListener('change', function() {
        updateFilters();
    });

    // Auto-select section based on client time if not already set by URL
    const sectionSelect = document.getElementById('section-filter');
    const urlParams = new URLSearchParams(window.location.search);
    if (!urlParams.has('section')) {
        const now = new Date();
        const hour = now.getHours();
        let section = 'Night';
        if (hour >= 6 && hour < 13) {
            section = 'Morning';
        } else if (hour >= 13 && hour < 18) {
            section = 'Evening';
        } else if (hour >= 18 && hour < 21) {
            section = 'Night';
        }
        sectionSelect.value = section;
        // Optionally, trigger the change event to reload/filter
        sectionSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection


