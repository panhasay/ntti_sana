@props([
    'schedule', // array: expects at least 'class_code'
    'item',     // array: expects 'assing_no', 'teacher', 'teacher_2', 'subject', 'time', 'room', 'checked', 'section'
    'selectedDate' // Carbon or string (Y-m-d)
])

<div class="rounded-xl border-1 border-green-600 bg-card text-card-foreground shadow-sm hover:shadow-md transition-all cursor-pointer hover:scale-105 transform duration-300 ease-in-out relative"
    onclick="window.location.href='{{ url('get-attendant-student?assing_no=' . $item['assing_no'] . '&date=' . (is_object($selectedDate) ? $selectedDate->format('Y-m-d') : $selectedDate)) }}'">
    <div class="p-4 sm:p-6 flex flex-col h-full">
        <div class="text-base font-semibold mb-4 flex flex-row items-center justify-between">
            <span>ក្រុម : {{ $schedule['class_code'] }}</span>
        </div>
        <!-- Teacher and Subject Info -->
        <div class="flex items-center space-x-3 sm:space-x-4 mb-4">
            <span class="relative flex h-10 sm:h-12 w-10 sm:w-12 shrink-0 overflow-hidden rounded-full">
                <span
                    class="bg-gray-200 flex h-full w-full items-center justify-center rounded-full avatar-bg-{{ (crc32($item['teacher']) % 5) + 1 }}">
                    <span class="text-sm sm:text-base font-medium text-gray-700">
                        {{ substr($item['teacher'], 0, 1) }}
                    </span>
                </span>
            </span>

            <div class="flex-1">
                <h3 class="text-base sm:text-lg font-semibold leading-none tracking-tight mb-1.5 khmer-font">
                    {{ $item['teacher_2'] ?? $item['teacher'] }} ({{ $item['teacher'] }})
                </h3>
                <div class="text-sm text-muted-foreground">
                    {{ $item['subject'] }}
                </div>
            </div>
        </div>

        <!-- Time and Room Info -->
        <div class="mt-auto">
            <div
                class="flex items-center gap-2 text-xs sm:text-sm text-muted-foreground justify-between border-t pt-3">
                <div class="flex flex-row">
                    <svg class="w-3.5 sm:w-4 h-3.5 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                    <span class="px-2">{{ $item['time'] }}</span>
                </div>
                <div class="khmer-font">
                    បន្ទប់ : ({{ $item['room'] }})
                </div>
                <div class="check-status {{ $item['checked'] ? 'status-checked' : 'status-unchecked' }}"></div>
            </div>
            <!-- Add section info for debugging -->
            <div class="text-xs text-gray-500 mt-2">
                វេន: 
                @php
                    $khmerSection = [
                        'Morning' => 'ព្រឹក',
                        'Evening' => 'ល្ងាច',
                        'Night' => 'យប់',
                        'All' => 'វេនទាំងអស់',
                    ];
                    $sectionValue = $item['section'] ?? 'Not set';
                    echo $khmerSection[$sectionValue] ?? $sectionValue;
                @endphp
            </div>
        </div>
    </div>
</div>
