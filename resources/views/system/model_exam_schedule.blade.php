<div class="modal fade" id="ModalTeacherSchedule" tabindex="-1" aria-labelledby="ModalTeacherSchedule" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 100%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="ModalTeacherScheduless">កាប្រឡង</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="height: 400px;">
            <div class="control-table table-responsive custom-data-table-wrapper2">
                <form id="frmDataSublist" role="form" class="form-sample" enctype="multipart/form-data">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="500px" class="text-center" rowspan="2">ឈ្មោះ​ សាស្រ្តាចារ្យ</th>
                            <th class="text-center" colspan="2">ចន្ទ</th>
                            <th class="text-center" colspan="2">អង្គា</th>
                            <th class="text-center" colspan="2">ពុធ</th>
                            <th class="text-center" colspan="2">ព្រហស្បត៏</th>
                            <th class="text-center" colspan="2">សុក្រ</th>
                            <th class="text-center" colspan="2">សៅរ៏</th>
                        </tr>
                        <tr class="general-data">
                            <th class="text-center"><input class="formSublist" type="time" date-name="monday" id="start_time_monday" name="start_time_monday" value=""></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="monday" id="end_time_monday" name="end_time_monday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="tuesday" id="start_time_tuesday" name="start_time_tuesday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="tuesday" id="end_time_tuesday" name="end_time_tuesday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="wednesday" id="start_time_wednesday" name="start_time_wednesday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="wednesday" id="end_time_wednesday" name="start_time_wednesday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="thursday" id="start_time_thursday" name="start_time_thursday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="thursday" id="end_time_thursday" name="end_time_thursday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="friday" id="start_time_friday" name="start_time_friday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="friday" id="end_time_friday" name="end_time_friday"></th>
            
                            <th class="text-center"><input class="formSublist" type="time" date-name="saturday" id="start_time_saturday" name="start_time_saturday"></th>
                            <th class="text-center"><input class="formSublist" type="time" date-name="saturday" id="end_time_saturday" name="end_time_saturday"></th>
        
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="general-data">
                            <td class="text-letf">
                                <select class="js-example-basic-single FieldRequired formSublist" id="teachers" name="teacher_code" style="width: 100% !important;">
                                    <option value="">សាស្រ្តាចារ្យ</option>
                                    @foreach ($teachers as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name_2) ? $record->name_2 : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist subjects-monday" date-type="monday" id="subjects_code_monday" name="subjects_code_monday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room_monday" class="formSublist text-center" name="room_monday" date-room="monday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="tuesday" id="subjects_code_tuesday" name="subjects_code_tuesday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room_tuesday" class="formSublist text-center" name="room_tuesday" date-room="tuesday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="wednesday" id="subjects_code_wednesday" name="subjects_code_wednesday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room_wednesday" class="formSublist text-center" name="room_wednesday" date-room="wednesday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="thursday" id="subjects_code_thursday" name="subjects_code_thursday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room_thursday" class="formSublist text-center" name="room_thursday" date-room="thursday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="friday" id="subjects_code_friday" name="subjects_code_friday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room_friday" class="formSublist text-center" name="room_friday" date-room="friday" placeholder="H & Room" style="width: 100%;">
                            </td>
                            <td class="text-center" colspan="2">
                                <select class="js-example-basic-single FieldRequired formSublist" date-type="saturday" id="subjects_code_saturday" name="subjects_code_saturday" style="width: 100%;">
                                    <option value="">មុខវិជ្ជា</option>
                                    @foreach ($subjects as $record) 
                                        <option value="{{ $record->code ?? '' }}" {{ isset($records->years) && $records->years == $record->code ? 'selected' : '' }}>
                                        {{ isset($record->name) ? $record->name : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                <br>
                                <input type="text" id="room_saturday" class="formSublist text-center" name="room_saturday" date-room="saturday" placeholder="H & Room" style="width: 100%;">
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary khmer_os_b" data-bs-dismiss="modal">បិទ</button>
          <button type="button" id="SaveTeacherSchedule" class="btn btn-primary khmer_os_b">រក្សាទុក</button>
        </div>
      </div>
    </div>
</div>