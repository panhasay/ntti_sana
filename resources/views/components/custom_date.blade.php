<div class="relative max-w-sm ">


    <div class="relative max-w-sm">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
        </div>
        <input  type="text" id="datepicker" name="date"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 cursor-pointer"
            placeholder="Select date" readonly>

    </div>



    <div id="calendar" class="absolute z-10 hidden mt-2 bg-white border border-gray-200 rounded-lg shadow-lg p-4 w-80">
        <div class="flex items-center justify-between mb-4">
            <button id="prevMonth"
                class="text-gray-600 hover:text-blue-500 transition-colors duration-150 p-1 rounded-full hover:bg-gray-100">←</button>
            <span id="monthYear"
                class="text-lg font-semibold text-gray-800 cursor-pointer hover:text-blue-600 transition-colors duration-150"></span>
            <button id="nextMonth"
                class="text-gray-600 hover:text-blue-500 transition-colors duration-150 p-1 rounded-full hover:bg-gray-100">→</button>
        </div>
        <div id="monthGrid" class="grid grid-cols-3 gap-2 text-center pb-2 border-b border-gray-200 mb-2 hidden"></div>
        <div class="grid grid-cols-7 gap-2 text-center pb-2 border-b border-gray-200 mb-2" id="daysHeader">
            <div class="text-sm font-medium text-gray-500">អាទិត្យ</div>
            <div class="text-sm font-medium text-gray-500">ច័ន្ទ</div>
            <div class="text-sm font-medium text-gray-500">អង្គារ</div>
            <div class="text-sm font-medium text-gray-500">ពុធ</div>
            <div class="text-sm font-medium text-gray-500">ព្រហ</div>
            <div class="text-sm font-medium text-gray-500">សុក្រ</div>
            <div class="text-sm font-medium text-gray-500">សៅរ៍</div>
        </div>
        <div id="days" class="grid grid-cols-7 gap-2 text-center"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('datepicker');
        const calendar = document.getElementById('calendar');
        const daysContainer = document.getElementById('days');
        const monthYear = document.getElementById('monthYear');
        const prevMonth = document.getElementById('prevMonth');
        const nextMonth = document.getElementById('nextMonth');
        const monthGrid = document.getElementById('monthGrid');
        const daysHeader = document.getElementById('daysHeader');
        const prevDay = document.getElementById('prevDay');
        const nextDay = document.getElementById('nextDay');

        let currentDate = new Date();
        let selectedDate = null;
        let view = 'days'; // 'days' or 'months'
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Set initial date from parent if available, otherwise today
        const initialDate = @json(isset($selectedDate) ? $selectedDate->format('Y-m-d') : null);
        const todayStr = new Date().toISOString().split('T')[0];
        selectedDate = initialDate || todayStr;
        input.value = selectedDate;
        // Always show the month of the selected date (or today)
        if (initialDate) {
            currentDate = new Date(initialDate);
        } else {
            currentDate = new Date();
        }

        const holidays = @json($dateStrings);
        const holidayNames = @json($holidayNames ?? []);

        // Khmer month names
        const khmerMonths = [
            'មករា', 'កុម្ភៈ', 'មីនា', 'មេសា',
            'ឧសភា', 'មិថុនា', 'កក្កដា', 'សីហា',
            'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'
        ];

        function renderCalendar() {
            if (view === 'months') {
                renderMonthGrid();
                monthGrid.classList.remove('hidden');
                daysContainer.classList.add('hidden');
                daysHeader.classList.add('hidden');
                return;
            } else {
                monthGrid.classList.add('hidden');
                daysContainer.classList.remove('hidden');
                daysHeader.classList.remove('hidden');
            }
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            const firstDay = new Date(year, month, 1).getDay();
            const lastDate = new Date(year, month + 1, 0).getDate();
            const isFutureMonth = new Date(year, month, 1) > today;

            // Display Khmer month name and year
            monthYear.textContent = `${khmerMonths[month]} ${year}`;
            daysContainer.innerHTML = '';

            for (let i = 0; i < firstDay; i++) {
                daysContainer.innerHTML += '<div></div>';
            }

            for (let day = 1; day <= lastDate; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dateObj = new Date(year, month, day);
                const isHoliday = holidays.includes(dateStr);
                const isSunday = dateObj.getDay() === 0;
                const isFuture = dateObj > today;
                const isBlocked = isHoliday || isSunday || isFuture || isFutureMonth;
                const isSelected = selectedDate && selectedDate === dateStr;
                const isToday = dateStr === todayStr;
                // Get holiday name for tooltip
                const holidayName = holidayNames[dateStr] || '';
                let dayClasses = `p-2 rounded-full transition-all duration-200 font-semibold text-base`;
                if (isBlocked) dayClasses += ' text-gray-400 cursor-not-allowed';
                else dayClasses += ' cursor-pointer hover:bg-blue-100';
                if (isHoliday) dayClasses += ' bg-red-500 text-white hover:scale-110 hover:shadow-lg';
                else if (isSunday) dayClasses += ' bg-gray-200';
                else dayClasses += ' text-gray-700';
                if (isToday && !isSelected) dayClasses += ' border-2 border-blue-400';
                if (isSelected) dayClasses += ' bg-blue-500 text-white shadow-lg';
                // Create tooltip wrapper for holidays
                if (isHoliday && holidayName) {
                    daysContainer.innerHTML += `
                    <div class="group relative">
                        <div class="${dayClasses}" ${!isBlocked ? `data-date="${dateStr}"` : ''}>${day}</div>
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-800 text-white text-xs rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap z-50 pointer-events-none">
                            ${holidayName}
                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-gray-800"></div>
                        </div>
                    </div>
                `;
                } else {
                    daysContainer.innerHTML +=
                        `<div class="${dayClasses}" ${!isBlocked ? `data-date=\"${dateStr}\"` : ''}>${day}</div>`;
                }
            }
        }

        function renderMonthGrid() {
            const year = currentDate.getFullYear();
            monthGrid.innerHTML = '';
            for (let i = 0; i < 12; i++) {
                const isCurrent = i === today.getMonth() && year === today.getFullYear();
                const isSelected = i === currentDate.getMonth();
                monthGrid.innerHTML +=
                    `<div class="p-2 rounded-lg cursor-pointer hover:bg-blue-100 transition-all duration-150 font-semibold text-base ${isSelected ? 'bg-blue-500 text-white' : isCurrent ? 'bg-gray-200' : 'text-gray-700'}" data-month="${i}">${khmerMonths[i]}</div>`;
            }
        }

        function toggleCalendar() {
            calendar.classList.toggle('hidden');
        }

        input.addEventListener('click', toggleCalendar);

        daysContainer.addEventListener('click', function(e) {
            const date = e.target.getAttribute('data-date');
            if (date) {
                const dateObj = new Date(date);
                const isHoliday = holidays.includes(date);
                const isSunday = dateObj.getDay() === 0;
                const isFuture = dateObj > today;
                if (!isHoliday && !isSunday) {
                    selectedDate = date;
                    input.value = date;
                    toggleCalendar();
                    renderCalendar();
                    // Dispatch custom event
                    const event = new CustomEvent('dateSelected', {
                        detail: {
                            date
                        }
                    });
                    input.dispatchEvent(event);
                }
            }
        });

        prevMonth.addEventListener('click', function() {
            if (view === 'months') {
                currentDate.setFullYear(currentDate.getFullYear() - 1);
                renderCalendar();
            } else {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            }
        });

        nextMonth.addEventListener('click', function() {
            if (view === 'months') {
                currentDate.setFullYear(currentDate.getFullYear() + 1);
                renderCalendar();
            } else {
                const nextMonthDate = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1,
                1);
                if (nextMonthDate <= today) {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    renderCalendar();
                }
            }
        });

        monthYear.addEventListener('click', function() {
            if (view === 'days') {
                view = 'months';
                renderCalendar();
            } else {
                view = 'days';
                renderCalendar();
            }
        });

        monthGrid.addEventListener('click', function(e) {
            const month = e.target.getAttribute('data-month');
            if (month !== null) {
                currentDate.setMonth(Number(month));
                view = 'days';
                renderCalendar();
            }
        });

        document.addEventListener('click', function(e) {
            if (!calendar.contains(e.target) && e.target !== input) {
                calendar.classList.add('hidden');
                view = 'days';
            }
        });

        function getValidDay(date, direction) {
            // direction: -1 for previous, 1 for next
            let d = new Date(date);
            while (true) {
                d.setDate(d.getDate() + direction);
                const dateStr = d.toISOString().split('T')[0];
                const isHoliday = holidays.includes(dateStr);
                const isSunday = d.getDay() === 0;
                const isFuture = d > today;
                if (!isHoliday && !isSunday && !isFuture) {
                    return dateStr;
                }
                // Prevent infinite loop (optional: set a limit)
                if (d < new Date('2000-01-01') || d > today) break;
            }
            return null;
        }



        renderCalendar();
    });
</script>
