@foreach ($record_sub_lines as $record)
    <tr id="row_line{{ $record->code ?? '' }}">
        <td></td>
        <td>{{ $record->student_code ?? '' }}</td>
        <td>{{ $record->student ?? '' }}</td>
        <td>Hello</td>
        <td>Hello</td>
        <td>Hello</td>
    </tr>
@endforeach
