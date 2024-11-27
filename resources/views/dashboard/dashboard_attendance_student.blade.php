<<<<<<< HEAD
<script src="https://cdn.tailwindcss.com"></script>
=======
>>>>>>> 7e80e81f518a1b464959568aad1e871e7b8d25b5
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
    }
</style>
<<<<<<< HEAD
<div class="container">
    @extends('app_layout.app_layout')
    @section('content')
    <div class="max-w-[1400px] mx-auto px-8 py-6">
        <div class="flex justify-between items-center mb-6">
            <div class="scroll-m-20 tracking-tight title-page">វត្តមានថ្ងៃនេះ</div>
            <div class="text-muted-foreground khmer-font">
                {{ Carbon\Carbon::now()->locale('km')->isoFormat('ថ្ងៃdddd ទីD ខែMMMM ឆ្នាំY') }}
            </div>
        </div>
        
        <div class="grid grid-cols-4 gap-4 pb-16">
            @foreach ($attendanceData as $item)
                <div class="rounded-xl border bg-card text-card-foreground shadow-sm hover:shadow-md transition-all cursor-pointer hover:scale-105 transform duration-300 ease-in-out relative">
                    <div class="p-6 flex flex-col space-y-4">
                        <div class="flex items-center space-x-4">
                            <span class="relative flex h-12 w-12 shrink-0 overflow-hidden rounded-full">
                                <span class="flex h-full w-full items-center justify-center rounded-full avatar-bg-{{ (crc32($item['teacher']) % 5) + 1 }}">
                                    <span class="text-base font-medium text-gray-700">
=======
@extends('app_layout.app_layout')
@section('content')
<div class="containner">
    <script src="https://cdn.tailwindcss.com"></script>
</div>
<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 sm:gap-0 mb-4 sm:mb-6">
        <h1 class="scroll-m-20  text-2xl sm:text-3xl lg:text-4xl tracking-tight khmer-moul">វត្តមានថ្ងៃនេះ</h1>
        <div class="text-sm sm:text-base text-muted-foreground khmer-font">
            {{ Carbon\Carbon::now()->locale('km')->isoFormat('ថ្ងៃdddd ទីD ខែMMMM ឆ្នាំY') }}
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4 pb-8 sm:pb-16">
        @foreach ($schedules as $schedule)
            <div class="rounded-xl border-1 border-green-600 bg-card text-card-foreground shadow-sm hover:shadow-md transition-all cursor-pointer hover:scale-105 transform duration-300 ease-in-out relative">
                <div class="p-4 sm:p-6 flex flex-col h-full">
                    <div class="text-base font-semibold mb-4  flex flex-row items-center justify-between">
                        <span >ក្រុម : {{ $schedule['class_code'] }}</span>
                        <span class="text-muted-foreground khmer-font text-sm">វេន : {{ $schedule['section'] === 'Night' ? 'យប់' : $schedule['section'] }}</span>
                    </div>
                    <!-- Combined Class and Section as Title -->

                    @foreach ($schedule['schedule_items'] as $item)
                        <!-- Teacher and Subject Info -->
                        <div class="flex items-center space-x-3 sm:space-x-4 mb-4">
                            <span class="relative flex h-10 sm:h-12 w-10 sm:w-12 shrink-0 overflow-hidden rounded-full">
                                <span class="flex h-full w-full items-center justify-center rounded-full avatar-bg-{{ (crc32($item['teacher']) % 5) + 1 }}">
                                    <span class="text-sm sm:text-base font-medium text-gray-700">
>>>>>>> 7e80e81f518a1b464959568aad1e871e7b8d25b5
                                        {{ substr($item['teacher'], 0, 1) }}
                                    </span>
                                </span>
                                
                            </span>
<<<<<<< HEAD
                            
                            <div class="flex-1 space-y-2.5">
                                <h3 class="text-lg font-semibold leading-none tracking-tight mb-1">{{ $item['teacher'] }}</h3>
                                <div class="flex items-center gap-2 text-sm text-muted-foreground pt-0.5">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                        <circle cx="10" cy="8" r="2"/>
                                        <path d="M7 13c1.1 0 2-.9 2-2v0"/>
                                        <path d="M13 13c-1.1 0-2-.9-2-2v0"/>
                                    </svg>
=======
                                
                            <div class="flex-1">
                                <h3 class="text-base sm:text-lg font-semibold leading-none tracking-tight mb-1.5">{{ $item['teacher'] }}</h3>
                                <div class="text-sm text-muted-foreground">
>>>>>>> 7e80e81f518a1b464959568aad1e871e7b8d25b5
                                    {{ $item['subject'] }}
                                </div>
                            </div>
                        </div>
<<<<<<< HEAD
                        
                        <div class="flex items-center gap-2 text-sm text-muted-foreground">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                                <path d="M12 6a2 2 0 0 0 4 0 2 2 0 0 0-4 0"/>
                                <path d="M16 6a2 2 0 0 0 4 0 2 2 0 0 0-4 0"/>
                                <path d="M8 6a2 2 0 0 0 4 0 2 2 0 0 0-4 0"/>
                            </svg>
                            {{ $item['time'] }}
                        </div>
                    </div>
                    <div class="check-status {{ isset($item['checked']) ? 'status-checked' : 'status-unchecked' }}"></div>
                </div>
            @endforeach
        </div>
=======

                        <!-- Time and Room Info -->
                        <div class="mt-auto">
                            <div class="flex items-center gap-2 text-xs sm:text-sm text-muted-foreground justify-between border-t pt-3">
                               
                                <div class="flex flex-row">
                                    <svg class="w-3.5 sm:w-4 h-3.5 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    <span class="px-2">  {{ $item['time'] }}</span>
                                    
                                </div>
                                <div class="khmer-font">
                                    Room : ({{ $item['room'] }})
                                </div>
                                <div class="check-status {{ $item['checked'] ? 'status-checked' : 'status-unchecked' }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
>>>>>>> 7e80e81f518a1b464959568aad1e871e7b8d25b5
    </div>
    @endsection
</div>







