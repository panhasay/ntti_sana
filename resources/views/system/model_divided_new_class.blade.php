<div class="control-table table-responsive custom-data-table-wrapper2">
    <table class="table table-striped">
        <thead>
            <tr class="general-data">
                <th width="50"></th>
                <th width="10">អត្តលេខ</th>
                <th width="50">គោត្តនាម និងនាម</th>
                <th width="50">ឈ្មោះជាឡាតាំង</th>
                <th>ភេទ</th>
                <th>ថ្ងៃខែឆ្នាំកំណើត</th>
                <th width="20">លេខទូរស័ព្ទ</th>
                <th>ជំនាញ</th>
                <th>កម្រិត</th>
                <th>វេនសិក្សា</th>
                <th>ដេប៉ាដេម៉ង់</th>
                <th>ឆ្នាំសិក្សា</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <?php 
                $check_student_class = DB::table('student')->where('code', $student['code'])->whereNot('class_code', '')->value('code');

                $count_student = DB::table('student')->where('code', $student['code'])->whereNot('class_code', '')->count();
            ?>
                <tr id="row{{ $student['code'] }}">
                    <!-- Add Button -->
                    <td>
                        <button 
                            {{ $student['code'] == ($check_student_class ?? null) ? 'disabled' : '' }} 
                            class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" 
                            id="btnAddStudentToClasses" 
                            data-code="{{ $student['code'] }}" 
                            data-class="{{ $class_code }}">
                            <i class="mdi mdi-account-plus"></i> Add
                        </button>
                    </td>
                    <!-- Table Columns -->
                    @foreach (['code', 'name_2', 'name', 'gender', 'date_of_birth', 'phone_student', 'skills', 'qualification', 'section', 'department', 'session_year_code'] as $field)
                        <td class="text-center {{ $student['code'] == ($check_student_class ?? null) ? 'table-danger' : 'table-primary' }}">
                            {{ $field === 'session_year_code' && isset($student[$field]) 
                                ? str_replace('_', '-', $student[$field]) 
                                : ($student[$field] ?? 'N/A') 
                            }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>