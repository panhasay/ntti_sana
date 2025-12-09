@php
    $index = 1;
@endphp
@foreach ($records as $record)
    <tr>
        <td>{{ $index++ }}</td>
        <td class="text-start">{{ $record->name_2 }}</td>
        <td>{{ $record->gender }}</td>
        <td>{{ $record->class_code }}</td>
        <td>ឆ្នាំទី{{ $record->years ?? '' }} ឆមាសទី{{ $record->semester ?? '' }}</td>
        {{-- <td>៥ មុខវិជ្ជា</td> --}}
        <td>{{ $record->absent }}</td>
    </tr>
@endforeach
