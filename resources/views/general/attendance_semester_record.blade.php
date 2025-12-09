@php
    $index = 1;
    $records = collect($records)
        ->sortBy(function ($sort_name) {
            return $sort_name['name'];
        })
        ->values();
@endphp
@foreach ($records as $record)
    <tr>
        <td>{{ $index++ }}</td>
        <td class="text-start {{ ($record['gender'] ?? '') == 'ស្រី' ? 'fw-bold' : '' }}">
            {{ $record['name'] ?? '' }}
        </td>
        <td class="{{ ($record['gender'] ?? '') == 'ស្រី' ? 'fw-bold' : '' }}">{{ $record['gender'] ?? '' }}</td>

        @php
            $total_permission = 0;
            $total_absent = 0;
            $totals = 0;
        @endphp

        @foreach ($months as $month)
            @php
                $year = $month->year;
                $m = $month->month;
                $permissionCount = $record['months'][$year][$m]['permission'] ?? 0;
                $absentCount = $record['months'][$year][$m]['absent'] ?? 0;
                $permissionScore = $permissionCount * 0.5;
                $permissionAsAbsent = floor($permissionScore);
                $total_permission += $permissionCount;
                $total_absent += $absentCount + $permissionAsAbsent;
            @endphp
            <td>{{ $permissionCount }}</td>
            <td>{{ $absentCount }}</td>
        @endforeach
        <td class="{{ $total_absent > 14 ? 'text-white fw-bold bg-danger' : '' }}">{{ $total_permission }}
        </td>
        <td class="{{ $total_absent > 14 ? 'text-white fw-bold bg-danger' : '' }}">{{ $total_absent }}</td>
    </tr>
@endforeach
