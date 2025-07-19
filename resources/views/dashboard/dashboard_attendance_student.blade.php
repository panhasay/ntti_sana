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

                        <div class="flex items-end">
                            <button id="clear-filters" 
                                class="w-full px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                                សម្អាតអត្ថបទ
                            </button>
                        </div>
                    </div>

                    <!-- Results count -->
                    <div class="mb-4">
                        <p id="results-count" class="text-sm text-gray-600">
                            បានរកឃើញ <span id="count-number">{{ count($schedules) }}</span> កាលវិភាគ
                        </p>
                        <div id="filter-status" class="mt-2 text-xs text-gray-500">
                            <span id="active-filters">អត្ថបទដែលបានជ្រើសរើស: ទាំងអស់</span>
                        </div>
                        <div id="filter-loading" class="hidden mt-2">
                            <div class="flex items-center text-sm text-blue-600">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                កំពុងច្រោះ...
                            </div>
                        </div>
                    </div>

                    <!-- Initial loading indicator -->
                    <div id="initial-loading" class="text-center py-12">
                        <div class="flex flex-col items-center">
                            <svg class="animate-spin h-12 w-12 text-blue-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">កំពុងផ្ទុកកាលវិភាគ...</h3>
                            <p class="text-sm text-gray-500">សូមរង់ចាំខ្លី</p>
                        </div>
                    </div>

                    <div id="schedule-cards" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 pb-8 sm:pb-16">
                        @foreach ($schedules as $schedule)
                            @foreach ($schedule['schedule_items'] as $item)
                                <x-dashboard.card_schedule 
                                    :schedule="$schedule" 
                                    :item="$item" 
                                    :selectedDate="$selectedDate"
                                    data-department="{{ $item['department_code'] }}"
                                    data-section="{{ $item['section'] }}"
                                    data-date="{{ $selectedDate->format('Y-m-d') }}"
                                />
                            @endforeach
                        @endforeach
                    </div>

                    <!-- No results message -->
                    <div id="no-results" class="hidden text-center py-8">
                        <div class="text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">រកមិនឃើញកាលវិភាគ</h3>
                            <p class="mt-1 text-sm text-gray-500">សូមព្យាយាមជ្រើសរើសអត្ថបទផ្សេងទៀត។</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ dd($departments) }} --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scheduleCards = document.querySelectorAll('#schedule-cards > div');
            const departmentFilter = document.getElementById('department-filter');
            const sectionFilter = document.getElementById('section-filter');
            const datePicker = document.getElementById('datepicker');
            const resultsCount = document.getElementById('count-number');
            const noResults = document.getElementById('no-results');
            const scheduleCardsContainer = document.getElementById('schedule-cards');
            const filterLoading = document.getElementById('filter-loading');
            const filterStatus = document.getElementById('filter-status');
            const activeFiltersSpan = document.getElementById('active-filters');
            const clearFiltersButton = document.getElementById('clear-filters');
            const initialLoading = document.getElementById('initial-loading');

            // Store the initial department value (user's default)
            const userDefaultDepartment = departmentFilter ? departmentFilter.value : 'All';

            let filterTimeout;
            let isInitialLoad = true;

            // Function to filter cards with debouncing
            function filterCards() {
                // Clear existing timeout
                clearTimeout(filterTimeout);
                
                // Show loading state
                if (isInitialLoad) {
                    initialLoading.classList.remove('hidden');
                    scheduleCardsContainer.classList.add('hidden');
                } else {
                    filterLoading.classList.remove('hidden');
                }
                
                // Debounce the filtering
                filterTimeout = setTimeout(() => {
                    const selectedDepartment = departmentFilter ? departmentFilter.value : 'All';
                    const selectedSection = sectionFilter.value;
                    const selectedDate = datePicker.value;

                    let visibleCount = 0;
                    let activeFilters = [];

                    if (selectedDepartment !== 'All') {
                        // Get the department name from the select option
                        const departmentOption = departmentFilter ? departmentFilter.querySelector(`option[value="${selectedDepartment}"]`) : null;
                        const departmentName = departmentOption ? departmentOption.textContent : selectedDepartment;
                        activeFilters.push(`ដេប៉ាតឺម៉ង់ ${departmentName}`);
                    }
                    if (selectedSection !== 'All') {
                        const khmerSections = {
                            'Morning': 'ព្រឹក',
                            'Evening': 'រសៀល', 
                            'Night': 'យប់'
                        };
                        activeFilters.push(`វេន ${khmerSections[selectedSection] || selectedSection}`);
                    }
                    if (selectedDate) {
                        activeFilters.push(`ថ្ងៃ ${selectedDate}`);
                    }

                    const activeFiltersText = activeFilters.length > 0 
                        ? `អត្ថបទដែលបានជ្រើសរើស: ${activeFilters.join(', ')}`
                        : 'អត្ថបទដែលបានជ្រើសរើស: ទាំងអស់';

                    activeFiltersSpan.textContent = activeFiltersText;

                    scheduleCards.forEach(card => {
                        const cardDepartment = card.getAttribute('data-department');
                        const cardSection = card.getAttribute('data-section');
                        const cardDate = card.getAttribute('data-date');

                        // Check if card matches all filters
                        const departmentMatch = selectedDepartment === 'All' || cardDepartment === selectedDepartment;
                        const sectionMatch = selectedSection === 'All' || cardSection === selectedSection;
                        const dateMatch = !selectedDate || cardDate === selectedDate;

                        if (departmentMatch && sectionMatch && dateMatch) {
                            card.style.display = 'block';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Update results count
                    resultsCount.textContent = visibleCount;

                    // Handle initial load completion
                    if (isInitialLoad) {
                        initialLoading.classList.add('hidden');
                        isInitialLoad = false;
                    }

                    // Show/hide no results message
                    if (visibleCount === 0) {
                        noResults.classList.remove('hidden');
                        scheduleCardsContainer.classList.add('hidden');
                    } else {
                        noResults.classList.add('hidden');
                        scheduleCardsContainer.classList.remove('hidden');
                    }

                    // Hide loading state
                    filterLoading.classList.add('hidden');
                }, 150); // 150ms debounce delay
            }

            // Add event listeners for filters
            if (departmentFilter) {
                departmentFilter.addEventListener('change', filterCards);
            }
            
            sectionFilter.addEventListener('change', filterCards);

            // Handle date changes
            datePicker.addEventListener('dateSelected', function(e) {
                // Update the date attribute on all cards
                const newDate = e.detail.date;
                scheduleCards.forEach(card => {
                    card.setAttribute('data-date', newDate);
                });
                filterCards();
            });

            datePicker.addEventListener('change', function(e) {
                const newDate = e.target.value;
                scheduleCards.forEach(card => {
                    card.setAttribute('data-date', newDate);
                });
                filterCards();
            });

            // Auto-select section based on client time if not already set by URL
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
                sectionFilter.value = section;
            }

            // Set default department filter to user's department if not admin or not specified in URL
            if (departmentFilter && !urlParams.has('department_code')) {
                // Apply initial filtering based on user's department
                setTimeout(filterCards, 100);
            } else {
                // Initial filter on page load
                setTimeout(filterCards, 100);
            }

            // Add keyboard shortcuts for quick filtering
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + 1 for Morning, Ctrl/Cmd + 2 for Evening, Ctrl/Cmd + 3 for Night
                if ((e.ctrlKey || e.metaKey) && e.key >= '1' && e.key <= '3') {
                    e.preventDefault();
                    const sections = ['Morning', 'Evening', 'Night'];
                    const sectionIndex = parseInt(e.key) - 1;
                    if (sectionIndex >= 0 && sectionIndex < sections.length) {
                        sectionFilter.value = sections[sectionIndex];
                        filterCards();
                    }
                }
                
                // Ctrl/Cmd + 0 for All sections
                if ((e.ctrlKey || e.metaKey) && e.key === '0') {
                    e.preventDefault();
                    sectionFilter.value = 'All';
                    filterCards();
                }
            });

            // Clear filters button
            clearFiltersButton.addEventListener('click', function() {
                if (departmentFilter) {
                    // Reset to user's default department
                    departmentFilter.value = userDefaultDepartment;
                }
                sectionFilter.value = 'All';
                datePicker.value = ''; // Clear date picker
                
                // Update date attributes on all cards to current date
                const currentDate = new Date().toISOString().split('T')[0];
                scheduleCards.forEach(card => {
                    card.setAttribute('data-date', currentDate);
                });
                
                // Show loading state when clearing filters
                filterLoading.classList.remove('hidden');
                
                filterCards(); // Re-apply filters to show all cards
            });
        });
    </script>
@endsection
