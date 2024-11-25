
<style>

    .avatar-bg-1 { background-color: #FFB4B4; }
    .avatar-bg-2 { background-color: #BFFCC6; }
    .avatar-bg-3 { background-color: #B4E4FF; }
    .avatar-bg-4 { background-color: #FFF6BD; }
    .avatar-bg-5 { background-color: #C8B6FF; }

    .status-on-time { background-color: #22c55e; }
    .status-late { background-color: #f59e0b; }
    .status-absent { background-color: #ef4444; }
    .status-unchecked { background-color: #94a3b8; }

    .check-status {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: absolute;
        bottom: 6px;
        right: 6px;
    }
    .status-checked { background-color: #22c55e; }
    .status-unchecked { background-color: #94a3b8; }

    .khmer-moul {
        font-family: 'Khmer OS Battambang' !important;
    }
</style>
@extends('app_layout.app_layout')
@section('content')
<div class="containner">
    <script src="https://cdn.tailwindcss.com"></script>
</div>
<div class="max-w-[1400px] mx-auto px-8 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="scroll-m-20 text-4xl font-bold tracking-tight khmer-moul">វត្តមានថ្ងៃនេះ</h1>
        <div class="text-base text-muted-foreground khmer-font">
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
                                    {{ substr($item['teacher'], 0, 1) }}
                                </span>
                            </span>
                        </span>
                        
                        <div class="flex-1 space-y-2.5">
                            <h3 class="text-lg font-semibold leading-none tracking-tight mb-1">{{ $item['teacher'] }}</h3>
                            <div class="flex items-center gap-2 text-sm text-muted-foreground pt-0.5">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                                    <circle cx="10" cy="8" r="2"/>
                                    <path d="M7 13c1.1 0 2-.9 2-2v0"/>
                                    <path d="M13 13c-1.1 0-2-.9-2-2v0"/>
                                </svg>
                                {{ $item['subject'] }}
                            </div>
                        </div>
                    </div>
                    
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
</div>
@endsection






