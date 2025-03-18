
@foreach ($record_sub_lines->groupBy('sub_class_code') as $sub_class_code => $records)
    <?php $data = App\Models\General\SanaLine::where('sub_class_code', $sub_class_code)->where('group', 'Yes')->first(); ?>
    <tr class="general-group">
        <th colspan="2">
            <button class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2 khmer_os_b" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ជម្រើស
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <a class="dropdown-item khmer_os_b p-3 btnAddNewStudent" href="javascript:">បន្ថែមនិស្សឹត</a>
                <a class="dropdown-item khmer_os_b p-3 BtnEditsubGroup" data-code="{{ $sub_class_code ?? '' }}" href="javascript:void(0);">កែប្រែក្រុម</a>
            </div>
            {{ $sub_class_code }} 
        </th>
        <th>សាស្រ្ដចារ្យដឹកនាំ ​៖ {{ $data->teacher->name_2 ?? '' }}</th>
        <th>
            @php
                $consult_codes = explode(',', $data->teacher_consult_code ?? '');
                $teacher_names = App\Models\General\Teachers::whereIn('code', $consult_codes)->pluck('name_2')->implode(', ');
            @endphp
            សាស្រ្ដចារ្យពិគ្រោះ​ ៖ {{ $teacher_names }}
        </th>
        <th colspan="3">ប្រធានទបទសាណា ៖​ {{ $data->topic ?? '' }}</th>
    </tr>
    @foreach ($records->where('group', 'No') as $line)
        <tr id="row{{ $line->id ?? '' }}">
            <td class="">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2 btnEditStudentSana"
                    href="javascript:" data-id="{{ $line->id ?? '' }}">
                    <i class="mdi mdi-border-color"></i>
                </a>
                <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" 
                    data-code="{{ $line->no ?? '' }}">
                    <i class="mdi mdi-delete-forever"></i>
                </button>
            </td>
            <td>{{ $line->student_code ?? '' }}</td>
            <td>{{ $line->student->name_2 ?? '' }}</td>
            <td>{{ $line->student->name ?? '' }}</td>
            <td>{{ $line->student->gender ?? '' }}</td>
            <td>{{ App\Service\service::DateYearKH($line->student->date_of_birth) ?? '' }}</td>
            <td colspan="">{{ $line->student->phone_student ?? '' }}</td>
        </tr>  
    @endforeach
@endforeach

