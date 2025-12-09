<table class="table table-striped" id="">
    <thead>
        <tr class="general-data">
            <th width="80" class="text-center"> 
                <input type="checkbox" id="CheckAllStudent" style="width: 20px;height: 20px;padding: 13px;">
            </th>
            <th width="10">អត្តលេខ</th>
            <th >គោត្តនាម និងនាម</th>
            <th >ឈ្មោះជាឡាតាំង</th>
            <th >ភេទ</th>
            <th>ថ្ងៃខែឆ្នាំកំណើត</th>
            <th>លេខទូរសព្ទ</th>
        </tr>
    </thead>
    <tbody class="data-list-studnet">
        @foreach ($record_sub_lines as $record)
        <tr >
            <td height="38" class="text-center">
                <input type="checkbox" class="CheckStudent" data-code="{{ $record->student_code ?? '' }}" style="width: 20px;height: 20px;padding: 13px;">
            </td>
            <td class="text-left"> {{ $record->student_code ?? '' }}</td>
            <td class="text-left"> {{ $record->student->name_2 ?? '' }}</td>
            <td class="text-left"> {{ $record->student->name ?? '' }}</td>
            <td class="text-left"> {{ $record->student->gender ?? '' }}</td>
            <td class="text-left"> {{ $record->student->date_of_birth ?? '' }}</td>
            <td class="text-left"> {{ $record->student->phone_student ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<br>