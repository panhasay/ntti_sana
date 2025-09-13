<style>
    .table td {
        vertical-align: middle !important;
        font-family: 'Khmer OS Battambang', 'Noto Sans Khmer', sans-serif;
        padding: 10px !important;
    }

    .margin-top {
        margin: 8rem 0 8rem 0;
    }
</style>
@if ($records->count())
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th class="text-center fw-bold" width="30">ល.រ</th>
                <th class="text-center fw-bold" width="30">អត្តលេខ</th>
                <th class="text-center fw-bold" width="70">គោតនាម-នាម</th>
                <th class="text-center fw-bold" width="70">ឈ្មោះអក្សរឡាតាំង</th>
                <th class="text-center fw-bold" width="30">ភេទ</th>
                <th class="text-center fw-bold" width="30">ចំនួនថ្ងៃអវត្តមាន</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 1;
            @endphp
            @foreach ($records as $record)
                <tr>
                    <td class="text-center">{{ $index++ }}</td>
                    <td>{{ $record->student_code }}</td>
                    <td>{{ $record->name_2 }}</td>
                    <td>{{ $record->student_name }}</td>
                    <td class="text-center">{{ $record->gender == 'ប្រុស' ? 'ប្រុស' : 'ស្រី' }}</td>
                    <td class="text-center">{{ $record->absent_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-muted d-flex justify-content-center align-items-center margin-top">មិនមានទិន្នន័យសិស្សទេ។</p>
@endif
