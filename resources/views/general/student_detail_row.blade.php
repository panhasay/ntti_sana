@forelse ($students as $i => $student)
    <tr class="student-detail-row">
        <td class="text-center">{{ $student->student_code }}</td>
        <td class="text-center">{{ $student->student->name_2 }}</td>
        <td class="text-center">{{ $student->student->name }}</td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center">មិនមានសិស្ស</td>
    </tr>
@endforelse
