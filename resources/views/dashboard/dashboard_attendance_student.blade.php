@extends('app_layout.layout')
@section('content')

    {{-- {{ dd($schedules) }} --}}
    <div class="max-w-full md:max-w-3xl lg:max-w-5xl xl:max-w-6xl 2xl:max-w-[83rem] mx-auto md:px-4 py-6 flex-1 w-full battambang">
        <div class="bg-gray-50 font-noto">
            <div class="container">
                @if (session('warning'))
                    <div id="future-date-warning"
                        class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 rounded flex items-center">
                        <span class="mr-2">🚫</span>
                        <span>{{ session('warning') }}</span>
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
                        <h3 class=" text-xl sm:text-2xl lg:text-3xl moul">វត្តមានថ្ងៃនេះ</h3>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                            <div class="text-sm sm:text-base text-muted-foreground battambang ">
                                {{ $selectedDate->locale('km')->isoFormat('ថ្ងៃdddd ទីD ខែMMMM ឆ្នាំY') }}
                            </div>
                            
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
                        @if (Auth::user()->role === 'admin')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                ដេប៉ាតឺម៉ង់
                            </label>
                            <select id="department-filter"
                                name="department"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="All" {{ $selectedDepartmentCode === 'All' ? 'selected' : '' }}>ដេប៉ាតឺម៉ង់ទាំងអស់</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->code }}" {{ $selectedDepartmentCode === $dept->code ? 'selected' : '' }}>
                                        {{ $dept->name_2 }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <input type="hidden" id="department-filter" value="{{ $selectedDepartmentCode }}" />
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                វេន
                            </label>
                            <select id="section-filter"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
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
    </div>
    {{-- {{ dd($departments) }} --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateFilters(date = null) {
                const selectedDate = date || document.getElementById('datepicker').value;
                // selectedDate is yyyy-mm-dd, backend expects yyyy-mm-dd
                const department = document.getElementById('department-filter').value;
                const section = document.getElementById('section-filter').value;
                window.location.href =
                    `{{ url()->current() }}?date=${selectedDate}&department_code=${encodeURIComponent(department)}&section=${encodeURIComponent(section)}`;
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
