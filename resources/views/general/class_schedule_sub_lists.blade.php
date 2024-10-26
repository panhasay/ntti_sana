
<style>
    .table thead th {
        background: #d4d4d5;
        font-family: 'Khmer OS Battambang' !important;
        border: 1px solid #5b5b5b33 !important;
        padding: 8px !important;
}
</style>
<div class="control-table table-responsive custom-data-table-wrapper2">
    <form id="frmDataSublist" role="form" class="form-sample" enctype="multipart/form-data">
        <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center" rowspan="2" width="10">ល.រ</th>
                <th class="text-center" rowspan="2">សាស្រ្តាចារ្យ</th>
                <th class="text-center" colspan="2">ចន្ទ</th>
                <th class="text-center" colspan="2">អង្គា</th>
                <th class="text-center" colspan="2">ពុធ</th>
                <th class="text-center" colspan="2">ព្រហស្បត៏</th>
                <th class="text-center" colspan="2">សុក្រ</th>
                <th class="text-center" colspan="2">សៅរ៏</th>
            </tr>
            <tr class="general-data">
                <th class="text-center">5:30</th>
                <th class="text-center">5:30</th>

                <th class="text-center">5:30</th>
                <th class="text-center">5:30</th>

                <th class="text-center">5:30</th>
                <th class="text-center">5:30</th>

                <th class="text-center">5:30</th>
                <th class="text-center">5:30</th>

                <th class="text-center">5:30</th>
                <th class="text-center">5:30</th>

                <th class="text-center">5:30</th>
                <th class="text-center">5:30</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center" rowspan="" width="10">1</td>
                <td class="text-center" rowspan="2">សាស្រ្តាចារ្យ</td>
                <td class="text-center" colspan="2">ចន្ទ</td>
                <td class="text-center" colspan="2">អង្គា</td>
                <td class="text-center" colspan="2">ពុធ</td>
                <td class="text-center" colspan="2">ព្រហស្បត៏</td>
                <td class="text-center" colspan="2">សុក្រ</td>
                <td class="text-center" colspan="2">សៅរ៏</td>
            </tr>
        </tbody>
        {{-- <tbody>
            <tr class="general-data">
                <td>1</td>
                <td class="text-letf">
                    <select class="js-example-basic-single FieldRequired" id="teacher_code" name="teacher_code" style="width: 100% !important;">
                        <option value="">សាស្រ្តាចារ្យ</option>
                        @foreach ($teachers as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2">
                    <select class="js-example-basic-single FieldRequired" id="subjects_code" name="subjects_code" style="width: 100%;">
                        <option value="">មុខវិជ្ជា</option>
                        @foreach ($subjects as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
            </tr>
            <tr class="general-data">
                <td>2</td>
                <td class="text-letf">
                    <select class="js-example-basic-single FieldRequired" id="teacher_code_2" name="teacher_code_2" style="width: 100% !important;">
                        <option value="">សាស្រ្តាចារ្យ</option>
                        @foreach ($teachers as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2">
                    <select class="js-example-basic-single FieldRequired" id="subjects_cod_2" name="subjects_cod_2" style="width: 100%;">
                        <option value="">មុខវិជ្ជា</option>
                        @foreach ($subjects as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
            </tr>
            <tr class="general-data">
                <td>3</td>
                <td class="text-letf">
                    <select class="js-example-basic-single FieldRequired" id="teacher_code_3" name="teacher_code_3" style="width: 100% !important;">
                        <option value="">សាស្រ្តាចារ្យ</option>
                        @foreach ($teachers as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2">
                    <select class="js-example-basic-single FieldRequired" id="subjects_cod_3" name="subjects_cod_3" style="width: 100%;">
                        <option value="">មុខវិជ្ជា</option>
                        @foreach ($subjects as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
            </tr>
            <tr class="general-data">
                <td>4</td>
                <td class="text-letf">
                    <select class="js-example-basic-single FieldRequired" id="teacher_code_4" name="teacher_code_4" style="width: 100% !important;">
                        <option value="">សាស្រ្តាចារ្យ</option>
                        @foreach ($teachers as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2">
                    <select class="js-example-basic-single FieldRequired" id="subjects_cod_4" name="subjects_cod_4" style="width: 100%;">
                        <option value="">មុខវិជ្ជា</option>
                        @foreach ($subjects as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
            </tr>
            <tr class="general-data">
                <td>5</td>
                <td class="text-letf">
                    <select class="js-example-basic-single FieldRequired" id="teacher_code_5" name="teacher_code_5" style="width: 100% !important;">
                        <option value="">សាស្រ្តាចារ្យ</option>
                        @foreach ($teachers as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2">
                    <select class="js-example-basic-single FieldRequired" id="subjects_cod_5" name="subjects_cod_5" style="width: 100%;">
                        <option value="">មុខវិជ្ជា</option>
                        @foreach ($subjects as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
            </tr>
            <tr class="general-data">
                <td>6</td>
                <td class="text-letf">
                    <select class="js-example-basic-single FieldRequired" id="teacher_code_6" name="teacher_code_6" style="width: 100% !important;">
                        <option value="">សាស្រ្តាចារ្យ</option>
                        @foreach ($teachers as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2">
                    <select class="js-example-basic-single FieldRequired" id="subjects_cod_6" name="subjects_cod_6" style="width: 100%;">
                        <option value="">មុខវិជ្ជា</option>
                        @foreach ($subjects as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr class="general-data">
                <td>7</td>
                <td class="text-letf">
                    <select class="js-example-basic-single FieldRequired" id="teacher_code_7" name="teacher_code_7" style="width: 100% !important;">
                        <option value="">សាស្រ្តាចារ្យ</option>
                        @foreach ($teachers as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }} -  {{ isset($record->name_2) ? $record->name_2 : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2"></td>
                <td class="text-center" colspan="2">
                    <select class="js-example-basic-single FieldRequired" id="subjects_cod_7" name="subjects_cod_7" style="width: 100%;">
                        <option value="">មុខវិជ្ជា</option>
                        @foreach ($subjects as $record) 
                            <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                            {{ isset($record->name) ? $record->name : '' }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </tbody> --}}
        </table>
    </form>
</div>
<br><br><br><br><br><br>